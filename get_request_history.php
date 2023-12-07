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

// Fetch request history from the database
$request_history_query = "SELECT * FROM history";
$request_history_result = $conn->query($request_history_query);

// Prepare the data for JSON response
$request_history_data = array();
while ($row = $request_history_result->fetch_assoc()) {
    $request_history_data[] = $row;
}

// Return the data in JSON format
echo json_encode($request_history_data);
?>