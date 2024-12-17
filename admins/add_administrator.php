<?php
include '../view/header.php';
require_once('../model/database.php');
require_once('../model/admin_db.php');
require_once('../util/secure_conn.php');  
require_once('../util/valid_admin.php'); 


$administrators = get_all_admins();
?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar_admin.php'; ?>
        </div>
        <div class="col-md-9">
            <h1 class="text-center">Administrators</h1>
            <?php if (isset($message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($message) ?>
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

            <h2 class="mt-4">Add New Administrator</h2>
            <form action="index.php" method="POST" class="mt-3">
                <input type="hidden" name="action" value="add_administrator">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required aria-label="Administrator Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required aria-label="Administrator Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required aria-label="Administrator Password">
                </div>
                <button type="submit" class="btn btn-primary">Add Administrator</button>
            </form>

            <div class="text-center mt-4">
                <form action="index.php" method="POST" class="d-inline">
                    <input type="hidden" name="action" value="show_admin_menu">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?action=show_admin_menu'">Cancel</button>
                </form>
                <form action="index.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to logout?');">
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
