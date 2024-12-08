<?php
include 'C:\xampp\htdocs\dashboard\quizznourane\config.php'; // Ensure this is the correct path to your config file

try {
    // Attempt to connect to the database
    $conn = config::getConnexion();
    echo "Database connection successful!";
} catch (Exception $e) {
    // Catch and display connection errors
    echo "Database connection failed: " . $e->getMessage();
}
?>
