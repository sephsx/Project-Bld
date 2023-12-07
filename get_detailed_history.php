<?php
// get_detailed_history.php

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

// Get requesterId and status from POST data
$requesterId = $_POST['requesterId'];
$status = $_POST['status'];

// Fetch detailed history based on requesterId and status
$sql = "SELECT * FROM requester_info WHERE id = $requesterId AND status = '$status'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the detailed history as an associative array
    $detailedHistory = $result->fetch_assoc();

    // Return the detailed history as JSON
    header('Content-Type: application/json');
    echo json_encode($detailedHistory);
} else {
    echo "No detailed history found for Requester ID $requesterId and Status $status";
}

// Close the database connection
$conn->close();
?>
