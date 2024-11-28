<?php
$servername = "localhost";
$username = "root"; // Change if your MySQL user is different
$password = "";     // Change to your MySQL password
$dbname = "House";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
