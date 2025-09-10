<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Days Between Two Dates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            max-width: 600px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
        }
        form {
            margin-top: 20px;
        }
        input[type=date] {
            padding: 8px;
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box;
            font-size: 1em;
        }
        input[type=submit] {
            padding: 10px 15px;
            font-size: 1em;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
        }
        .result {
            margin-top: 25px;
            font-size: 1.2em;
            color: #34495e;
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Calculate Number of Days Between Two Dates</h1>

<form method="post">
    <label for="date1">Start Date:</label><br>
    <input type="date" id="date1" name="date1" required value="<?php echo isset($_POST['date1']) ? htmlspecialchars($_POST['date1']) : ''; ?>"><br>

    <label for="date2">End Date:</label><br>
    <input type="date" id="date2" name="date2" required value="<?php echo isset($_POST['date2']) ? htmlspecialchars($_POST['date2']) : ''; ?>"><br>

    <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDateStr = $_POST['date1'] ?? '';
    $endDateStr = $_POST['date2'] ?? '';

    try {
        $startDate = new DateTime($startDateStr);
        $endDate = new DateTime($endDateStr);

        // Calculate difference
        $interval = $startDate->diff($endDate);

        // Absolute difference in days
        $days = $interval->days;

        // Display the result with information about order
        if ($interval->invert == 1) {
            echo "<div class='result'>The end date is <strong>$days</strong> day(s) before the start date.</div>";
        } else {
            echo "<div class='result'>There are <strong>$days</strong> day(s) between <strong>" 
                . htmlspecialchars($startDateStr) . "</strong> and <strong>" . htmlspecialchars($endDateStr) . "</strong>.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='result' style='color:red;'>Invalid date input. Please enter valid dates.</div>";
    }
}
?>
</body>
</html>
