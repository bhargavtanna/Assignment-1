<!DOCTYPE html>
<html>
<head>
    <title>Days Until Event</title>
</head>
<body>

<form method="post">
    Enter event date: <input type="date" name="event_date" required>
    <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['event_date'])) {
    $future_date = $_POST['event_date'];
    $current_date = date('Y-m-d');
    $future = new DateTime($future_date);
    $today = new DateTime($current_date);
    $interval = $today->diff($future);

    if ($today > $future) {
        echo "The event date has already passed.";
    } else {
        echo "There are " . $interval->days . " days remaining until the event.";
    }
}
?>

</body>
</html>