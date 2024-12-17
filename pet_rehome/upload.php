<?php include '../view/header.php'; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Rehome a Pet</h1>
                <p>Please fill out the form below with information about the pet you would like to rehome.</p>
            </section>


            <section class="form-section mt-4">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <h1 class="text-center my-4">Upload Your Pet that Needs Rehoming</h1>
                <div class="form-container">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="submit_form">

                        <div class="form-group">
                            <label for="pet_name">Pet Name</label>
                            <input type="text" name="pet_name" id="pet_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pet_type"> Pet Type</label>
                            <input type="text" name="pet_type" id="pet_type" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="breed"> Breed</label>
                            <input type="text" name="breed" id="breed" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="age"> Age</label>
                            <input type="text" name="age" id="age" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description"> Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="city"> City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="fee"> Adoption Fee</label>
                            <input type="number" name="fee" id="fee" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label for="image_url"> Image </label>
                            <input type="file" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Pet</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>


</body>

<?php include '../view/footer.php'; ?>