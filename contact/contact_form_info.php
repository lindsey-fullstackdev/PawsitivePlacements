<?php include '../view/header.php'; ?>
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

                <div class="form-container">
                    <form action="index.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="action" value="submit_form">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter your name.
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span>:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" value="<?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="comments">Comments/Message:</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Your message here..."><?php echo htmlspecialchars($_SESSION['comments'] ?? ''); ?></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Clear</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
include '../view/footer.php';
?>
