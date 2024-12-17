<?php

use Random\RandomException;

require('../model/database.php');
require('../model/users_db.php');
require('../model/pet_db.php');
require('../model/address_db.php');

// get the action parameter from either POST or GET, default to 'display_login'
$action = filter_input(INPUT_POST, 'action') ?: filter_input(INPUT_GET, 'action') ?: 'display_login';

// get the user ID from session if available
$user_id = $_SESSION['user_id'] ?? null;

switch ($action) {
    case 'login':
        // get username and password from POST
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $message = '';

        // check if the user exists with the provided username and password
        $user = get_user_by_username_password($username, $password);
        if ($user !== NULL) {
            $_SESSION['user_id'] = $user['id']; // store user ID in session
            header('Location: user_account.php'); // redirect to user account page
        } else {
            $message = 'Invalid username or password'; // error message
            include('login.php'); // show login page
        }
        break;

    case 'create_account':
        // show create account page
        include('create_account.php');
        break;

    case 'create_account_submit':
        // sanitize and collect the form data for creating a new user
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $email = filter_input(INPUT_POST, 'email');
        $name = filter_input(INPUT_POST, 'name');
        $phone = filter_input(INPUT_POST, 'phone');

        // attempt to add the user to the database
        if (add_user($name, $username, $email, $phone, $password)){
            $message = 'Account created successfully! You can now log in.';
            include('login.php'); // show login page
        } else {
            $message = 'Error creating account. Please try again.'; // error message
            include('create_account.php'); // show account creation page again
        }
        break;

    case 'user_view_pets':
        // fetch pets for the current user
        $pets = get_pets_by_user_id($user_id);
        include('view_pets.php'); // show user's pets
        break;

    case 'process_new_account':
        // get user input from the form
        $name = filter_input(INPUT_POST, 'name');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');

        // check if passwords match
        if ($password === $confirm_password) {
            // hash the password for storage
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // attempt to add the user
            if (add_user($name, $username, $email, $phone, $password)){
                $message = 'Account created successfully! You can now log in.';
                include('login.php'); // show login page
            } else {
                $message = 'Error creating account. Please try again.';
                include('create_account.php'); // show account creation page
            }
        } else {
            $message = 'Passwords do not match. Please try again.'; // error message
            include('create_account.php'); // show account creation page
        }
        break;

    case 'reset_password':
        // show reset password page
        include('reset_password.php');
        break;

    case 'reset_password_submit':
        // get username or email for password reset
        $username_or_email = filter_input(INPUT_POST, 'username_or_email');

        // check if the user exists by username or email
        $user = get_user_by_username_or_email($username_or_email);
        if ($user) {
            try {
                // generate a random token for the password reset link
                $token = bin2hex(random_bytes(16));
            } catch (RandomException $e) {
                include '../errors/error.php'; // show error if token generation fails
            }

            // send the password reset link via email
            $recipientEmail = $user['email']; // get user email
            $message = 'Password reset link sent to your email!'; // success message
            include('login.php'); // show login page
        } else {
            $message = 'Error resetting password. Please check your username or email.'; // error message
            include('reset_password.php'); // show reset password page again
        }
        break;

    case 'user_view_addresses':
        // fetch addresses for the user
        $addresses = get_addresses_by_user_id($user_id);
        include('user_view_addresses.php'); // show user addresses
        break;

    case 'add_address_form':
        // sanitize address input
        $line1 = filter_input(INPUT_POST, 'line1');
        $line2 = filter_input(INPUT_POST, 'line2');
        $city = filter_input(INPUT_POST, 'city');
        $province = filter_input(INPUT_POST, 'province');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $phone = filter_input(INPUT_POST, 'phone');

        // attempt to add the address
        if (add_address($user_id, $line1, $line2, $city, $province, $postal_code, $phone)) {
            $message = 'Address added successfully!';
        } else {
            $message = 'Error adding address. Please try again.'; // error message
        }
        header('Location: .?action=user_view_addresses'); // redirect to address view
        exit();

    case 'edit_address':
        // get the address ID from GET request
        $address_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($address_id) {
            // fetch the address to edit
            $edit_address = get_address_by_id($address_id);
            if ($edit_address && $edit_address['user_id'] === $_SESSION['user_id']) {
                include('user_view_addresses.php'); // show the edit address form
            } else {
                $message = 'Address not found or does not belong to you.';
                header('Location: .?action=user_view_addresses'); // redirect if not allowed
                exit();
            }
        } else {
            $message = 'Invalid address ID.'; // error message
            header('Location: .?action=user_view_addresses'); // redirect to address view
            exit();
        }
        break;

    case 'edit_address_submit':
        // get and sanitize data inputs
        $address_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $line1 = filter_input(INPUT_POST, 'line1');
        $line2 = filter_input(INPUT_POST, 'line2');
        $city = filter_input(INPUT_POST, 'city');
        $province = filter_input(INPUT_POST, 'province');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $phone = filter_input(INPUT_POST, 'phone');

        // update the address in the database
        if (update_address($address_id, $line1, $line2, $city, $province, $postal_code, $phone)) {
            $message = 'Address updated successfully!';
        } else {
            $message = 'Error updating address. Please try again.'; // error message
        }

        header('Location: .?action=user_view_addresses'); // redirect to view addresses
        exit();

    case 'delete_address':
        // handle address deletion
        $address_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (delete_address($address_id)) {
            $message = 'Address deleted successfully!';
        } else {
            $message = 'Error deleting address. Please try again.'; // error message
        }
        header('Location: .?action=user_view_addresses'); // redirect to view addresses
        exit();

    default:
        // default action: show login page
        include('login.php');
        break;

    case 'logout':
        // log the user out by clearing session and cookies
        $_SESSION = array();
        session_destroy();
        setcookie("user_logged_in", "", time() - 3600, "/"); // delete cookie
        $login_message = 'You have been logged out.'; // logout message
        include('login.php'); // show login page
        break;
}
?>
