<?php include '../view/header.php'; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>


                <div class="col-md-9">
                    <section class="hero-section text-center my-4">
                        <h1 class="display-4">Welcome to the User Dashboard</h1>
                        <p class="lead">Manage user account info, pets, and more efficiently from this panel.</p>
                    </section>

                    <section class="dashboard-section mb-4">
                        <h3 class="text-center mb-4">Quick Actions</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">View or Update Your Address</h5>
                                        <a href="index.php?action=user_view_addresses" class="btn btn-primary">View or Update Address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">View Pets</h5>
                                        <p class="card-text">View Your Pets</p>
                                        <a href="index.php?action=user_view_pets" class="btn btn-primary">View Pets</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
