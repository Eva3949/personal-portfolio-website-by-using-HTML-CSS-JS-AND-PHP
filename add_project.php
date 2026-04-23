<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

try {
    // Validate required fields
    if (empty($data['title']) || empty($data['description']) || empty($data['image_url']) || empty($data['technologies'])) {
        throw new Exception('Missing required fields');
    }
    
    // Sanitize input data
    $title = sanitize_input($data['title']);
    $description = sanitize_input($data['description']);
    $image_url = sanitize_input($data['image_url']);
    $live_demo_url = !empty($data['live_demo_url']) ? sanitize_input($data['live_demo_url']) : null;
    $github_url = !empty($data['github_url']) ? sanitize_input($data['github_url']) : null;
    $technologies = sanitize_input($data['technologies']);
    
    // Validate URLs
    if (!validate_url($image_url)) {
        throw new Exception('Invalid image URL');
    }
    
    if ($live_demo_url && !validate_url($live_demo_url)) {
        throw new Exception('Invalid live demo URL');
    }
    
    if ($github_url && !validate_url($github_url)) {
        throw new Exception('Invalid GitHub URL');
    }
    
    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO projects (title, description, image_url, live_demo_url, github_url, technologies) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    
    $stmt->bind_param("ssssss", $title, $description, $image_url, $live_demo_url, $github_url, $technologies);
    
    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . $stmt->error);
    }
    
    $project_id = $conn->insert_id;
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Project added successfully',
        'project_id' => $project_id
    ]);
    
    $stmt->close();
    
} catch (Exception $e) {
    // Return error response
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();
?>
