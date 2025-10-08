<?php
// Lab 1: User Input Sanitization for Web Forms

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    
    echo "<h2>Sanitized Output:</h2>";
    echo "<p><strong>Name:</strong> " . $name . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
    echo "<p><strong>Message:</strong> " . $message . "</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 1 - Contact Form</title>
</head>
<body>
    <h1>Contact Form</h1>
    <form method="post">
        <p>Name: <input type="text" name="name" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Message: <textarea name="message" required></textarea></p>
        <p><input type="submit" value="Submit"></p>
    </form>
</body>
</html>