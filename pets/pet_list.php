<?php
require_once('../model/pet_db.php'); // Ensure this line is present
include '../view/header.php'; // Include the header
// Fetch available cities and pet types
$cities = get_available_cities(); // Fetch available cities
$pet_types = get_available_pet_types(); // Fetch available pet types
?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <section class="hero-section text-center my-4">
                <h1>Available Pets for Adoption</h1>
                <p>Find your furry friend today!</p>
            </section>

            <section class="search-section mb-4">
                <form action="pet_list.php" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Search for a pet..." aria-label="Search" value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">

                    <label>
                        <select name="city" class="form-control mr-2">
                            <option value="">Select City</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo htmlspecialchars($city, ENT_QUOTES); ?>" <?php echo htmlspecialchars($_GET['city'] ?? '') == $city ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($city, ENT_QUOTES); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label>
                        <select name="pet_type" class="form-control mr-2">
                            <option value="">Select Pet Type</option>
                            <?php foreach ($pet_types as $pet_type): ?>
                                <option value="<?php echo htmlspecialchars($pet_type, ENT_QUOTES); ?>" <?php echo htmlspecialchars($_GET['pet_type'] ?? '') == $pet_type ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($pet_type, ENT_QUOTES); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </section>

            <section class="pets-section">
                <div class="row">
                    <?php
                    // Fetch pets from the database
                    $search = htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES);
                    $city = htmlspecialchars($_GET['city'] ?? '', ENT_QUOTES);
                    $pet_type = htmlspecialchars($_GET['pet_type'] ?? '', ENT_QUOTES);

                    // Debugging: Log the search parameters
                    error_log("Search: $search, City: $city, Pet Type: $pet_type");

                    $pets = get_pets($search, $city, $pet_type);

                    if (!empty($pets)) {
                        foreach ($pets as $pet) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card">';

                            // Use 'image_path' to get the pet image
                            $image_url = htmlspecialchars($pet['image_path'] ?? '../images/default_image.png', ENT_QUOTES);
                            $alt_text = htmlspecialchars($pet['pet_name'] ?? 'No Name Available', ENT_QUOTES);

                            echo '<img src="' . $image_url . '" alt="' . $alt_text . '" class="img-fluid mb-3">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($pet['pet_name'], ENT_QUOTES) . '</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($pet['description'], ENT_QUOTES) . '</p>';
                            echo '<a href="pet_detail.php?pet_id=' . htmlspecialchars($pet['pet_id'], ENT_QUOTES) . '" class="btn btn-primary">Learn More</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No pets available for adoption.</p>';
                    }
                    ?>
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
