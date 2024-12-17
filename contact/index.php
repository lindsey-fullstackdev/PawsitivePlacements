<?php

require_once('../model/database.php');
require_once('../model/users_db.php');

// Initialize variables
$error = '';
$name = '';
$email = '';
$phone = '';
$comments = '';

// Determine the action to perform based on action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'show_form';
}

switch ($action) {
    // Show the contact us form
    case 'show_form':
        include('contact_form_info.php');
        break;

    case 'submit_form': // Get and clean the data from the contact us form
        // Retrieve input values
        $name = trim(filter_input(INPUT_POST, 'name'));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $phone = trim(filter_input(INPUT_POST, 'phone'));
        $comments = trim(filter_input(INPUT_POST, 'comments'));

        // Validate fields
        if ($name === '') {
            $error .= "Name is required. ";
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format. ";
        }
        if ($phone !== '' && !preg_match('/^\+?[0-9]*$/', $phone)) {
            $error .= "Invalid phone number format. ";
        }
        if ($comments !== '' && strlen($comments) > 500) {
            $error .= "Comments must be less than 500 characters. ";
        }

        // Show form if there are no errors
        if (!empty($error)) {
            include('contact_form_info.php'); // redisplay form if there are errors
            break;
        }

        // If data is valid insert into database
        $result = add_contact_form_info($name, $email, $phone, $comments);
        if ($result === true) {
            // Store data in session for redirection
            session_start();
            $_SESSION['form_data'] = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'comments' => $comments,
            ];
            // Go to success page
            header('Location: contact_form_successful.php');
            exit(); // Stop script

        } else {
            // Handle database error
            $error = $result; // Store the error message from the function
            include('contact_form_info.php'); // Show form again with errors
        }
        break;
}
