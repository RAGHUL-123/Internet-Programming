<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$name = $_POST['name']; 
$age = $_POST['age'];
$profession = $_POST['profession'];

if (!empty($username) || !empty($email) || !empty($password) || !empty($mobile) || !empty($address) || !empty($name) || !empty($age) || !empty($profession)) {

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "homefinder";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
    } else {
        $SELECT = "SELECT email FROM register WHERE email = ? LIMIT 1";
        $INSERT = "INSERT INTO House (username, email, password, mobile, address, name, age, profession) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // Checking if email already exists
        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssissis", $username, $email, $password, $mobile, $address, $name, $age, $profession);
            $stmt->execute();

            echo "New record inserted successfully";
        } else {
            echo "Someone has already registered with this email";
        }
        
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
