<?php
// move_request_to_history.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the request
    $requesterId = $_POST['requesterId'];
    $status = $_POST['status'];

    // Database configuration
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

    // TODO: Replace with your actual table and column names
    $selectQuery = "SELECT * FROM requester_info WHERE id = $requesterId";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        // Fetch the request details
        $row = $result->fetch_assoc();

        // TODO: Replace with your actual history table and column names
        $insertQuery = "INSERT INTO history (requester_name, requester_email, requester_number, requested_blood_type, status)
                        VALUES ('{$row['requester_name']}', '{$row['requester_email']}', '{$row['requester_number']}', '{$row['requested_blood_type']}', '$status')";

        // Execute the insert query
        if ($conn->query($insertQuery) === TRUE) {
            // TODO: Replace with your actual table and column names
            $deleteQuery = "DELETE FROM requester_info WHERE id = $requesterId";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Request moved to history successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error inserting record into history: " . $conn->error;
        }
    } else {
        echo "Request not found";
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid requests
    echo "Invalid request method";
}
?>