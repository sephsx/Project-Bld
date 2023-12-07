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

    // Retrieve donor information
    $donor_query = "SELECT * FROM donor";
    $donor_result = $conn->query($donor_query);

    // delete donor
    
    // Retrieve blood requests
    $blood_request_query = "SELECT * FROM blood_requests";
    $blood_request_result = $conn->query($blood_request_query);

    // Retrieve requester information
    $requester_info_query = "SELECT * FROM requester_info";
    $requester_info_result = $conn->query($requester_info_query);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Admin Dashboard</title>
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
            <a class="navbar-brand" href="#">Blood Bank Dashboard</a>
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


    <!-- Content goes here -->

    <!-- Include Bootstrap JS and your JavaScript functions -->
</body>

        <h2>Donor Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Mobile Number</th>
                    <th>Sex</th>
                    <th>Date of Donation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($donor_row = $donor_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$donor_row['firstName']}</td>";
                    echo "<td>{$donor_row['lastName']}</td>";
                    echo "<td>{$donor_row['email']}</td>";
                    echo "<td>{$donor_row['address']}</td>";
                    echo "<td>{$donor_row['age']}</td>";
                    echo "<td>{$donor_row['phoneNumber']}</td>";
                    echo "<td>{$donor_row['sex']}</td>";
                    echo "<td>{$donor_row['timestamp']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

                <h2>Blood Requests</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Patient Email</th>
                    <th>Requested Blood Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($blood_request_row = $blood_request_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$blood_request_row['id']}</td>";
                    echo "<td>{$blood_request_row['patient_name']}</td>";
                    echo "<td>{$blood_request_row['patient_email']}</td>";
                    echo "<td>{$blood_request_row['requested_blood_type']}</td>";// Center the content
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


        <h2>Requested Blood</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Requester Name</th>
                    <th>Requester Email</th>
                    <th>Requester Number</th>
                    <th>Requested Blood Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($requester_info_row = $requester_info_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$requester_info_row['requester_name']}</td>";
                    echo "<td>{$requester_info_row['requester_email']}</td>";
                    echo "<td>{$requester_info_row['requester_number']}</td>";
                    echo "<td>{$requester_info_row['requested_blood_type']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Donor Modal -->
       <!-- Edit Donor Modal -->
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

        <!-- Include Bootstrap JS -->
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

    function saveDonorChanges() {
        var donorId = document.getElementById('donorId').value;
        var firstName = document.getElementById('firstName').value;
        var lastName = document.getElementById('lastName').value;
        var email = document.getElementById('email').value;

        fetch('save_donor_changes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'donorId=' + donorId + '&firstName=' + encodeURIComponent(firstName) + '&lastName=' + encodeURIComponent(lastName) + '&email=' + encodeURIComponent(email),
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                sendEmail(donorId, 'updated');
                location.reload(); // Reload the page to reflect the changes
            })
            .catch(error => console.error('Error:', error));
    }

    function acceptRequester(requesterId) {
        console.log('Accepted requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'accepted');
    }

    function rejectRequester(requesterId) {
        console.log('Rejected requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'rejected');
    }

    function sendEmail(donorId, status) {
        fetch('send_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'donorId=' + donorId + '&status=' + status,
        })
            .then(response => response.json())
            .then(data => {
                console.log('Email Sent:', data);
            })
            .catch(error => console.error('Error:', error));
    }

    function sendRequesterEmail(requesterId, status) {
        fetch('send_requester_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'requesterId=' + requesterId + '&status=' + status,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Change to response.text() to get the complete response text
            })
            .then(data => {
                console.log('Email Sent to Requester:', data);
            })
            .catch(error => console.error('Error:', error));
    }

    // delete function
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
