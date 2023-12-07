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

// User authentication
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    // Redirect to login or unauthorized page
    header("Location: admin.php"); // Update with your login page
    exit();
}

// Retrieve blood requests
$blood_request_query = "SELECT * FROM blood_requests";
$blood_request_result = $conn->query($blood_request_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard - Blood Requests</title>
    <style>
        /* Add custom styles here */
        body {
            padding-top: 60px; /* Adjust the top padding for the fixed navbar */
        }

        @media (max-width: 767px) {
            /* Adjust styles for smaller screens */
            body {
                padding-top: 0;
            }
        }
    </style>
</head>

<body class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">Blood Requested</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Add more navigation links if needed -->
                    <li class="nav-item">
                        <a class="nav-link" href="donor_information.php">Donors Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="requested_blood.php">Blood requested</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Blood Requested</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Requested Blood Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($blood_request_row = $blood_request_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$blood_request_row['id']}</td>";
                echo "<td>{$blood_request_row['patient_name']}</td>";
                echo "<td>{$blood_request_row['patient_email']}</td>";
                echo "<td>{$blood_request_row['requested_blood_type']}</td>";
                echo "<td class='text-center'>"; // Center the content
                echo "<button class='btn btn-info' onclick='referBloodRequest({$blood_request_row['id']})'>Refer</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include your JavaScript functions -->
    <script>
        function referBloodRequest(bloodRequestId) {
            // Implement the logic for referring blood requests
            console.log('Referred Blood Request with ID:', bloodRequestId);
        }
    </script>
</body>

</html>