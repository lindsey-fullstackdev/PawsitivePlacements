<?php
require_once('../model/pet_db.php');
include '../view/header.php';

// Fetch the pet details based on pet_id
$pet_id = filter_input(INPUT_GET, 'pet_id', FILTER_VALIDATE_INT);
$pet = get_pet($pet_id);

if (!$pet) {
    $error = "Pet not found.";
    include('../errors/error.php');
    exit();
}
?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="pet-detail-section my-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h1><?php echo htmlspecialchars($pet['pet_name']); ?></h1>
                        <div class="text-center mb-4">
                            <img src="<?php echo htmlspecialchars($pet['image_path'] ?: '../images/default_image.png'); ?>"
                                 alt="<?php echo htmlspecialchars($pet['pet_name']); ?>"
                                 class="img-fluid" style="max-width: 600px; height: auto;">
                        </div>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h3 class="card-title">Pet Details</h3>
                        <p class="card-text"><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>
                        <p class="card-text"><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                        <p class="card-text"><strong>Gender:</strong> <?php echo htmlspecialchars($pet['gender']); ?></p>
                        <p class="card-text"><strong>City:</strong> <?php echo htmlspecialchars($pet['city']); ?></p>
                        <p class="card-text"><strong>Adoption Fee:</strong> $<?php echo htmlspecialchars($pet['fee']); ?></p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="../application/application_form.php?pet_id=<?php echo htmlspecialchars($pet_id); ?>" class="btn btn-secondary">Adopt Me!</a>
                    <a href="../pets/index.php" class="btn btn-secondary">Back to Pets</a>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php include '../view/footer.php'; ?>
