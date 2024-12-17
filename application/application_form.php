<?php
require_once('../model/pet_db.php');
include '../view/header.php';

$pet_id = filter_input(INPUT_GET, 'pet_id', FILTER_VALIDATE_INT);
$pet_name = filter_input(INPUT_GET, 'pet_name', FILTER_SANITIZE_SPECIAL_CHARS);

if ($pet_id) {
    $pet = get_pet($pet_id); 
} elseif ($pet_name) {
    $pet = get_pet_by_name($pet_name); 
} else {
    $error = "Pet not found.";
    include('../errors/error.php');
    exit();
}

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
            <section class="hero-section text-center my-4">
                <h1>Inquire About Adopting a Pet</h1>
                <p>Please fill out the form below with information for the owner about the pet you would like to adopt.</p>
            </section>
            <h1 class="text-center my-4">Pet: <?php echo htmlspecialchars($pet['pet_name']); ?></h1>

            <section class="form-section mt-4">
                <p>Please fill out the form below to send a message to the owner of the pet to let them know you are interested in adopting this pet.</p>
                <p>Your application helps us ensure that our pets who need loving homes are matched with suitable adopters. You will be contacted shortly after submission.</p>

                <form action="index.php?action=process_application" method="post">
                    <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($pet['pet_id']); ?>">

                    <div class="form-group">
                        <label for="name">Your Name <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Your Phone Number <span class="text-danger">*</span>:</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email <span class="text-danger">*</span>:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message to Owner:</label>
                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<?php include '../view/footer.php'; ?>
