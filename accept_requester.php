<?php
// Include your database configuration
include 'db_config.php';

// Get requester ID from the POST request
$requesterId = isset($_POST['requesterId']) ? $_POST['requesterId'] : null;

// Validate input
if (!$requesterId) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Implement your database update logic for accepting the requester with $requesterId
// For example, you might run an UPDATE query to set the status to "accepted"

// Replace the following line with your actual database update logic
// $updateQuery = "UPDATE requester_info SET status = 'accepted' WHERE id = $requesterId";

// Dummy response for demonstration purposes
$updateResult = ['success' => true, 'message' => 'Requester accepted successfully'];

// Return the response as JSON
echo json_encode($updateResult);
?>
