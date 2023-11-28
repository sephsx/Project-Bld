<?php
// get_donor.php

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

// Get donor ID from the GET parameters
$donorId = $_GET['donorId'];

// SQL query to retrieve donor information
$select_query = "SELECT * FROM donor WHERE id = $donorId";
$result = $conn->query($select_query);

// Check if the donor exists
if ($result->num_rows > 0) {
    // Fetch the donor data
    $donor_data = $result->fetch_assoc();

    // Return the donor data as JSON
    echo json_encode($donor_data);
} else {
    // Return an error message if the donor is not found
    echo json_encode(['error' => 'Donor not found']);
}

// Close the database connection
$conn->close();
?>
