<?php

/**
 * Adds an adoption application to the database for a user and pet.
 * 
 * @param int $user_id The ID of the user applying for adoption.
 * @param int $pet_id The ID of the pet being applied for.
 * @param string $name The name of the applicant.
 * @param string $email The email address of the applicant.
 * @param string $phone The phone number of the applicant.
 * @param string $message The application message from the user.
 * @return void
 */
function add_application($user_id, $pet_id, $name, $email, $phone, $message): void
{
    global $db;

    // Prepare SQL query to insert the application
    $query = 'INSERT INTO applications (user_id, pet_id, application_date, status)
              VALUES (:user_id, :pet_id, NOW(), :status)';
    $statement = $db->prepare($query);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':pet_id', $pet_id);
    $statement->bindValue(':status', 'pending');

    try {
        // Execute the statement to insert the application
        $statement->execute();
    } catch (PDOException $e) {
        // Log any errors that occur during execution
        error_log("Error adding application: " . $e->getMessage());
    } finally {
        // Close the cursor after the query is executed
        $statement->closeCursor();
    }
}

/**
 * Adds a message to the messages table in the database.
 * 
 * @param int $user_id The ID of the user sending the message.
 * @param int $pet_id The ID of the pet related to the message.
 * @param string $message The content of the message.
 * @param string $email The email address of the user sending the message.
 * @return void
 */
function add_message($user_id, $pet_id, $message, $email): void
{
    global $db;

    // Prepare SQL query to insert the message
    $query = 'INSERT INTO messages (user_id, pet_id, message, email) 
              VALUES (:user_id, :pet_id, :message, :email)';
    $statement = $db->prepare($query);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':pet_id', $pet_id);
    $statement->bindValue(':message', $message);
    $statement->bindValue(':email', $email);

    try {
        // Execute the statement to insert the message
        $statement->execute();
    } catch (PDOException $e) {
        // Log any errors that occur during execution
        error_log("Error adding message: " . $e->getMessage());
    } finally {
        // Close the cursor after the query is executed
        $statement->closeCursor();
    }
}

/**
 * Retrieves the user ID based on the provided email address.
 * 
 * @param string $email The email address of the user.
 * @return int|null Returns the user ID if found, or null if not found.
 */
function get_user_id_by_email($email): ?int
{
    global $db;

    // Prepare SQL query to retrieve user ID by email
    $query = 'SELECT user_id FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);

    try {
        // Execute the query and fetch the result
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log any errors that occur during execution
        error_log("Error fetching user ID by email: " . $e->getMessage());
        return null;
    } finally {
        // Close the cursor after the query is executed
        $statement->closeCursor();
    }

    return $user ? (int)$user['user_id'] : null;
}

?>
