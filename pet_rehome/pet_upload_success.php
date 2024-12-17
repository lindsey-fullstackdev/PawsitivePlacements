<?php include '../view/header.php'; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Pet Uploaded Successfully!</h1>
                <p>Thank you for providing details about your pet.</p>
            </section>

            <section class="form-section mt-4">
                <h2 class="text-center">Pet Details</h2>

                <div class="alert alert-success" role="alert">
                    <strong>Pet Name:</strong> <?php if (isset($pet_name)) {
                        echo htmlspecialchars($pet_name);
                    } ?><br>
                    <strong>Pet Type:</strong> <?php if (isset($pet_type)) {
                        echo htmlspecialchars($pet_type);
                    } ?><br>
                    <strong>Breed:</strong> <?php if (isset($breed)) {
                        echo htmlspecialchars($breed);
                    } ?><br>
                    <strong>Age:</strong> <?php if (isset($age)) {
                        echo htmlspecialchars($age);
                    } ?><br>
                    <strong>Description:</strong> <?php if (isset($description)) {
                        echo nl2br(htmlspecialchars($description));
                    } ?><br>
                    <strong>City:</strong> <?php if (isset($city)) {
                        echo htmlspecialchars($city);
                    } ?><br>
                    <strong>Adoption Fee:</strong> $<?php if (isset($fee)) {
                        echo htmlspecialchars($fee);
                    } ?><br>
                    <strong>Gender:</strong> <?php if (isset($gender)) {
                        echo htmlspecialchars($gender);
                    } ?><br>
                    <strong>Gender:</strong> <?php if (isset($email)) {
                        echo htmlspecialchars($email);
                    } ?><br>
                    <?php if (!empty($image_url)): ?>
                        <strong>Image:</strong><br>
                        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($pet_name); ?>" class="img-fluid" style="max-width: 300px;">
                    <?php endif; ?>
                </div>

                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </section>
        </div>
    </div>
</div>

</body>

<?php include '../view/footer.php'; ?>
