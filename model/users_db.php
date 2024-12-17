<?php

require_once '../model/database.php';

/**
 * Retrieves a user by their username and password.
 * 
 * @param string $username The username of the user.
 * @param string $password The password of the user.
 * @return array|false Returns user details as an array or false if no match is found.
 */
function get_user_by_username_password($username, $password) {
    global $db;
    try {
        $query = 'SELECT * FROM users WHERE username = :username AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        error_log("Error retrieving user by username and password: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves all pets owned by a specific user by their user ID.
 * 
 * @param int $user_id The ID of the user whose pets are to be retrieved.
 * @return array|false Returns an array of pets or false if no pets are found or if an error occurs.
 */
function get_pets_by_user_id($user_id): false|array
{
    global $db;
    try {
        $query = 'SELECT * FROM pets WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $pets = $statement->fetchAll();
        $statement->closeCursor();
        return $pets;
    } catch (PDOException $e) {
        error_log("Error retrieving pets by user ID: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Adds a new user to the database.
 * 
 * @param string $name The name of the user.
 * @param string $username The username of the user.
 * @param string $email The email of the user.
 * @param string $phone The phone number of the user.
 * @param string $password The password for the user's account.
 * @return bool Returns true if the user is successfully added, false otherwise.
 */
function add_user($name, $username, $email, $phone, $password): bool {
    global $db;
    try {
        $query = 'INSERT INTO users (name, username, email, phone, password) 
                  VALUES (:name, :username, :email, :phone, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':password', $password);
        return $statement->execute();
    } catch (PDOException $e) {
        error_log("Error adding user: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves a user by their username or email.
 * 
 * @param string $username_or_email The username or email of the user.
 * @return array|false Returns user details if found, or false if no match is found.
 */
function get_user_by_username_or_email($username_or_email) {
    global $db;
    try {
        $query = 'SELECT * FROM users WHERE username = :username_or_email OR email = :username_or_email';
        $statement = $db->prepare($query);
        $statement->bindValue(':username_or_email', $username_or_email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        error_log("Error retrieving user by username or email: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Adds a contact form submission to the database.
 * 
 * @param string $name The name of the person submitting the contact form.
 * @param string $email The email of the person submitting the contact form.
 * @param string $phone The phone number of the person submitting the contact form.
 * @param string $comments The comments or message from the contact form.
 * @return bool Returns true if the contact information was successfully added, false otherwise.
 */
function add_contact_form_info($name, $email, $phone, $comments): bool
{
    global $db;
    try {
        $stmt = $db->prepare("INSERT INTO contact_form_info (name, email, phone, comments)
        VALUES (:name, :email, :phone, :comments)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error adding contact form info: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves a user by their email address.
 * 
 * @param string $email The email address of the user to be retrieved.
 * @return array|false Returns the user details or false if the user is not found.
 */
function get_user_id_by_email($email) {
    global $db;
    try {
        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        error_log("Error retrieving user by email: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves a user by their user ID.
 * 
 * @param int $user_id The ID of the user to be retrieved.
 * @return array|false Returns the user details or false if the user is not found.
 */
function get_user_by_id($user_id) {
    global $db;
    try {
        $query = 'SELECT * FROM users WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        error_log("Error retrieving user by ID: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

?>
