<!DOCTYPE html>
<html>
<head>
    <title>Plugin Function Tester</title>
</head>
<body>

<h2>Plugin Function Tester</h2>

<form method="post">
    Select function to execute:<br>
    <select name="func_name" required>
        <option value="">-- Select a function --</option>
        <option value="pluginFunctionA">pluginFunctionA</option>
        <option value="pluginFunctionC">pluginFunctionC</option>
        <option value="pluginFunctionB">pluginFunctionB (Not Loaded)</option>
    </select>
    <br><br>
    <input type="submit" value="Run">
</form>

<?php
function pluginFunctionA() {
    return "Plugin Function A executed successfully.";
}

function pluginFunctionC() {
    return "Plugin Function C says hello!";
}

function executePluginFunction($func) {
    if (function_exists($func)) {
        echo "<p><strong>Output:</strong> " . htmlspecialchars($func()) . "</p>";
    } else {
        echo "<p style='color:red;'>Error: Function <em>" . htmlspecialchars($func) . "</em> does not exist. Plugin might be missing.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['func_name'])) {
    executePluginFunction($_POST['func_name']);
}
?>

</body>
</html>
