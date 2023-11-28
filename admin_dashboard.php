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
            padding-top: 60px; /* Adjust the top padding for fixed navbar */
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
    <h1 class="mb-4">Admin Dashboard</h1>

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

    <h2>Blood Requests</h2>
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
                echo "<td>
                        <button class='btn btn-info' onclick='referBloodRequest({$blood_request_row['id']})'>Refer</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Requested Blood</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requester Name</th>
                <th>Requester Email</th>
                <th>Requester Number</th>
                <th>Requested Blood Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($requester_info_row = $requester_info_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$requester_info_row['id']}</td>";
                echo "<td>{$requester_info_row['requester_name']}</td>";
                echo "<td>{$requester_info_row['requester_email']}</td>";
                echo "<td>{$requester_info_row['requester_number']}</td>";
                echo "<td>{$requester_info_row['requested_blood_type']}</td>";
                echo "<td>
                        <button class='btn btn-success' onclick='acceptRequester({$requester_info_row['id']})'>Accept</button>
                        <button class='btn btn-danger' onclick='rejectRequester({$requester_info_row['id']})'>Reject</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

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
                        <!-- You can display the existing donor information in input fields here -->
                        <input type="hidden" id="donorId">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email">
                        <!-- Add more fields as needed -->
                        <button type="button" class="btn btn-primary" onclick='saveDonorChanges()'>Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your JavaScript functions -->
    <script>
        function openEditDonorModal(donorId) {
            // Make an AJAX request to get the donor information based on donorId
            // Update the modal input fields with the retrieved donor information
            // For simplicity, I'll use the Fetch API for the AJAX request

            fetch(`get_donor.php?donorId=${donorId}`)
                .then(response => response.json())
                .then(data => {
                    // Update the modal input fields
                    document.getElementById('donorId').value = data.id;
                    document.getElementById('firstName').value = data.firstName;
                    document.getElementById('lastName').value = data.lastName;
                    document.getElementById('email').value = data.email;

                    // Show the modal
                    var editDonorModal = new bootstrap.Modal(document.getElementById('editDonorModal'));
                    
                    editDonorModal.show();
                   
                })
                .catch(error => console.error('Error:', error));
                
        }

        function saveDonorChanges() {
            // Make an AJAX request to save the changes in the database
            // For simplicity, I'll use the Fetch API for the AJAX request

            var donorId = document.getElementById('donorId').value;
            var firstName = document.getElementById('firstName').value;
            var lastName = document.getElementById('lastName').value;
            var email = document.getElementById('email').value;

            // You can add more fields as needed

            fetch('save_donor_changes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'donorId=' + donorId + '&firstName=' + encodeURIComponent(firstName) + '&lastName=' + encodeURIComponent(lastName) + '&email=' + encodeURIComponent(email),
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response, e.g., close the modal or show a success message
                    console.log('Success:', data);

                    // Close the modal
                    var editDonorModal = new bootstrap.Modal(document.getElementById('editDonorModal'));
                    editDonorModal.hide();
                })
                .catch(error => console.error('Error:', error));
        }

        function editDonor(donorId) {
            // Implement edit donor functionality
            console.log("Edit donor with ID: " + donorId);
        }

        function deleteDonor(donorId) {
            // Confirm the deletion
            var confirmDelete = confirm("Are you sure you want to delete this donor?");

            if (confirmDelete) {
                // Make an AJAX request to delete the donor
                fetch('delete_donor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'donorId=' + donorId,
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response, e.g., show a success message or log an error
                        console.log(data);

                        // Refresh the page or update the donor list if needed
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function viewDonor(donorId) {
            // Implement view donor functionality
            console.log("View donor with ID: " + donorId);
        }

        function acceptBloodRequest(requestId) {
            // Implement accept blood request functionality
            console.log("Accept blood request with ID: " + requestId);
        }

        function referBloodRequest(requestId) {
            // Implement refer blood request functionality
            console.log("Refer blood request with ID: " + requestId);
        }

        function acceptRequester(requesterId) {
            // Implement accept requester functionality
            console.log("Accept requester with ID: " + requesterId);
        }

        function rejectRequester(requesterId) {
            // Implement reject requester functionality
            console.log("Reject requester with ID: " + requesterId);
        }
    </script>
</body>

</html>