<?php
// Start session management and include necessary functions
session_start();
require_once('../model/database.php');
require_once('../model/admin_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_admin_menu';
    }
}

// Check cookie for previous login
if (isset($_COOKIE['admin_logged_in']) && $_COOKIE['admin_logged_in'] === 'true') {
    $_SESSION['is_valid_admin'] = true;
}

// If the admin isnt logged in force them to login
if (!isset($_SESSION['is_valid_admin'])) {
    $action = 'login';
}

// Perform the specified action
switch ($action) {
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['is_valid_admin'] = true;
            // get the admins first name using their email
            $admin_first_name = get_admin_first_name_by_email($email); // Get the admins first name
            $_SESSION['admin_first_name'] = $admin_first_name; // Store in session
            setcookie("admin_logged_in", true, time() + (86400 * 30), "/"); // Set cookie for 30 days
            include('admin_menu.php'); // Show the main menu
        } else {
            $login_message = 'You must login to view this page.';
            include('login.php');
        }
        break;

    case 'show_admin_menu':
        include('admin_menu.php');
        break;

    case 'admin_view_messages':
        include('admin_view_messages.php');
        break;

    case 'admin_view_administrators':
        include('admin_view_administrators.php');
        break;

    case 'add_administrator':
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($name && $email && $password) {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Add the new administrator to the database
            add_administrator($name, $email, $hashed_password); // Ensure this function exists
            $message = "Administrator added successfully.";
        } else {
            $message = "Please fill out all fields correctly.";
        }
        include('add_administrator.php');
        break;

    case 'delete_administrator':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);

        if ($admin_id) {
            delete_admin($admin_id); // Call the function to delete the admin
            $message = "Administrator deleted successfully.";
        } else {
            $message = "Error deleting administrator. Please try again.";
        }
        header("Location: index.php?action=admin_view_administrators"); // Redirect to the admin view page
        exit();


    case 'delete_message':
        $message_id = filter_input(INPUT_POST, 'message_id', FILTER_VALIDATE_INT);
        if ($message_id) {
            delete_message($message_id);
        }
        // Refresh list
        header("Location: index.php?action=admin_view_messages");
        exit();

    case 'reply_to_message':
        $message_id = filter_input(INPUT_POST, 'message_id', FILTER_VALIDATE_INT);
        if ($message_id) {
            $message = get_contact_form_info_by_id($message_id); // Fetch contact form details by ID
            include('reply_message.php'); // Load the reply form
        }
        break;


    case 'send_reply':
        $message_id = filter_input(INPUT_POST, 'message_id', FILTER_VALIDATE_INT);
        $reply = filter_input(INPUT_POST, 'reply', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if ($message_id && $reply && $email) {
            $subject = "Reply to Your Message";
            $to = $email;
            $headers = "From: admin@pawsitivepets.com";

            if (mail($to, $subject, $reply, $headers)) {
                $_SESSION['reply_success'] = "Your reply has been sent successfully.";
            } else {
                $_SESSION['reply_error'] = "Failed to send the reply. Please try again.";
            }
        } else {
            $_SESSION['reply_error'] = "Invalid message ID or reply.";
        }

        header("Location: index.php?action=admin_view_messages");
        exit();




    case 'logout':
        $_SESSION = array();   // Clear all session data from memory
        session_destroy();     // Clean up the session ID
        setcookie("admin_logged_in", "", time() - 3600, "/"); // Delete cookie
        $login_message = 'You have been logged out.';
        include('login.php');
        break;
}
