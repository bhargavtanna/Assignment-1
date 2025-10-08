<?php
// Lab 3: Name Formatting for Certificates

function formatName($name) {
    // Convert to lowercase first
    $name = strtolower(trim($name));
    
    // Split into words using explode()
    $words = explode(" ", $name);
    
    // Capitalize first letter of each word using ucfirst()
    $formattedWords = array_map('ucfirst', $words);
    
    // Join back using implode()
    return implode(" ", $formattedWords);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'] ?? '';
    
    if (!empty($fullName)) {
        $formattedName = formatName($fullName);
        
        echo "<h2>Certificate Name Formatting</h2>";
        echo "<p><strong>Original Name:</strong> " . $fullName . "</p>";
        echo "<p><strong>Formatted Name:</strong> " . $formattedName . "</p>";
        
        // Display certificate example
        echo "<div style='border: 2px solid gold; padding: 20px; text-align: center; margin: 20px 0;'>";
        echo "<h3>CERTIFICATE OF COMPLETION</h3>";
        echo "<p>This certifies that</p>";
        echo "<h2>" . $formattedName . "</h2>";
        echo "<p>has successfully completed the course</p>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 3 - Name Formatting</title>
</head>
<body>
    <h1>Name Formatting for Certificates</h1>
    <form method="post">
        <p>Enter Full Name: <input type="text" name="full_name" required placeholder="e.g., hARdik vAGhANI"></p>
        <p><input type="submit" value="Format Name"></p>
    </form>
</body>
</html>