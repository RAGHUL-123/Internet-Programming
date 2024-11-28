<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home_finder";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get search parameters
    $query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';
    $propertyType = isset($_GET['property-type']) ? $conn->real_escape_string($_GET['property-type']) : 'all';
    $bedrooms = isset($_GET['bedrooms']) ? $conn->real_escape_string($_GET['bedrooms']) : 'any';
    $priceRange = isset($_GET['price-range']) ? $conn->real_escape_string($_GET['price-range']) : 'any';

    // Build the SQL query
    $sql = "SELECT * FROM properties WHERE 1=1";

    if (!empty($query)) {
        $sql .= " AND (location LIKE '%$query%' OR description LIKE '%$query%' OR title LIKE '%$query%')";
    }

    if ($propertyType != 'all') {
        $sql .= " AND property_type = '$propertyType'";
    }

    if ($bedrooms != 'any') {
        $sql .= " AND bedrooms = '$bedrooms'";
    }

    if ($priceRange != 'any') {
        switch ($priceRange) {
            case '0-300000':
                $sql .= " AND price BETWEEN 0 AND 300000";
                break;
            case '300001-600000':
                $sql .= " AND price BETWEEN 300001 AND 600000";
                break;
            case '600001-1000000':
                $sql .= " AND price BETWEEN 600001 AND 1000000";
                break;
            case '1000001+':
                $sql .= " AND price > 1000000";
                break;
        }
    }

    // For debugging
    echo "<!-- Debug: SQL Query = $sql -->";

    $result = $conn->query($sql);
    
    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Home Finder</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="modern-styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="home-page">
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKRQUGBo1Q0zAHg-YBYasuER1sIgGocuVMLg&s" alt="Home Finder Logo">
                <span class="brand-name">Home Finder</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="home.html"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="saved-pictures.html"><i class="fas fa-heart"></i> Saved</a></li>
                    <li><a href="contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li><a href="index.html" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="search-results-container">
        <div class="search-summary">
            <h2>Search Results</h2>
            <?php if (!empty($query)) : ?>
                <p>Showing results for: "<?php echo htmlspecialchars($query); ?>"</p>
            <?php endif; ?>
            
            <!-- Debug information -->
            <?php if (isset($_GET['debug'])) : ?>
                <div class="debug-info" style="text-align: left; margin: 20px; padding: 20px; background: #f5f5f5; border-radius: 5px;">
                    <h3>Debug Information:</h3>
                    <p>Query: <?php echo htmlspecialchars($query); ?></p>
                    <p>Property Type: <?php echo htmlspecialchars($propertyType); ?></p>
                    <p>Bedrooms: <?php echo htmlspecialchars($bedrooms); ?></p>
                    <p>Price Range: <?php echo htmlspecialchars($priceRange); ?></p>
                    <p>SQL Query: <?php echo htmlspecialchars($sql); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="property-grid">
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="property-card">
                    <div class="property-image">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <span class="property-tag"><?php echo htmlspecialchars($row['property_type']); ?></span>
                        <button class="favorite-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="property-info">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p><?php echo htmlspecialchars($row['location']); ?></p>
                        </div>
                        <div class="property-price">$<?php echo number_format($row['price']); ?></div>
                        <div class="property-stats">
                            <span><i class="fas fa-bed"></i> <?php echo $row['bedrooms']; ?> Beds</span>
                            <span><i class="fas fa-bath"></i> <?php echo $row['bathrooms']; ?> Baths</span>
                            <span><i class="fas fa-ruler-combined"></i> <?php echo number_format($row['square_feet']); ?> sqft</span>
                        </div>
                        <button class="view-details-btn" onclick="window.location.href='property-details.php?id=<?php echo $row['id']; ?>'">View Details</button>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No properties found</h3>
                    <p>Try adjusting your search criteria</p>
                    <!-- Debug information for no results -->
                    <?php if (isset($_GET['debug'])) : ?>
                        <div class="debug-info" style="margin-top: 20px;">
                            <p>No results found for the current search criteria.</p>
                            <p>Number of rows returned: <?php echo $result ? $result->num_rows : '0'; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-info">
                <p>&copy; 2024 Home Finder. All Rights Reserved.</p>
            </div>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
