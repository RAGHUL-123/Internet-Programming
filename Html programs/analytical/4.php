<?php

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Initialize variables to hold user input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    // Flag to track validation status
    $errors = [];

    // Validate the username
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }

    // Validate the email
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate the comment
    if (empty($comment)) {
        $errors[] = 'Comment cannot be empty.';
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    } else {
        // If validation passed, simulate storing the comment (here we just echo a success message)

        // For better security, sanitize the user inputs before output
        $sanitized_username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $sanitized_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $sanitized_comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');

        // Simulate storing the comment in a database (e.g., echo success message with sanitized data)
        echo "<h2>Success! Your comment has been submitted.</h2>";
        echo "<p><strong>Username:</strong> $sanitized_username</p>";
        echo "<p><strong>Email:</strong> $sanitized_email</p>";
        echo "<p><strong>Comment:</strong> $sanitized_comment</p>";

        // In a real application, this is where you'd insert the data into the database:
        // Example (using PDO for database interaction):
        // $stmt = $pdo->prepare("INSERT INTO comments (username, email, comment) VALUES (?, ?, ?)");
        // $stmt->execute([$sanitized_username, $sanitized_email, $sanitized_comment]);
    }
}

?>

<!-- HTML Form to submit a comment -->
<form action="submit_comment.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>

    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" rows="4" cols="50" required></textarea>
    <br><br>

    <button type="submit">Submit Comment</button>
</form>

