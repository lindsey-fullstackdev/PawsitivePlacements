<?php include '../view/header.php'; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar_admin.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Admin Login</h1>
                <p>Please enter your credentials to access the admin panel.</p>
            </section>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>


            <div class="form-container">
                    <form action="." method="post" id="login_form" class="needs-validation" novalidate>
                        <input type="hidden" name="action" value="login">

                        <div class="form-group">
                            <label for="email">E-Mail <span class="text-danger">*</span>:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required aria-label="Email Address">
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span>:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required aria-label="Password">
                        </div>

                        <div class="text-center mt-4">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Login</button>
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
<?php include '../view/footer.php'; ?>
