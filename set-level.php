<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $level = filter_input(INPUT_POST, 'level', FILTER_VALIDATE_INT);
    if ($level !== false && in_array($level, [1, 2, 3])) {
        // Update session variable with the selected level
        $_SESSION['level'] = $level;
        echo "Level $level selected.";
    } else {
        echo "Invalid level.";
    }
} else {
    echo "Invalid request method.";
}
?>
