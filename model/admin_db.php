<?php

/**
 * Verifies if the admin login is valid by comparing the hashed password.
 * 
 * @param string $email The admin's email address.
 * @param string $password The admin's plaintext password.
 * @return bool Returns true if the email and password match, false otherwise.
 */
function is_valid_admin_login($email, $password): bool
{
    global $db;
    try {
        $query = 'SELECT password FROM administrators WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        // Check if password matches the hashed password stored in the database
        if ($row !== false) {
            $storedPassword = $row['password'];
            return password_verify($password, $storedPassword); // Use password_verify for secure comparison
        }
        return false;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
        return false;
    }
}

/**
 * Deletes a message from the contact form by its ID.
 * 
 * @param int $message_id The ID of the message to delete.
 * @return void
 */
function delete_message($message_id): void
{
    global $db;
    try {
        $query = 'DELETE FROM contact_form_info WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $message_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
    }
}

/**
 * Retrieves all administrators from the database.
 * 
 * @return array|false Returns an array of administrators, or false if an error occurs.
 */
function get_all_admins(): false|array
{
    global $db;
    try {
        $query = 'SELECT adminID, firstName, lastName, emailAddress FROM administrators';
        $statement = $db->prepare($query);
        $statement->execute();
        $administrators = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $administrators;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
        return false;
    }
}

/**
 * Retrieves the first name of an admin based on their email address.
 * 
 * @param string $email The admin's email address.
 * @return string|null Returns the first name of the admin, or null if not found.
 */
function get_admin_first_name_by_email($email)
{
    global $db;
    try {
        $query = 'SELECT firstName FROM administrators WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        return $admin ? $admin['firstName'] : null;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
        return null;
    }
}

/**
 * Adds a new administrator to the database with a hashed password.
 * 
 * @param string $name The full name of the administrator.
 * @param string $email The email address of the administrator.
 * @param string $hashed_password The hashed password of the administrator.
 * @return void
 */
function add_administrator($name, $email, $hashed_password): void
{
    global $db;
    try {
        $query = 'INSERT INTO administrators (firstName, lastName, emailAddress, password) 
                  VALUES (:firstName, :lastName, :emailAddress, :password)';
        $statement = $db->prepare($query);
        $name_parts = explode(' ', $name, 2);
        $firstName = $name_parts[0];
        $lastName = $name_parts[1] ?? '';
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':emailAddress', $email);
        $statement->bindValue(':password', $hashed_password);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
    }
}

/**
 * Deletes an administrator by their ID.
 * 
 * @param int $admin_id The ID of the administrator to delete.
 * @return void
 */
function delete_admin($admin_id): void
{
    global $db;
    try {
        $query = 'DELETE FROM administrators WHERE adminID = :admin_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
    }
}

/**
 * Retrieves all contact form submissions from the database.
 * 
 * @return array An array of all contact form submissions.
 */
function get_contact_form_info(): array
{
    global $db;
    try {
        $query = 'SELECT * FROM contact_form_info';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
        return [];
    }
}

/**
 * Retrieves a specific contact form submission by its ID.
 * 
 * @param int $id The ID of the contact form submission to retrieve.
 * @return array An array containing the contact form data, or an empty array if not found.
 */
function get_contact_form_info_by_id($id): array
{
    global $db;
    try {
        $query = 'SELECT * FROM contact_form_info WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result ?: [];
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error
        return [];
    }
}

?>
