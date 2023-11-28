<?php
// save_donor_changes.php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database configuration
    $server = "localhost";
    $username = "root";
    $password = "password";
    $database = "bbd";

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Get data from the POST parameters
    $donorId = $_POST['donorId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    // SQL query to update donor information
    $update_query = "UPDATE donor SET firstName=?, lastName=?, email=? WHERE id=?";

    // Prepare the statement
    $stmt = $conn->prepare($update_query);

    if (!$stmt) {
        die(json_encode(['success' => false, 'message' => 'Error preparing update statement: ' . $conn->error]));
    }

    // Bind parameters
    $stmt->bind_param('sssi', $firstName, $lastName, $email, $donorId);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Retrieve the updated donor information
            $select_query = "SELECT * FROM donor WHERE id=?";
            $select_stmt = $conn->prepare($select_query);

            if (!$select_stmt) {
                die(json_encode(['success' => false, 'message' => 'Error preparing select statement: ' . $conn->error]));
            }

            // Bind parameter
            $select_stmt->bind_param('i', $donorId);

            // Execute the select statement
            $select_stmt->execute();

            // Get result
            $result = $select_stmt->get_result();
            $updatedDonor = $result->fetch_assoc();

            // Close the select statement
            $select_stmt->close();

            echo json_encode(['success' => true, 'message' => 'Donor information updated successfully', 'updatedDonor' => $updatedDonor]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating donor information: ' . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
