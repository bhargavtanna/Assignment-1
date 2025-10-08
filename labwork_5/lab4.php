<?php
// Lab 4: CSV Parsing for Batch Evaluation

function processStudentData($csvData) {
    // Split CSV string into array using explode()
    $data = explode(",", $csvData);
    
    // Extract name and scores
    $name = trim($data[0]);
    $scores = array_slice($data, 1);
    
    // Calculate average
    $sum = array_sum($scores);
    $count = count($scores);
    $average = $count > 0 ? $sum / $count : 0;
    
    // Create summary using implode()
    $summary = $name . " - Avg: " . number_format($average, 2);
    
    return [
        'name' => $name,
        'scores' => $scores,
        'average' => $average,
        'summary' => $summary
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentData = $_POST['student_data'] ?? '';
    
    if (!empty($studentData)) {
        echo "<h2>Student Evaluation Results</h2>";
        
        // Process multiple students (split by newline)
        $students = explode("\n", $studentData);
        
        foreach ($students as $student) {
            $student = trim($student);
            if (!empty($student)) {
                $result = processStudentData($student);
                
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
                echo "<p><strong>Name:</strong> " . $result['name'] . "</p>";
                echo "<p><strong>Scores:</strong> " . implode(", ", $result['scores']) . "</p>";
                echo "<p><strong>Average:</strong> " . number_format($result['average'], 2) . "</p>";
                echo "<p><strong>Summary:</strong> " . $result['summary'] . "</p>";
                echo "</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 4 - CSV Parsing</title>
</head>
<body>
    <h1>Student Batch Evaluation</h1>
    <form method="post">
        <p>Enter student data (CSV format - one per line):</p>
        <textarea name="student_data" rows="5" cols="50" required placeholder="Hardik,85,90,78
John,92,88,95,79
Sarah,75,82,80"></textarea>
        <p><input type="submit" value="Process Students"></p>
    </form>
</body>
</html>