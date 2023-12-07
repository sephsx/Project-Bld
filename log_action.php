<?php
// Error reporting and database configuration
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "password";
$database = "bbd";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
$requesterId = $_POST['requesterId'];
$action = $_POST['action'];

// Insert a record into the action_history table
$insert_query = "INSERT INTO action_history (requester_id, action) VALUES ('$requesterId', '$action')";
if ($conn->query($insert_query) === TRUE) {
    $response = ['success' => true, 'message' => 'Action logged successfully'];
} else {
    $response = ['success' => false, 'message' => 'Error logging action: ' . $conn->error];
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>