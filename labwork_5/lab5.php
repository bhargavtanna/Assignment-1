<?php
// Lab 5: Comment Moderation System

function moderateComment($comment) {
    // Clean the comment
    $comment = trim($comment);
    
    // Convert to lowercase for keyword matching
    $commentLower = strtolower($comment);
    
    // Define banned words
    $bannedWords = ['spam', 'hack', 'virus', 'malware', 'phishing'];
    
    // Check for banned words
    $containsBannedWord = false;
    $foundWords = [];
    
    foreach ($bannedWords as $word) {
        if (strpos($commentLower, $word) !== false) {
            $containsBannedWord = true;
            $foundWords[] = $word;
        }
    }
    
    // Sanitize for safe display
    $safeComment = htmlspecialchars($comment);
    
    return [
        'original' => $comment,
        'safe_display' => $safeComment,
        'contains_banned' => $containsBannedWord,
        'banned_words_found' => $foundWords
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'] ?? '';
    
    if (!empty($comment)) {
        $result = moderateComment($comment);
        
        echo "<h2>Comment Moderation Result</h2>";
        echo "<p><strong>Original Comment:</strong> " . $result['safe_display'] . "</p>";
        
        if ($result['contains_banned']) {
            echo "<p style='color: red;'><strong>🚫 FLAGGED:</strong> Contains banned words: " . 
                 implode(", ", $result['banned_words_found']) . "</p>";
            echo "<p><em>This comment requires moderator review before publishing.</em></p>";
        } else {
            echo "<p style='color: green;'><strong>✓ APPROVED:</strong> No banned words detected.</p>";
            echo "<p><em>This comment is safe to publish.</em></p>";
        }
        
        // Display the sanitized comment as it would appear on website
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0; background: #f9f9f9;'>";
        echo "<h3>Comment Preview:</h3>";
        echo "<p>" . $result['safe_display'] . "</p>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 5 - Comment Moderation</title>
</head>
<body>
    <h1>Comment Moderation System</h1>
    <form method="post">
        <p>Enter your comment:</p>
        <textarea name="comment" rows="5" cols="50" required placeholder="Enter your comment here..."></textarea>
        <p><input type="submit" value="Moderate Comment"></p>
    </form>
    
    <div style="margin-top: 20px; padding: 10px; background: #eee;">
        <h3>Banned Words List:</h3>
        <p>spam, hack, virus, malware, phishing</p>
    </div>
</body>
</html>