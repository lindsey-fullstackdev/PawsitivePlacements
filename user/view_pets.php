<?php global $user_id;
include '../view/header.php';
require_once '../model/pet_db.php';
require_once '../model/users_db.php';

 $pets = get_pets_by_user_id($user_id);

?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Your Pets</h1>
                <p>Here you can view the details of your pets.</p>
            </section>

            <section class="pets-section mt-4">
                <section class="pets-section mt-4">
                    <?php if (!empty($pets)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Breed</th>
                                    <th>Age</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pets as $pet): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pet['name']); ?></td>
                                        <td><?= htmlspecialchars($pet['type']); ?></td>
                                        <td><?= htmlspecialchars($pet['breed']); ?></td>
                                        <td><?= htmlspecialchars($pet['age']); ?> years</td>
                                        <td>
                                            <form action="." method="post" class="d-inline">
                                                <input type="hidden" name="action" value="edit_pet">
                                                <input type="hidden" name="id" value="<?= $pet['id']; ?>">
                                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                            </form>
                                            <form action="." method="post" class="d-inline">
                                                <input type="hidden" name="action" value="delete_pet">
                                                <input type="hidden" name="id" value="<?= $pet['id']; ?>">
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
                            You have no pets registered. Consider adopting a new friend!
                        </div>
                    <?php endif; ?>
                </section>


                <section class="text-center mt-4">
                <form action="." method="post" class="d-inline">
                    <input type="hidden" name="action" value="add_pet">
                    <button type="submit" class="btn btn-primary">Add a New Pet</button>
                </form>
                <a href="user_account.php" class="btn btn-secondary">Back to Account</a>
            </section>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include '../view/footer.php'; ?>
