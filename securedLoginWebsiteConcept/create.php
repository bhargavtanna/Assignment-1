<?php
include('config.php');
if (!isset($_SESSION['user'])) header("Location: index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $mysqli->query("INSERT INTO employees (name, address, salary) VALUES ('$name', '$address', '$salary')");
    header("Location: dashboard.php");
}
?>
<form method="POST">
    Name: <input type="text" name="name" required><br>
    Address: <input type="text" name="address" required><br>
    Salary: <input type="number" name="salary" required><br>
<button type="submit">Save</button>
</form>