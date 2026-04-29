<?php
// Test database connection and table
require_once 'config.php';

echo "<h2>Database Connection Test</h2>";

if ($conn->connect_error) {
    die("<p style='color:red'>Connection failed: " . $conn->connect_error . "</p>");
}

echo "<p style='color:green'>✓ Connected successfully to database: $database</p>";

// Check if projects table exists
$result = $conn->query("SHOW TABLES LIKE 'projects'");
if ($result->num_rows > 0) {
    echo "<p style='color:green'>✓ Table 'projects' exists</p>";
} else {
    echo "<p style='color:red'>✗ Table 'projects' does NOT exist</p>";
}

// Check table structure and count
$result = $conn->query("SELECT COUNT(*) as count FROM projects");
if ($result) {
    $row = $result->fetch_assoc();
    echo "<p>Number of projects in database: <strong>" . $row['count'] . "</strong></p>";
} else {
    echo "<p style='color:red'>Error querying projects table: " . $conn->error . "</p>";
}

// List all tables
echo "<h3>All tables in database:</h3>";
$result = $conn->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_array()) {
        echo "<p>- " . $row[0] . "</p>";
    }
}

$conn->close();
?>
