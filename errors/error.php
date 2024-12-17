<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>

    <main class="container mt-5">
        <div class="alert alert-danger text-center">
            <h1 class="display-4">Oops, we've ran into an error.</h1>
            <p>An error occurred while loading the webpage.</p>
            <p>Please wait a minute, or try again later.</p>
            <hr class="my-4">
            <p class="font-italic"> <strong><?php if (isset($error_message)) {
                        echo htmlspecialchars($error_message);
                    } ?></strong></p>
            <a href="../index.php" class="btn btn-primary btn-lg mt-3">Return to Home</a>
        </div>
    </main>
<?php include '../view/footer.php'; ?>