<?php
// save_to_history.php

$server = "localhost";
$username = "root";
$password = "password";
$database = "bbd";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create history_table if not exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS history_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_id INT,
    status VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTableQuery);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requesterId = $_POST['requesterId'];
    $status = $_POST['status'];

    // Insert data into the history table
    insertIntoHistory($conn, $requesterId, $status);

    echo 'Data saved to history successfully.';
} else {
    echo 'Invalid request.';
}

$conn->close();

// Define a function to insert data into the history table
function insertIntoHistory($conn, $requesterId, $status) {
    $insertQuery = "INSERT INTO history_table (requester_id, status) VALUES ('$requesterId', '$status')";
    $conn->query($insertQuery);
}
?>
