<?php

require_once 'database.php';

/**
 * Retrieves all available pets from the database.
 * 
 * @return array|false Returns an array of all pets or false in case of an error.
 */
function get_all_pets(): array|false
{
    global $db;
    try {
        $query = 'SELECT * FROM pets';
        $statement = $db->prepare($query);
        $statement->execute();
        $pets = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $pets;
    } catch (PDOException $e) {
        error_log("Error fetching all pets: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves detailed information about a specific pet by its ID.
 * 
 * @param int $pet_id The ID of the pet to be retrieved.
 * @return array|false Returns an array with pet details or false if an error occurs.
 */
function get_pet($pet_id): array|false
{
    global $db;
    try {
        $query = "SELECT p.*, pi.image_path
                  FROM pets p
                  LEFT JOIN pet_images pi ON p.pet_id = pi.pet_id
                  WHERE p.pet_id = :pet_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':pet_id', $pet_id);
        $statement->execute();
        $pet = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $pet;
    } catch (PDOException $e) {
        error_log("Error fetching pet with ID {$pet_id}: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves pets based on search, city, and pet type criteria.
 * 
 * @param string|null $search The search term for pet name or description.
 * @param string|null $city The city to filter pets by.
 * @param string|null $pet_type The type of pet to filter by.
 * @return array|false Returns an array of pets matching the criteria, or false if an error occurs.
 */
function get_pets($search, $city, $pet_type): array|false
{
    global $db;
    try {
        $query = "SELECT p.*, pi.image_path 
                  FROM pets p 
                  LEFT JOIN pet_images pi ON p.pet_id = pi.pet_id 
                  WHERE 1=1";

        if (!empty($search)) {
            $query .= " AND (p.pet_name LIKE :search OR p.description LIKE :search)";
        }
        if (!empty($city)) {
            $query .= " AND p.city = :city";
        }
        if (!empty($pet_type)) {
            $query .= " AND p.pet_type = :pet_type"; // Directly filtering by pet_type in pets
        }

        $stmt = $db->prepare($query);

        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($city)) {
            $stmt->bindValue(':city', $city);
        }
        if (!empty($pet_type)) {
            $stmt->bindValue(':pet_type', $pet_type);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching pets based on search criteria: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves a pet by its name from the database.
 * 
 * @param string $name The name of the pet to be retrieved.
 * @return array|false Returns the pet details or false if an error occurs.
 */
function get_pet_by_name($name): array|false
{
    global $db;
    try {
        $query = 'SELECT * FROM pets WHERE pet_name = :pet_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':pet_name', $name);
        $statement->execute();
        $pet = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $pet;
    } catch (PDOException $e) {
        error_log("Error fetching pet with name {$name}: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves all distinct cities where pets are available.
 * 
 * @return array|false Returns an array of cities or false if an error occurs.
 */
function get_available_cities(): array|false
{
    global $db;
    try {
        $query = "SELECT DISTINCT city FROM pets";
        $statement = $db->prepare($query);
        $statement->execute();
        $cities = $statement->fetchAll(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        return $cities;
    } catch (PDOException $e) {
        error_log("Error fetching available cities: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Retrieves all distinct pet types from the database.
 * 
 * @return array|false Returns an array of pet types or false if an error occurs.
 */
function get_available_pet_types(): array|false
{
    global $db;
    try {
        $query = "SELECT DISTINCT pet_type FROM pets";
        $statement = $db->prepare($query);
        $statement->execute();
        $pet_types = $statement->fetchAll(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        return $pet_types;
    } catch (PDOException $e) {
        error_log("Error fetching available pet types: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    }
}

/**
 * Adds a new pet to the database.
 * 
 * @param string $pet_name The name of the pet.
 * @param string $pet_type The type of pet (e.g., dog, cat).
 * @param string $breed The breed of the pet.
 * @param int $age The age of the pet.
 * @param string $description A description of the pet.
 * @param string $city The city where the pet is located.
 * @param float $fee The adoption fee for the pet.
 * @param string $gender The gender of the pet.
 * @param int $user_id The ID of the user adding the pet.
 * @return bool Returns true if the pet was successfully added, false otherwise.
 */
function add_pet($pet_name, $pet_type, $breed, $age, $description, $city, $fee, $gender, $user_id): bool
{
    global $db;
    try {
        $query = 'INSERT INTO pets (pet_name, pet_type, breed, age, description, city, fee, gender, user_id)
                  VALUES (:pet_name, :pet_type, :breed, :age,  :description, :city, :fee, :gender, :user_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':pet_name', $pet_name);
        $statement->bindValue(':pet_type', $pet_type);
        $statement->bindValue(':breed', $breed);
        $statement->bindValue(':age', $age);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':fee', $fee);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        return $statement->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Error adding pet: " . $e->getMessage()); // Log the error for debugging purposes
        return false;
    } finally {
        $statement->closeCursor();
    }
}

?>
