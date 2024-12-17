<?php include '../view/header.php'; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Create a Pawsitive Placements Account</h1>
                <p>Please fill out the form below with your account details!</p>
            </section>

            <section class="form-section mt-4">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <h2>Create an Account</h2>
                <p>Complete the form below to create a new account and start the process of adopting or rehoming pets.</p>
                <form action="." method="post">
                    <input type="hidden" name="action" value="create_account_submit">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($username ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= htmlspecialchars($first_name ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?= htmlspecialchars($last_name ?? '') ?>" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Create Account">
                </form>
            </section>
        </div>
    </div>
</div>

</body>

<?php include '../view/footer.php'; ?>
