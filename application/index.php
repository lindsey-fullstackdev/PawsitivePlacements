<?php

require_once('../model/database.php');
require_once('../model/pet_db.php');
require_once('../model/adoption_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_form';
    }
}

switch ($action) {
    case 'display_form':
        include('application_form.php');
        break;

    case 'process_application':
        // Retrieve form inputs
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone');
        $message = filter_input(INPUT_POST, 'message');
        $pet_id = filter_input(INPUT_POST, 'pet_id', FILTER_SANITIZE_NUMBER_INT);

        // Validate inputs
        if (empty($name) || empty($email) || empty($phone) || empty($message)) {
            $error = 'Please fill in all required fields.';
            include('../errors/error.php');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
            include('../errors/error.php');
        } else {
            // Get user ID based on email
            $user_id = get_user_id_by_email($email);
            if ($user_id === null) {
                $error = 'User does not exist.';
                include('../user_accounts/create_account.php');
            } else {
                // Store application details in session
                session_start();
                $_SESSION['application_name'] = $name;
                $_SESSION['application_email'] = $email;
                $_SESSION['application_phone'] = $phone;
                $_SESSION['application_pet_id'] = $pet_id;

                // Add application and message
                add_application($user_id, $pet_id, $name, $email, $phone, $message);
                add_message($user_id, $pet_id, $message, $name);

                // Redirect to success page
                header("Location: .?action=display_success");
                exit;
            }
        }
        break;

    case 'display_success':
        include('application_success.php');
        break;

    default:
        $error = 'Unknown action.';
        include('../errors/error.php');
        break;
}
