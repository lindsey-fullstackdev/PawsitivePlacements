<?php
global $db;
session_start(); // Start the session
require_once '../model/pet_db.php';
require_once '../model/users_db.php';
require_once '../model/database.php';

// If the user is logged in, handle the image upload and pet details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the email from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Get user ID based on email
    $user_id = get_user_id_by_email($email);

    // Check if a valid user ID was returned
    if ($user_id === false) {
        // Redirect to create account page if no user is found
        header('Location: ../account/account_view.php');
        exit();
    }

    // Gather pet details from the form
    $pet_name = $_POST['pet_name'];
    $pet_type = $_POST['pet_type'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $city = $_POST['city'];
    $fee = $_POST['fee'];
    $gender = $_POST['gender'];

    // Prepare and execute the insert statement for the pet details
    $stmt = $db->prepare("INSERT INTO pets (user_id, pet_name, pet_type, breed, age, description, city, fee, gender) 
                          VALUES (:user_id, :pet_name, :pet_type, :breed, :age, :description, :city, :fee, :gender)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':pet_name', $pet_name);
    $stmt->bindParam(':pet_type', $pet_type);
    $stmt->bindParam(':breed', $breed);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':fee', $fee);
    $stmt->bindParam(':gender', $gender);

    $stmt->execute();

    // Get the last inserted pet_id
    $pet_id = $db->lastInsertId();

    // Initialize image URL variable
    $image_url = '';

    // Check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_path = '../images/' . basename($image_name); // Ensure safe file path

        // Move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            // Prepare and execute the insert statement for the image
            $stmt = $db->prepare("INSERT INTO pet_images (user_id, pet_id, image_name, image_path) VALUES (:user_id, :pet_id, :image_name, :image_path)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':pet_id', $pet_id); // Link the image to the pet
            $stmt->bindParam(':image_name', $image_name);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->execute();

            // Set the image URL for displaying
            $image_url = $image_path;
        } else {
            echo 'Error uploading image!';
            exit();
        }
    } else {
        echo 'No image uploaded or there was an upload error!';
        exit();
    }

    // Redirect to the success page and pass data
    include 'pet_upload_success.php'; // Include success page
    exit();
}
?>

<?php include 'upload.php'; ?>
