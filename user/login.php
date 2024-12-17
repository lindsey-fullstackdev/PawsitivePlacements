<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsitive Placements - User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>User Login</h1>
                <p>You must log in before you can adopt or rehome your pet.</p>
            </section>

            <section class="form-section mt-4">
                <?php if (isset($message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form action="." method="post">
                    <input type="hidden" name="action" value="login">

                    <input type="hidden" name="pet_id" value="<?= htmlspecialchars($pet_id ?? '') ?>">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($username ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Login">
                </form>

                <p>Don't have an account? <a href="?action=create_account" class="btn btn-link">Create a new account</a></p>
                <p>Forgot your password? <a href="?action=reset_password" class="btn btn-link">Reset your password</a></p>
            </section>
        </div>
    </div>
</div>

</body>
</html>

<?php include '../view/footer.php'; ?>
