<!DOCTYPE html>
<html>
<head>
    <title>Quick Keyword Search</title>
</head>
<body>

<h2>Keyword Search</h2>

<form method="post">
    <textarea name="text" rows="6" cols="60" placeholder="Enter text here..."><?php if(isset($_POST['text'])) echo htmlspecialchars($_POST['text']); ?></textarea><br><br>
    <input type="text" name="keywords" size="60" placeholder="Enter keywords separated by commas" value="<?php if(isset($_POST['keywords'])) echo htmlspecialchars($_POST['keywords']); ?>"><br><br>
    <input type="submit" value="Search">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $keywords = explode(',', $_POST['keywords']);
    $text_lower = strtolower($text);

    $found_any = false;

    foreach ($keywords as $keyword) {
        $keyword = trim($keyword);
        if ($keyword == '') continue;

        $keyword_lower = strtolower($keyword);
        $pos = strpos($text_lower, $keyword_lower);

        if ($pos !== false) {
            $found_any = true;

            $start = max(0, $pos - 20);
            $length = strlen($keyword);
            $end = min(strlen($text), $pos + $length + 20);

            $snippet = substr($text, $start, $end - $start);

            // highlight keyword (case insensitive)
            $snippet = preg_replace("/($keyword)/i", "<b>$1</b>", $snippet);

            if ($start > 0) $snippet = "... " . $snippet;
            if ($end < strlen($text)) $snippet = $snippet . " ...";

            echo "<p><strong>Keyword:</strong> " . htmlspecialchars($keyword) . "<br>Snippet: $snippet</p>";
        }
    }

    if (!$found_any) {
        echo "<p>No keywords found in the text.</p>";
    }
}
?>

</body>
</html>
