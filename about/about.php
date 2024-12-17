<?php include '../view/header.php'; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="text-center mt-4">
                <img src="../images/puppy.png" alt="Welcome to Pawsitive Placements" class="img-fluid mb-3">
                <h1>About Pawsitive Placements</h1>
                <p>Your journey to find a forever friend begins here!</p>
            </section>

            <section class="about-section mt-4">
                <h2>Our Mission</h2>
                <p>At Pawsitive Placements, we aim to simplify the pet adoption process, connecting individuals with loving pets in their local area. Our platform allows users to search for adoptable pets based on their city, ensuring that finding a furry friend is as easy and accessible as possible.</p>
                <p>We partner with local shelters and rescue organizations to provide a wide range of pets available for adoption, helping you find the perfect match for your home.</p>
            </section>

            <section class="mt-4">
                <h2>Featured Pets</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../images/hamster.png" alt="Pet 4" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Buttercup</h5>
                                <p class="card-text">A sweet and adorable little female hamster who loves to run in the wheel. Perfect for a family with kids!</p>
                                <a href="../pets/pet_detail.php?pet_id=4" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../images/pet5_puppy.png" alt="Pet 5" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Max</h5>
                                <p class="card-text">A gentle and cuddly golden retriever cross puppy who is adorable, active and gentle.!</p>
                                <a href="../pets/pet_detail.php?pet_id=5" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../images/pet6_puppy.png" alt="Pet 6" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Luna</h5>
                                <p class="card-text">A playful puppy golden retriever cross puppy who is looking for a forever home to explore and play!</p>
                                <a href="../pets/pet_detail.php?pet_id=6" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="about-section mt-4">
                <h2>Meet Our Team</h2>
                <p>Our dedicated team is passionate about animal welfare and technology. We work tirelessly to ensure our platform is user-friendly and effective in helping pets find their forever homes.</p>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="team-member">
                            <img src="../images/staff1.png" alt="Lusetta Tremblay" class="img-fluid mb-3">
                            <h3>Lusetta Tremblay</h3>
                            <p>Founder & Director</p>
                            <p>Lusetta combines her love for animals with innovative technology to connect pets and people across communities.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="team-member">
                            <img src="../images/staff2.png" alt="John Smith" class="img-fluid mb-3">
                            <h3>John Smith</h3>
                            <p>Adoption Coordinator</p>
                            <p>John is dedicated to ensuring that every pet listed on our platform finds a loving home. He connects adopters with the right pets for their lifestyle.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="team-member">
                            <img src="../images/staff3.png" alt="Emily Johnson" class="img-fluid mb-3">
                            <h3>Emily Johnson</h3>
                            <p>Foster Care Manager</p>
                            <p>Emily manages our foster network, helping to ensure that every pet is cared for until they find their forever family.</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="../index.php" class="btn btn-secondary">Return to Home</a>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include '../view/footer.php'; ?>

