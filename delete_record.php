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

// Check if the recordId is set and not empty
if (isset($_POST['recordId']) && !empty($_POST['recordId'])) {
    // Sanitize the input to prevent SQL injection
    $recordId = $conn->real_escape_string($_POST['recordId']);

    // Perform the deletion in the database
    $delete_query = "DELETE FROM history WHERE id = '$recordId'";
    if ($conn->query($delete_query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid recordId";
}

// Close the database connection
$conn->close();
?>
