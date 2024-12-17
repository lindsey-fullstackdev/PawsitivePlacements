<?php
session_start();
include '../view/header.php'; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Contact Us</h1>
                <p>Please fill out the form below to reach out to us.</p>
            </section>

            <section class="form-section mt-4">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>


            <section class="success-section text-center my-5">
                <h1 class="display-4">Thank You!</h1>
                <p class="lead">Your message has been sent successfully. We'll get back to you soon.</p>

                <h3>Your Submitted Information:</h3>
                <ul class="list-unstyled">
                    <li><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['name'] ?? ''); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['email'] ?? ''); ?></li>
                    <li><strong>Phone Number:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['phone'] ?? ''); ?></li>
                    <li><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($_SESSION['form_data']['comments'] ?? '')); ?></li>
                </ul>

                <div class="mt-4">
                    <a href="contact_form_info.php" class="btn btn-secondary">Go Back</a>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php
// Clear session data after displaying
unset($_SESSION['form_data']);
?>
<?php
include '../view/footer.php';
?>
