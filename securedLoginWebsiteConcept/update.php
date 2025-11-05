<?php
include('config.php');
if (!isset($_SESSION['user'])) header("Location: index.php");

$id = $_GET['id'];
$res = $mysqli->query("SELECT * FROM employees WHERE id=$id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $mysqli->query("UPDATE employees SET name='$name', address='$address', salary='$salary' WHERE id=$id");
    header("Location: dashboard.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    Address: <input type="text" name="address" value="<?php echo $row['address']; ?>"><br>
    Salary: <input type="number" name="salary" value="<?php echo $row['salary']; ?>"><br>
    <button type="submit">Update</button>
</form>