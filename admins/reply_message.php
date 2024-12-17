<?php
include '../view/header.php';

// Check for success or error messages
$reply_success = '';
$reply_error = '';

if (isset($_SESSION['reply_success'])) {
    $reply_success = $_SESSION['reply_success'];
    unset($_SESSION['reply_success']); // Clear the message after displaying
}

if (isset($_SESSION['reply_error'])) {
    $reply_error = $_SESSION['reply_error'];
    unset($_SESSION['reply_error']); // Clear the message after displaying
}

// Fetch contact messages from the database
$messages = get_contact_form_info();

?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar_admin.php'; ?>
        </div>
        <div class="col-md-9">
            <h1 class="mt-4">Admin - View Contact Form Submissions</h1>

            <?php if ($reply_success): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($reply_success) ?>
                </div>
            <?php endif; ?>

            <?php if ($reply_error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($reply_error) ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered mt-4">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Comments</th>
                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($msg['id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($msg['name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($msg['email'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($msg['phone'] ?? ''); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($msg['comments'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($msg['created_at'] ?? ''); ?></td>
                            <td>
                                <form action="index.php" method="post" class="d-inline">
                                    <input type="hidden" name="action" value="delete_message">
                                    <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($msg['id']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">Delete</button>
                                </form>
                                <form action="index.php" method="post" class="d-inline">
                                    <input type="hidden" name="action" value="reply_to_message">
                                    <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($msg['id']); ?>">
                                    <button type="submit" class="btn btn-info btn-sm">Reply</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No messages found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <form action="index.php" method="post" class="d-inline">
                    <input type="hidden" name="action" value="show_admin_menu">
                    <button type="submit" class="btn btn-primary">Back to Admin Menu</button>
                </form>
                <form action="index.php" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to logout?');">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

<?php include '../view/footer.php'; ?>
