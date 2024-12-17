<?php

global $username, $logged_in, $is_admin;

// Check if the admin is logged in
if (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
    $logged_in = true;
    $username = $_SESSION['admin_first_name'] ?? 'Admin';
    $is_admin = true; 
} else {
    $logged_in = false;
    $username = null;
    $is_admin = false; 
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="sidebar">

                <a href="../index.php"><i class="fas fa-home"></i> Home</a><br>
                <br><h2>Users</h2>
                <ul>
                    <li><a href="../user"><i class="fas fa-user-plus"></i> My Account </a></li>

                    <li><a href="../user/create_account.php"><i class="fas fa-user-plus"></i> Create Account </a></li>
                </ul><br>

                <?php if ($logged_in): ?>
                    <h2>Welcome</h2>
                    <p>Hello, <strong><?php echo htmlspecialchars($username); ?></strong></p>
                    <ul>
                        <?php if ($is_admin): ?>
                            <li><a href="../admins/index.php"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo $is_admin ? 'admins/index.php?action=logout' : 'user_accounts/index.php?action=logout'; ?>" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                <?php else: ?>
                    <p>Please log in to access your account.</p>
                <?php endif; ?>

                <h2>Administrators</h2>
                <ul>
                    <li><a href="../admins">Admin Menu</a></li>
                </ul><br>


                <h2>Quick Info</h2>
                <ul class="list-unstyled">
                    <li><strong>Our Mission:</strong> To find loving homes for every pet.</li>
                    <li><strong>Adoption Fees:</strong> Learn about our affordable fees for adopting.</li>
                    <li><strong>Volunteer Opportunities:</strong> Join us in making a difference!</li>
                </ul>

                <br>
                <h2>Pet Care Tips</h2>
                <ul class="list-unstyled">
                    <li>Regular Vet Visits</li>
                    <li>Proper Nutrition</li>
                    <li>Daily Exercise</li>
                    <li>Socialization with Other Pets</li>
                </ul>

                <br>
                <h2>Stay Connected</h2>
                <p>Follow us on social media for updates on pets and events!</p>
            </aside>
        </div>
    </div>
</div>
