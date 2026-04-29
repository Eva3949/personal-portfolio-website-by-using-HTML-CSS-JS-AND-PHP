<?php
// Database configuration for XAMPP
<<<<<<< HEAD
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'portfolio_db';
=======
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'portfolio_db';

$host = 'evadevstudio.com';
$username = 'evadevih_astu_q_user';
$password = 'eva_3949';
$database = 'evadevih_astu_q';
>>>>>>> 18c924d (update the get in teach)

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
