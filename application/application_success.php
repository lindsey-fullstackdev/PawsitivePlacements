<?php
require_once('../model/pet_db.php');
include '../view/header.php';

// Assuming you have stored these values in the session or passed them via the URL
// If you're using session, make sure to start the session at the beginning of your script
session_start();

// Retrieve the application details from the session or variables
$name = $_SESSION['application_name'] ?? 'Unknown';
$email = $_SESSION['application_email'] ?? 'Unknown';
$phone = $_SESSION['application_phone'] ?? 'Unknown';
$pet_id = $_SESSION['application_pet_id'] ?? null;

// Fetch the pet details based on pet_id
$pet = null;
if ($pet_id) {
    $pet = get_pet($pet_id); // Get pet details by ID
}

?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Application Submitted Successfully!</h1>
                <p>Thank you for submitting your application. Here are the details:</p>
            </section>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Applicant Details</h5>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                </div>
            </div>

            <?php if ($pet): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pet Details</h5>
                        <p><strong>Pet Name:</strong> <?php echo htmlspecialchars($pet['pet_name']); ?></p>
                        <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?></p>
                        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>
                        <p><strong>Adoption Fee:</strong> $<?php echo htmlspecialchars($pet['fee']); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Pet details could not be found.
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="../pets/index.php" class="btn btn-secondary">Back to Pets</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php include '../view/footer.php'; ?>
