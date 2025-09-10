<?php
// authentication.php

function authenticate($username, $password) {
    $valid_users = [
        "bhargav" => "1234",
        "admin" => "not1234"
    ];

    if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
        return true;
    }
    return false;
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (authenticate($username, $password)) {
        echo "<h3>Login successful! Welcome, " . htmlspecialchars($username) . ".</h3>";
    } else {
        echo "<h3>Invalid username or password. Please try again.</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login Form</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
</body>
</html>
