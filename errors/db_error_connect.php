<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>

<main class="container mt-5">
    <div class="alert alert-danger text-center">
        <h1 class="display-4">Database Error</h1>
        <p>An error occurred while connecting to the database.</p>
        <p>The database must be installed as described in Appendix A.</p>
        <p>The database must be running as described in Chapter 1.</p>
        <hr class="my-4">
        <p class="font-italic"> <strong><?php if (isset($error_message)) {
                    echo htmlspecialchars($error_message);
                } ?></strong></p>
        <a href="../index.php" class="btn btn-primary btn-lg mt-3">Return to Home</a>
    </div>
</main>
<?php include '../view/footer.php'; ?>