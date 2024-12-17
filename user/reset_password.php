<?php include '../view/header.php'; ?>

<body>

<div class="container">
    <section class="hero-section text-center my-4">
        <h1>Reset Your Password</h1>
        <p>Please fill out the form below to reset your password for your account.</p>
    </section>

    <section class="form-section mt-4">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form action="." method="post">
            <input type="hidden" name="action" value="reset_password_submit">

            <div class="form-group">
                <label for="username_or_email">Username or Email:</label>
                <input type="text" class="form-control" name="username_or_email" id="username_or_email" value="<?= htmlspecialchars($username_or_email ?? '') ?>" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Reset Password">
        </form>

        <p>If you remember your password, you can <a href="?action=login">log in here</a>.</p>
    </section>
</div>

</body>
</html>

<?php include '../view/footer.php'; ?>
