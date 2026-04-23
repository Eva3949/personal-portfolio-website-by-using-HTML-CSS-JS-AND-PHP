<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

try {
    // Query to get all projects ordered by creation date (newest first)
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    $projects = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Convert technologies string to array
            $technologies = explode(',', $row['technologies']);
            
            $project = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'image_url' => $row['image_url'],
                'live_demo_url' => $row['live_demo_url'],
                'github_url' => $row['github_url'],
                'technologies' => $technologies,
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
            
            array_push($projects, $project);
        }
    }
    
    // Return success response
    echo json_encode([
        'success' => true,
        'projects' => $projects,
        'count' => count($projects)
    ]);
    
} catch (Exception $e) {
    // Return error response
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
