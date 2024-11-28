<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $username = htmlspecialchars($_POST['Username'] ?? '');
    $email = htmlspecialchars($_POST['Email'] ?? '');
    $password = $_POST['Password'] ?? '';

    // Verify all required fields are filled out
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Database credentials
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "homefinder";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("<p>Connection failed: " . $conn->connect_error . "</p>");
        }

        // Check if email already exists
        $SELECT = "SELECT email FROM register WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 0) {
            $stmt->close();

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user data
            $INSERT = "INSERT INTO register (Username, Email, Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<p>Registration successful! <a href='index.html'>Login here</a></p>";
            } else {
                echo "<p>Error: Could not register user.</p>";
            }
        } else {
            echo "<p>Email already registered. <a href='index.html'>Login here</a></p>";
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } else {
        echo "<p>All fields are required.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
