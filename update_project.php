<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

try {
    // Validate project ID
    if (empty($data['id']) || !is_numeric($data['id'])) {
        throw new Exception('Invalid project ID');
    }
    
    $project_id = (int)$data['id'];
    
    // Check if project exists
    $check_stmt = $conn->prepare("SELECT id FROM projects WHERE id = ?");
    $check_stmt->bind_param("i", $project_id);
    $check_stmt->execute();
    
    if ($check_stmt->get_result()->num_rows === 0) {
        throw new Exception('Project not found');
    }
    
    $check_stmt->close();
    
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
    $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image_url = ?, live_demo_url = ?, github_url = ?, technologies = ? WHERE id = ?");
    
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    
    $stmt->bind_param("ssssssi", $title, $description, $image_url, $live_demo_url, $github_url, $technologies, $project_id);
    
    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . $stmt->error);
    }
    
    // Check if update was successful
    if ($stmt->affected_rows === 0) {
        throw new Exception('No changes made to the project');
    }
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Project updated successfully',
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
