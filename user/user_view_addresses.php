<?php include '../view/header.php'; ?>
<?php require_once '../model/address_db.php'; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Your Addresses</h1>
                <p>Manage your addresses below.</p>
            </section>

            <section class="address-section mt-4">
                <?php if (!empty($addresses)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Address Line 1</th>
                                <th>Address Line 2</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Postal Code</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($addresses as $address): ?>
                                <tr>
                                    <td><?= htmlspecialchars($address['line1']); ?></td>
                                    <td><?= htmlspecialchars($address['line2']); ?></td>
                                    <td><?= htmlspecialchars($address['city']); ?></td>
                                    <td><?= htmlspecialchars($address['province']); ?></td>
                                    <td><?= htmlspecialchars($address['postal_code']); ?></td>
                                    <td><?= htmlspecialchars($address['phone']); ?></td>
                                    <td>
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="edit_address">
                                            <input type="hidden" name="id" value="<?= $address['id']; ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="delete_address">
                                            <input type="hidden" name="id" value="<?= $address['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        You have no addresses registered. Please add a new address!
                    </div>
                <?php endif; ?>
            </section>

            <section class="edit-address-section mt-4">
                <h3>Edit Address</h3>
                <?php if (isset($edit_address)): ?>
                    <form action="." method="post" id="edit_address_form">
                        <input type="hidden" name="action" value="edit_address_submit">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($edit_address['id']); ?>">

                        <div class="form-group">
                            <label for="line1">Address Line 1 <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="line1" name="line1" value="<?= htmlspecialchars($edit_address['line1']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="line2">Address Line 2:</label>
                            <input type="text" class="form-control" id="line2" name="line2" value="<?= htmlspecialchars($edit_address['line2']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="city">City <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($edit_address['city']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Province <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="province" name="province" value="<?= htmlspecialchars($edit_address['province']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= htmlspecialchars($edit_address['postal_code']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($edit_address['phone']); ?>" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Update Address</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p>No address selected for editing. Please select an address to edit.</p>
                <?php endif; ?>
            </section>

            <section class="add-address-section mt-4">
                <h3>Add New Address</h3>
                <form action="." method="post" id="add_address_form">
                    <input type="hidden" name="action" value="add_address">
                    <div class="form-group">
                        <label for="line1_new">Address Line 1 <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="line1_new" name="line1" required>
                    </div>
                    <div class="form-group">
                        <label for="line2_new">Address Line 2:</label>
                        <input type="text" class="form-control" id="line2_new" name="line2">
                    </div>
                    <div class="form-group">
                        <label for="city_new">City <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="city_new" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="province_new">Province <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="province_new" name="province" required>
                    </div>
                    <div class="form-group">
                        <label for="postal_code_new">Postal Code <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="postal_code_new" name="postal_code" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_new">Phone <span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="phone_new" name="phone" required>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Add Address</button>
                    </div>
                </form>
            </section>

            <section class="text-center mt-4">
                <a href="user_account.php" class="btn btn-secondary">Back to Account</a>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include '../view/footer.php'; ?>
