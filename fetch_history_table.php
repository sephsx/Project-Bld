<?php
// fetch_history_table.php

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

// Fetch history table content from the database
$sql = "SELECT * FROM requester_info";
$result = $conn->query($sql);

// Build the HTML table
$tableHtml = '<tr>
    <th>ID</th>
    <th>Requester Name</th>
    <th>Requester Email</th>
    <th>Requester Number</th>
    <th>Requested Blood Type</th>
    <th>Actions</th>
</tr>';

while ($row = $result->fetch_assoc()) {
    $tableHtml .= "<tr>
        <td>{$row['id']}</td>
        <td>{$row['requester_name']}</td>
        <td>{$row['requester_email']}</td>
        <td>{$row['requester_number']}</td>
        <td>{$row['requested_blood_type']}</td>
        <td>
            <button class='btn btn-success' onclick='showAcceptConfirmationModal({$row['id']}, \"{$row['requester_name']}\", \"{$row['requester_email']}\", \"{$row['requester_number']}\", \"{$row['requested_blood_type']}\")'>Accept</button>
            <button class='btn btn-danger' onclick='showRejectConfirmationModal({$row['id']}, \"{$row['requester_name']}\", \"{$row['requester_email']}\", \"{$row['requester_number']}\", \"{$row['requested_blood_type']}\")'>Reject</button>
        </td>
    </tr>";
}

// Echo the table HTML
echo $tableHtml;

// Close the database connection
$conn->close();
?>
