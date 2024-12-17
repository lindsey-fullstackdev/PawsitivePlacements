<?php global $username, $logged_in, $is_admin; ?>
<aside class="sidebar">

    <?php if ($logged_in): ?>
        <h2><?php echo $is_admin ? 'Admin Dashboard' : 'User Dashboard'; ?></h2>
        <div class="user-info">
            <p>Welcome, <strong><?php echo htmlspecialchars($username); ?></strong></p>
        </div>
    <?php else: ?>
        <h2>Welcome</h2>
        <p>Please log in to access your account.</p>
    <?php endif; ?>

    <?php if ($is_admin): ?>
        <ul>
            <li><a href="../admins/index.php?action=show_admin_menu"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="../admins/index.php?action=admin_view_messages"><i class="fas fa-envelope"></i> View Messages</a></li>
            <li><a href="../admins/index.php?action=admin_view_administrators"><i class="fas fa-users"></i> Manage Administrators</a></li>
            <li><a href="../admins/index.php?action=add_administrator"><i class="fas fa-user-plus"></i> Add Administrator</a></li>
            <li><a href="../admins/index.php?action=logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    <?php else: ?>
        <ul>
            <li><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../user/index.php?action=login"><i class="fas fa-user"></i> My Account</a></li>
            <li><a href="../user/index.php?action=logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    <?php endif; ?>

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
