<?php
// delete_donor.php

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
        die("Connection failed: " . $conn->connect_error);
    }

    // Get donor ID from the POST data
    $donorId = $_POST['donorId'];

    // SQL query to delete the donor
    $delete_query = "DELETE FROM donor WHERE id = $donorId";

    if ($conn->query($delete_query) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Donor deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting donor: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);

}
?>
