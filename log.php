<?php

// log.php
error_log("Received POST data: " . print_r($_POST, true)); // Debugging output

if (isset($_POST['log'])) {
    $logMessage = $_POST['log'];
    file_put_contents('logs.txt', $logMessage . PHP_EOL, FILE_APPEND);
    echo 'Log written successfully.';
} else {
    echo 'No log message received.';
}
?>