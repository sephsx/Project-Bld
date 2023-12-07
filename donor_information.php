<?php
// donor_information.php

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

// Retrieve donor information
$donor_query = "SELECT * FROM donor";
$donor_result = $conn->query($donor_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard - Donor Information</title>
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
<body class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">Donor Information</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Add more navigation links if needed -->
                    <li class="nav-item">
                        <a class="nav-link" href="blood_requests.php">Blood Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="requested_blood.php">Requested Blood</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h2>Donor Information</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Age</th>
                <th>Mobile Number</th>
                <th>Sex</th>
                <th>Blood Type</th>
                <th>Date of Donation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($donor_row = $donor_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$donor_row['id']}</td>";
                echo "<td>{$donor_row['firstName']}</td>";
                echo "<td>{$donor_row['lastName']}</td>";
                echo "<td>{$donor_row['email']}</td>";
                echo "<td>{$donor_row['address']}</td>";
                echo "<td>{$donor_row['age']}</td>";
                echo "<td>{$donor_row['phoneNumber']}</td>";
                echo "<td>{$donor_row['sex']}</td>";
                echo "<td>{$donor_row['bloodType']}</td>";
                echo "<td>{$donor_row['timestamp']}</td>";
                echo "<td>
                        <button class='btn btn-primary' onclick='openEditDonorModal({$donor_row['id']})'>Edit</button>
                        <button class='btn btn-danger' onclick='deleteDonor({$donor_row['id']})'>Delete</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="modal fade" id="editDonorModal" tabindex="-1" aria-labelledby="editDonorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDonorModalLabel">Edit Donor Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for editing donor information -->
                <form id="editDonorForm">
                    <input type="hidden" id="donorId">
                    
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <!-- Add more fields as needed -->

                    <button type="button" class="btn btn-primary" onclick='saveDonorChanges()'>Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Changes have been successfully saved.
            </div>
        </div>
    </div>
</div>

    <!-- Include Bootstrap JS and your JavaScript functions -->
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include your JavaScript functions -->
    <script>
        function openEditDonorModal(donorId) {
            fetch(`get_donor.php?donorId=${donorId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('donorId').value = data.id;
                    document.getElementById('firstName').value = data.firstName;
                    document.getElementById('lastName').value = data.lastName;
                    document.getElementById('email').value = data.email;

                    var editDonorModal = new bootstrap.Modal(document.getElementById('editDonorModal'));
                    editDonorModal.show();
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteDonor(donorId) {
            if (confirm("Are you sure you want to delete this donor?")) {
                fetch('delete_donor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'donorId=' + donorId,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Success:', data.message);
                            // Optionally, you can remove the deleted row from the table here
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
        
        function saveDonorChanges() {
    var donorId = document.getElementById('donorId').value;
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;

    console.log('Donor ID:', donorId);
    console.log('First Name:', firstName);
    console.log('Last Name:', lastName);
    console.log('Email:', email);

    fetch('save_donor_changes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'donorId=' + donorId + '&firstName=' + encodeURIComponent(firstName) + '&lastName=' + encodeURIComponent(lastName) + '&email=' + encodeURIComponent(email),
    })
        .then(response => {
            console.log('Response Status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            // Optionally, you can handle success actions here
            $('#successModal').modal('show'); // Show the success modal using jQuery
            // location.reload(); // Reload the page to reflect the changes if needed
        })
        .catch(error => console.error('Error:', error));
}
$('#successModal').on('hidden.bs.modal', function () {
        location.reload(); // Reload the page when the modal is closed
    });
    function deleteDonor(donorId) {
        if (confirm("Are you sure you want to delete this donor?")) {
            fetch('delete_donor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'donorId=' + donorId,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Success:', data.message);
                        // Optionally, you can remove the deleted row from the table here
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
    </script>
</body>
</html>
