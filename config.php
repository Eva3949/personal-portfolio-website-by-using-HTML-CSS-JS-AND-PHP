<?php
// Database configuration for XAMPP
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'portfolio_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate URL
function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
?>
