<?php
session_start();
require_once 'config.php'; // Include your database connection file

// Get the logged-in user's username from the session
$username = $_SESSION['username'];

// Fetch the user details from the database
$query = "SELECT * FROM house WHERE username = '$username' LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "No user found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body class="profile-page">
    <!-- Profile Container -->
    <div class="profile-container">
        <h1>Welcome to Your Profile, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        
        <!-- Profile Details Section -->
        <ul>
            <li><strong>Username:</strong> <span><?php echo htmlspecialchars($user['username']); ?></span></li>
            <li><strong>Email:</strong> <span><?php echo htmlspecialchars($user['email']); ?></span></li>
            <li><strong>Mobile:</strong> <span><?php echo htmlspecialchars($user['mobile']); ?></span></li>
            <li><strong>Address:</strong> <span><?php echo htmlspecialchars($user['address']); ?></span></li>
            <li><strong>Age:</strong> <span><?php echo htmlspecialchars($user['age']); ?></span></li>
            <li><strong>Profession:</strong> <span><?php echo htmlspecialchars($user['profession']); ?></span></li>
        </ul>
        
        <!-- Logout Button -->
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
