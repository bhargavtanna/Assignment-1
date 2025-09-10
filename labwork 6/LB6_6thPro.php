<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Current Date Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            max-width: 600px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
        }
        p.date {
            font-size: 1.2em;
            color: #34495e;
        }
    </style>
</head>
<body>

<h1>Current Date Display with Localization</h1>

<?php
// Set the locale for date/time formatting
// Try to set to US English; you can change to other locales like 'fr_FR', 'de_DE', 'es_ES', etc.
setlocale(LC_TIME, 'en_US.UTF-8');

// Get current timestamp
$now = time();

// Format date in a human-readable localized format
// Using strftime for localization, e.g., "Friday, September 10, 2025"
$formattedDate = strftime("%A, %B %e, %Y", $now);

// Fallback if strftime is deprecated (PHP 8.1+), use IntlDateFormatter instead:
if (function_exists('intl_get_error_code')) {
    $fmt = new IntlDateFormatter(
        'en_US',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'America/New_York',
        IntlDateFormatter::GREGORIAN,
        'EEEE, MMMM d, yyyy'
    );
    $formattedDate = $fmt->format($now);
}

echo "<p class='date'>Today is <strong>" . htmlspecialchars($formattedDate) . "</strong>.</p>";
?>


</body>
</html>
