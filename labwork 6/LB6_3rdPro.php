<!DOCTYPE html>
<html>
<head>
    <title>Survey Average Calculator</title>
</head>
<body>

<h2>Survey: Rate from 1 to 5</h2>

<form method="post">
    <label>Response 1: <input type="number" name="responses[]" min="1" max="5" step="0.1" required></label><br><br>
    <label>Response 2: <input type="number" name="responses[]" min="1" max="5" step="0.1" required></label><br><br>
    <label>Response 3: <input type="number" name="responses[]" min="1" max="5" step="0.1" required></label><br><br>
    <label>Response 4: <input type="number" name="responses[]" min="1" max="5" step="0.1" required></label><br><br>
    <label>Response 5: <input type="number" name="responses[]" min="1" max="5" step="0.1" required></label><br><br>
    <input type="submit" value="Calculate Average">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['responses'])) {

    function collectResponses($responses) {
        $collected = [];
        foreach ($responses as $response) {
            $collected[] = floatval($response);
        }
        return $collected;
    }

    function computeAverage($scores) {
        if (count($scores) === 0) {
            return 0;
        }
        return array_sum($scores) / count($scores);
    }

    $userResponses = collectResponses($_POST['responses']);
    $average = computeAverage($userResponses);

    echo "<h3>Average Score: " . number_format($average, 2) . "</h3>";
}
?>

</body>
</html>
