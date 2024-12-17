<?php
include '../view/header.php';

$administrators = get_all_admins();
?>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar_admin.php'; ?>
        </div>
        <div class="col-md-9">
            <h1 class="text-center">Administrators</h1>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered mt-4">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($administrators)): ?>
                    <?php foreach ($administrators as $admin): ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['adminID']); ?></td>
                            <td><?= htmlspecialchars($admin['firstName'] . ' ' . $admin['lastName']); ?></td>
                            <td><?= htmlspecialchars($admin['emailAddress']); ?></td>
                            <td>
                                <form action="index.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete_administrator">
                                    <input type="hidden" name="admin_id" value="<?= htmlspecialchars($admin['adminID']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this administrator?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No administrators found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="add_administrator.php" class="btn btn-secondary mt-3">Add New Administrator</a>
                <a href="index.php?action=show_admin_menu" class="btn btn-secondary mt-3">Back to Admin Menu</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php include '../view/footer.php'; ?>
