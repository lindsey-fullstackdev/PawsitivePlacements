<?php
require_once('../model/pet_db.php'); // Include the pet database model
require_once('../model/database.php'); // Include the main database model

// Get and sanitize input from the user
$pet_id = filter_input(INPUT_GET, 'pet_id', FILTER_VALIDATE_INT); // Validate and sanitize pet_id
$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Sanitize search input
$city = filter_input(INPUT_GET, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Sanitize city input
$pet_type = filter_input(INPUT_GET, 'pet_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Sanitize pet_type input
// Fetch available cities and pet types
$cities = get_available_cities(); // This should return an array of cities
$pet_types = get_available_pet_types(); // Create this function to return an array of pet types

// Determine the action to perform based on input
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_pets'; // Default to list_pets

// Perform actions based on the requested action
switch ($action) {
    case 'list_pets':
        // Fetch pets based on search criteria or get all pets if no filters are applied
        $pets = get_pets($search, $city, $pet_type);
        include('pet_list.php'); // Include the pet list view
        break;

    case 'pet_detail':
        // Fetch the pet details for the specified pet_id
        $pet = get_pet($pet_id); // Get pet details
        if (!$pet) { // If pet is not found
            $error = "Pet not found."; // Set error message
            include('../errors/error.php'); // Include error view
            exit(); // Exit the script
        }
        include('pet_detail.php'); // Include the pet detail view
        break;

    case 'get_cities':
        // Fetch available cities for the pets
        $cities = get_available_cities(); // Get list of available cities
        break;

    default:
        // If no valid action is found, list all the pets
        $pets = get_all_pets(); // Get all pets
        include('pet_list.php'); // Include the pet list view
        break;
}
