<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Grade Calculator - Variable Scope Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            max-width: 700px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 8px;
        }
        pre {
            background: #f4f4f4;
            padding: 15px;
            border-left: 4px solid #2980b9;
        }
    </style>
</head>
<body>

<h1>Final Grade Calculator Using Global and Local Variables</h1>

<?php
// Global variables representing the weights for components
$homeworkWeight = 0.3;  // 30%
$examWeight = 0.7;      // 70%

// Global variables for student's scores
$homeworkScore = 85;
$examScore = 90;

/**
 * Calculate final grade using global variables inside the function
 */
function calculateFinalGradeGlobal() {
    // Use 'global' keyword to access global variables inside function
    global $homeworkWeight, $examWeight, $homeworkScore, $examScore;

    $finalGrade = ($homeworkScore * $homeworkWeight) + ($examScore * $examWeight);
    return $finalGrade;
}

/**
 * Calculate final grade using parameters (local variables inside the function)
 */
function calculateFinalGradeLocal($hwScore, $exScore, $hwWeight, $exWeight) {
    // These are local variables passed as parameters, independent of globals
    $finalGrade = ($hwScore * $hwWeight) + ($exScore * $exWeight);
    return $finalGrade;
}

/**
 * Demonstrate variable scope impact
 */
function demonstrateScope() {
    $homeworkScore = 50; // Local variable with same name as global

    echo "<p><strong>Inside function 'demonstrateScope':</strong></p>";
    echo "<p>Local homeworkScore = $homeworkScore</p>";

    // Access global variable explicitly
    global $homeworkScore;
    echo "<p>Global homeworkScore = $homeworkScore</p>";
}

// Display initial scores and weights
echo "<p><strong>Global variables:</strong></p>";
echo "<ul>";
echo "<li>Homework Score = $homeworkScore</li>";
echo "<li>Exam Score = $examScore</li>";
echo "<li>Homework Weight = {$homeworkWeight}</li>";
echo "<li>Exam Weight = {$examWeight}</li>";
echo "</ul>";

// Calculate final grade using global variables
$finalGlobal = calculateFinalGradeGlobal();
echo "<p><strong>Final grade using <em>global</em> variables inside function:</strong> " . number_format($finalGlobal, 2) . "</p>";

// Calculate final grade using local variables passed as parameters
$finalLocal = calculateFinalGradeLocal(80, 95, 0.25, 0.75);
echo "<p><strong>Final grade using <em>local</em> variables (parameters):</strong> " . number_format($finalLocal, 2) . "</p>";

// Show variable scope demonstration
demonstrateScope();

?>

</body>
</html>
