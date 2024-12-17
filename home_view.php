<?php
session_start();
global $username, $logged_in, $is_admin;

if (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
    $logged_in = true;
    $username = $_SESSION['admin_first_name'] ?? 'Admin';
} else {
    $logged_in = false;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsitive Placements - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header class="bg-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="index.php" class="logo d-flex align-items-center text-decoration-none">
            <img src="http://localhost/PawsitivePlacements/images/logo.png" alt="Pawsitive Placements Logo" class="mr-2" style="height: 150px;">
            <h1 class="h2 m-0 text-dark">Pawsitive Placements</h1>
        </a>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="pets">View Pets</a></li>
                <li class="nav-item"><a class="nav-link" href="pet_rehome">Rehome A Pet</a></li>
                <li class="nav-item"><a class="nav-link" href="contact/contact_form_info.php">Contact Us</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="sidebar">

                <a href="index.php"><i class="fas fa-home"></i> Home</a><br>
                <br><h2>Users</h2>
                <ul>
                    <li><a href="user"><i class="fas fa-user-plus"></i> My Account </a></li>

                    <li><a href="user/create_account.php"><i class="fas fa-user-plus"></i> Create Account </a></li>
                </ul><br>

                <?php if ($logged_in): ?>
                    <h2>Welcome</h2>
                    <p>Hello, <strong><?php echo htmlspecialchars($username); ?></strong></p>
                    <ul>
                        <?php if ($is_admin): ?>
                            <li><a href="admins/index.php"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo $is_admin ? 'admins/index.php?action=logout' : 'user_accounts/index.php?action=logout'; ?>" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                <?php else: ?>
                    <p>Please log in to access your account.</p>
                <?php endif; ?>

                <h2>Administrators</h2>
                <ul>
                    <li><a href="admins">Admin Menu</a></li>
                </ul><br>


                <h2>Quick Info</h2>
                <ul class="list-unstyled">
                    <li><strong>Our Mission:</strong> To find loving homes for every pet.</li>
                    <li><strong>Adoption Fees:</strong> Learn about our affordable fees for adopting.</li>
                    <li><strong>Volunteer Opportunities:</strong> Join us in making a difference!</li>
                </ul><br>

                <h2>Pet Care Tips</h2>
                <ul class="list-unstyled">
                    <li>Regular Vet Visits</li>
                    <li>Proper Nutrition</li>
                    <li>Daily Exercise</li>
                    <li>Socialization with Other Pets</li>
                </ul><br>

                <h2>Stay Connected</h2>
                <p>Follow us on social media for updates on pets and events!</p>
            </aside>
        </div>

        <div class="col-md-9">
            <section class="hero-section">
                <div class="hero-text">
                    <h1>Find Your Furry Forever Friend</h1>
                    <p>Pawsitive Placements is dedicated to finding loving homes for rescued animals. Explore our adoptable pets and learn about our fostering program.</p>
                    <a href="pets/pet_list.php" class="btn btn-secondary">Adopt Today</a>
                </div>
            </section>

            <section class="about-section">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="hero-text">About Pawsitive Placements</h2>
                        <p class="hero-text">We believe that every animal deserves a loving home. Our mission is to facilitate the adoption and rehoming of pets, ensuring they find loving families who will cherish them for life. We provide resources and support to help both pets and their new families adjust and thrive together.</p>
                        <ul class="spaced-list">
                            <li class="hero-text"><strong>Our Goal:</strong> To create a platform where people can easily adopt or rehome pets, promoting a culture of compassion and kindness towards animals.</li>
                            <li class="hero-text"><strong>Our Promise:</strong> We promise to provide a safe, reliable, and transparent platform for pet adoption and rehoming, ensuring the well-being of both pets and their new owners.</li>
                            <li class="hero-text"><strong>Our Values:</strong> We value the importance of animal welfare, responsible pet ownership, and the joy of bringing pets and people together.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="images/kitten_image.png" alt="About Us" class="img-fluid mb-md-n4">
                    </div>
                </div>
            </section>

            <section class="adoptable-pets-section">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="hero-text">Featured Pets</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="card flex-fill">
                            <img src="images/max.png" alt="Pet 1" class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title hero-text">Max</h5>
                                <p class="card-text hero-text">Max is a playful Labrador puppy. He is quiet and cuddly. He is hoping to find a new forever home with a loving family.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card flex-fill">
                            <img src="images/buddy.png" alt="Pet 2" class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title hero-text">Buddy</h5>
                                <p class="card-text hero-text">A friendly and adorable golden retriever puppy who loves to play fetch and sleep with his owner. He loves walks and gets along well with kids.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card flex-fill">
                            <img src="images/bird.jpg" alt="Pet 3" class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title hero-text">Charlie</h5>
                                <p class="card-text hero-text">A calm and affectionate parakeet. A low maintenance and fun new pet for your family to enjoy. Looking for a new forever home.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="foster-section">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="hero-text">Rehome Your Pet</h2>
                        <p class="hero-text">Need to find a new home for your beloved pet? We're here to help! Our rehoming process is simple and compassionate, ensuring your pet finds a loving family.</p>
                        <ul>
                            <li class="hero-text"><strong>Why Rehome with Us:</strong> We understand the difficulty of parting with your pet, which is why we provide a safe and supportive environment for rehoming.</li>
                            <li class="hero-text"><strong>Our Rehoming Process:</strong> Our team will guide you through a simple and stress-free process, ensuring your pet finds a new home that's just right.</li>
                            <li class="hero-text"><strong>Benefits of Rehoming:</strong> By rehoming your pet through Pawsitive Placements, you'll be giving them a second chance at a happy life, while also opening up a space for another pet in need.</li>
                        </ul>
                        <a href="pet_rehome" class="btn btn-primary">Get Started</a>
                    </div>
                    <div class="col-md-6">
                        <img src="images/pawsitive_placements.png" alt="Rehome Your Pet" class="img-fluid mb-2">
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>Pawsitive Placements</h2>
                <p>Connecting loving homes with furry friends. Join us in making a difference in the lives of pets in need!</p>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="view/terms_of_use.php">Terms and Conditions</a></li>
                    <li><a href="application/index.php">Adopt a Pet</a></li>
                    <li><a href="contact/index.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contact Us</h3>
                <p>Email: <a href="mailto:info@pawsitiveplacements.com">info@pawsitiveplacements.com</a></p>
                <p>Phone: <a href="tel:(123) 456-7890">(123) 456-7890</a></p>
                <div class="socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p id="copyright">
                &copy; <?php echo date("Y"); ?> Pawsitive Placements, Inc.
            </p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
