<?php

/**
 * Retrieves a user's address details based on their user ID.
 * 
 * @param int $user_id The ID of the user whose address details are to be retrieved.
 * @return false|array Returns an array of address details or false in case of an error.
 */
function get_addresses_by_user_id($user_id): false|array
{
    global $db;
    try {
        $query = 'SELECT * FROM addresses WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $addresses = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $addresses;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Adds an address to the database for a specific user.
 * 
 * @param int $user_id The ID of the user to whom the address belongs.
 * @param string $line1 The first line of the address.
 * @param string $line2 The second line of the address (optional).
 * @param string $city The city of the address.
 * @param string $province The province of the address.
 * @param string $postal_code The postal code of the address.
 * @param string $phone The phone number associated with the address.
 * @return bool Returns true if the address is successfully added, false otherwise.
 */
function add_address($user_id, $line1, $line2, $city, $province, $postal_code, $phone): bool {
    global $db;
    try {
        $query = 'INSERT INTO addresses (user_id, line1, line2, city, province, postal_code, phone) 
                  VALUES (:user_id, :line1, :line2, :city, :province, :postal_code, :phone)';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':line1', $line1);
        $statement->bindValue(':line2', $line2);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':province', $province);
        $statement->bindValue(':postal_code', $postal_code);
        $statement->bindValue(':phone', $phone);
        return $statement->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves a user's addresses along with their username.
 * 
 * @param int $user_id The ID of the user whose addresses are to be retrieved.
 * @return false|array Returns an array of addresses, or false if an error occurs.
 */
function get_user_addresses($user_id): false|array
{
    global $db;
    try {
        $query = "SELECT u.user_id, u.username, a.*
                  FROM users u
                  JOIN addresses a ON u.user_id = a.user_id
                  WHERE u.user_id = :user_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $addresses = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $addresses;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Updates an existing address in the database.
 * 
 * @param int $address_id The ID of the address to be updated.
 * @param string $line1 The first line of the address.
 * @param string $line2 The second line of the address (optional).
 * @param string $city The city of the address.
 * @param string $province The province of the address.
 * @param string $postal_code The postal code of the address.
 * @param string $phone The phone number associated with the address.
 * @return bool Returns true if the address was successfully updated, false otherwise.
 */
function update_address($address_id, $line1, $line2, $city, $province, $postal_code, $phone): bool {
    global $db;
    try {
        $query = 'UPDATE addresses SET line1 = :line1, line2 = :line2, city = :city, 
                  province = :province, postal_code = :postal_code, phone = :phone 
                  WHERE address_id = :address_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':address_id', $address_id);
        $statement->bindValue(':line1', $line1);
        $statement->bindValue(':line2', $line2);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':province', $province);
        $statement->bindValue(':postal_code', $postal_code);
        $statement->bindValue(':phone', $phone);
        return $statement->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Deletes an address from the database.
 * 
 * @param int $address_id The ID of the address to be deleted.
 * @return bool Returns true if the address was successfully deleted, false otherwise.
 */
function delete_address($address_id): bool {
    global $db;
    try {
        $query = 'DELETE FROM addresses WHERE address_id = :address_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':address_id', $address_id);
        return $statement->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves an address from the database based on its ID.
 * 
 * @param int $address_id The ID of the address to be retrieved.
 * @return array|false Returns the address data as an associative array, or false if an error occurs.
 */
function get_address_by_id($address_id) {
    global $db;
    try {
        $query = 'SELECT * FROM addresses WHERE address_id = :address_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':address_id', $address_id);
        $statement->execute();
        $address = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $address;
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

?>
