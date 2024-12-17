<?php
require_once('../util/secure_conn.php');  // Require a secure connection
require_once('../util/valid_user.php');  // Require a valid admin user
include '../view/header.php';
?>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar_admin.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1 class="display-4">Welcome to the Admin Dashboard</h1>
                <p class="lead">Manage users, pets, and more efficiently from this panel.</p>
            </section>

            <section class="dashboard-section mb-4">
                <h3 class="text-center mb-4">Quick Actions</h3>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h5 class="card-title">View Contact Form Submissions</h5>
                                <p class="card-text">Check messages from users and respond promptly.</p>
                                <a href="index.php?action=admin_view_messages" class="btn btn-primary">View Messages</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h5 class="card-title">View Administrators</h5>
                                <p class="card-text">Manage administrator accounts easily.</p>
                                <a href="index.php?action=admin_view_administrators" class="btn btn-primary">View Admins</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="text-center">
                <h3 class="mb-4">Ready to Manage?</h3>
                <p>With just a few clicks, you can manage users and their queries, add new administrators, and maintain an organized system.</p>
                <p>Stay connected and make the most of your administrative capabilities.</p>
            </section>

            <section class="text-center my-4">
                <h4>Logout</h4>
                <form action="index.php" method="POST" class="d-inline">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include '../view/footer.php'; ?>
