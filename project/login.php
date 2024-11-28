<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    echo "Username entered: " . htmlspecialchars($username) . "<br>"; // Debug line

    if (!empty($username) && !empty($password)) {
        // Updated table name to `house`
        $query = "SELECT * FROM house WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            echo "<pre>";
            print_r($user); // Debug: display fetched user data
            echo "</pre>";
            echo "Password entered: " . htmlspecialchars($password) . "<br>";
            echo "Stored password: " . htmlspecialchars($user['password']) . "<br>";
            $password = trim($password);  // Remove extra spaces from the input
            $user['password'] = trim($user['password']); // Remove spaces from the stored password
            

            // Check password - assuming plain text password storage
            if ($password === $user['password']) {
                $_SESSION['username'] = $username;
                header('Location: home.html');
                exit();
            } else {
                $error = "Incorrect username or password.";
            }
        } else {
            $error = "No user found with that username.";
        }
    } else {
        $error = "Both fields are required.";
    }
}
?>

<!-- HTML for the login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>

    <!-- Display the error message, if any -->
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
