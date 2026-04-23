<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

// Get project ID from POST data or URL parameter
$project_id = $_POST['id'] ?? $_GET['id'] ?? null;

try {
    if (empty($project_id) || !is_numeric($project_id)) {
        throw new Exception('Invalid project ID');
    }
    
    $project_id = (int)$project_id;
    
    // Check if project exists
    $check_stmt = $conn->prepare("SELECT id FROM projects WHERE id = ?");
    $check_stmt->bind_param("i", $project_id);
    $check_stmt->execute();
    
    if ($check_stmt->get_result()->num_rows === 0) {
        throw new Exception('Project not found');
    }
    
    $check_stmt->close();
    
    // Delete the project
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }
    
    $stmt->bind_param("i", $project_id);
    
    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . $stmt->error);
    }
    
    // Check if deletion was successful
    if ($stmt->affected_rows === 0) {
        throw new Exception('No project was deleted');
    }
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Project deleted successfully',
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
