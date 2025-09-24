<?php
session_start();

// --- 7. GLOBAL COUNTER ---
$GLOBALS['page_visit_counter'] = $GLOBALS['page_visit_counter'] ?? 0;
function incrementCounter() {
    $GLOBALS['page_visit_counter']++;
}
incrementCounter();

// --- 6. SESSION TIMEOUT ---
$timeout_seconds = 10;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout_seconds)) {
    session_unset();
    session_destroy();
    session_start();
    $session_expired = true;
} else {
    $session_expired = false;
}
$_SESSION['last_activity'] = time();

// --- 1. LOGIN VALIDATION ---
$login_message = '';
if (isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $valid_username = 'bhargav';
    $valid_password = '123';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        $login_message = "<p style='color:green;'>Login successful! Welcome, " . htmlspecialchars($username) . ".</p>";
    } else {
        $login_message = "<p style='color:red;'>Invalid username or password.</p>";
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    session_start();
    $login_message = "<p style='color:blue;'>You have been logged out.</p>";
}

$welcome_message = '';
if (isset($_GET['register'])) {
    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    if ($name) {
        $welcome_message = "<p style='color:green;'>Welcome, " . htmlspecialchars($name) . "! Thank you for registering.</p>";
    }
}

$file_message = '';
if (isset($_FILES['userfile'])) {
    if ($_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['userfile']['name']);
        $filename_sanitized = htmlspecialchars($filename);
        
        $file_message = "<p style='color:green;'>File '$filename_sanitized' uploaded successfully.</p>";
    } else {
        $file_message = "<p style='color:red;'>File upload failed with error code " . $_FILES['userfile']['error'] . ".</p>";
    }
}

// --- 4.personalized theme ---
$theme_message = '';
$available_themes = ['light', 'dark'];
$theme = $_COOKIE['theme'] ?? 'light';

if (isset($_POST['set_theme'])) {
    $posted_theme = filter_input(INPUT_POST, 'theme', FILTER_SANITIZE_STRING);
    if (in_array($posted_theme, $available_themes)) {
        setcookie('theme', $posted_theme, time() + 3600 * 24 * 30, "/"); // 30 days
        $theme = $posted_theme;
        $theme_message = "<p style='color:blue;'>Theme preference saved as '$theme'.</p>";
    }
}

// --- 5. LOGGING REQUESTS ($_SERVER) ---
$server_info = [
    'IP Address' => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
    'Request Method' => $_SERVER['REQUEST_METHOD'] ?? 'N/A',
    'User Agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'N/A',
    'Server Name' => $_SERVER['SERVER_NAME'] ?? 'N/A'
];

// --- 8. ENVIRONMENT VARIABLES ($_ENV) ---
$db_config = 'default config';
if (!empty($_ENV['APP_ENV'])) {
    $env = htmlspecialchars($_ENV['APP_ENV']);
    if ($env === 'production') {
        $db_config = 'production database config';
    } elseif ($env === 'development') {
        $db_config = 'development database config';
    } else {
        $db_config = 'unknown environment config';
    }
} else {
    $env = getenv('APP_ENV') ?: 'local';
    $db_config = "Using getenv(), environment is '$env', using local config";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>MCA Unit 3 - PHP Superglobals Lab</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: <?= $theme === 'dark' ? '#222' : '#eee' ?>;
        color: <?= $theme === 'dark' ? '#eee' : '#222' ?>;
        margin: 2rem;
    }
    section {
        background: <?= $theme === 'dark' ? '#333' : '#fff' ?>;
        padding: 1rem 2rem;
        margin-bottom: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input, select, button {
        font-size: 1rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        border-radius: 4px;
        border: 1px solid #999;
    }
    button {
        cursor: pointer;
    }
</style>
</head>
<body>

<h1> LABWORK-7 BY BHARGAV </h1>

<section>
<h2>1. Login Validation </h2>
<?php
if ($session_expired) {
    echo "<p style='color:red;'>Session expired due to inactivity. Please login again.</p>";
}
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "<p>You are logged in.</p>";
    echo "<form method='POST'><button name='logout' type='submit'>Logout</button></form>";
} else {
    echo $login_message;
    ?>
    <form method="POST" action="">
        <label>Username:<br />
        <input type="text" name="username" required></label><br />
        <label>Password:<br />
        <input type="password" name="password" required></label><br />
        <button name="login" type="submit">Login</button>
    </form>
    <?php
}
?>
</section>

<section>
<h2>2. User Registration via GET</h2>
<?= $welcome_message ?>
<form method="GET" action="">
    <label>Your Name:<br />
    <input type="text" name="name" required></label><br />
    <button name="register" type="submit">Register</button>
</form>
</section>

<section>
<h2>3. File Upload</h2>
<?= $file_message ?>
<form method="POST" enctype="multipart/form-data" action="">
    <label>Select file:<br />
    <input type="file" name="userfile" required></label><br />
    <button type="submit">Upload</button>
</form>
</section>

<section>
<h2>4.Theme with cookies</h2>
<p>Current theme: <strong><?= htmlspecialchars($theme) ?></strong></p>
<?= $theme_message ?>
<form method="POST" action="">
    <label>Choose theme:<br />
        <select name="theme">
            <option value="light" <?= $theme === 'light' ? 'selected' : '' ?>>Light</option>
            <option value="dark" <?= $theme === 'dark' ? 'selected' : '' ?>>Dark</option>
        </select>
    </label><br />
    <button name="set_theme" type="submit">Save Theme</button>
</form>
</section>

<section>
<h2>5. Logging Requests</h2>
<ul>
<?php foreach ($server_info as $key => $val): ?>
    <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($val) ?></li>
<?php endforeach; ?>
</ul>
</section>

<section>
<h2>6. Session Timeout</h2>
<p>Session expires after <strong><?= $timeout_seconds ?></strong> seconds of inactivity.</p>
<?php if ($session_expired): ?>
<p style="color:red;">Your session timed out. Please login again.</p>
<?php elseif (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
<p>You are logged in. Last activity updated.</p>
<?php else: ?>
<p>You are not logged in.</p>
<?php endif; ?>
</section>

<section>
<h2>7. Universal Access</h2>
<p>Page visit counter for this request: <strong><?= $GLOBALS['page_visit_counter'] ?></strong></p>
</section>

<section>
<h2>8.Environment Setup</h2>
<p>APP_ENV environment variable is set to: <strong><?= $env ?></strong></p>
<p>Database config loaded: <em><?= htmlspecialchars($db_config) ?></em></p>
</section>

</body>
</html>