<?php
include('config.php');
if (isset($_SESSION['user'])) header("Location: dashboard.php");
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    
    $res = $mysqli->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
    if ($res->num_rows) {
        $_SESSION['user'] = $user;      
        if (!empty($_POST['remember'])) {
        setcookie("user", $user, time() + (86400 * 7));
        }
        header("Location: dashboard.php");
    } else {
        $msg = "Invalid login!";
    }
}
?>
<form method="POST">
    Username: <input type="text" name="username" value="<?php echo $_COOKIE['user'] ?? ''; ?>" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="checkbox" name="remember"> Remember Me<br>
    <button type="submit">Login</button>
    <p><?php echo $msg; ?></p>
</form>