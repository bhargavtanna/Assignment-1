<?php
include('config.php');
if (!isset($_SESSION['user'])) header("Location: index.php");

$result = $mysqli->query("SELECT * FROM employees");
echo "<h2>Employee Records</h2><a href='create.php'>Add Employee</a> | <a href='logout.php'>Logout</a><br><br>";
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Address</th><th>Salary</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['address']}</td>
        <td>{$row['salary']}</td>
        <td>
        <a href='update.php?id={$row['id']}'>Edit</a> |
        <a href='delete.php?id={$row['id']}'>Delete</a>
        </td>
        </tr>";
}
echo "</table>";
?>