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

// Retrieve requester information
$requester_info_query = "SELECT * FROM requester_info";
$requester_info_result = $conn->query($requester_info_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard - Requested Blood</title>
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
            <a class="navbar-brand" href="admin_dashboard.php">Blood Requests</a>
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

    <!-- Requested Blood Section -->
    <h2>Requested Blood</h2>
    <table class="table table-bordered" id="requestedBloodTable">
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
                        <button class='btn btn-success' onclick='showAcceptConfirmationModal({$requester_info_row['id']}, \"{$requester_info_row['requester_name']}\", \"{$requester_info_row['requester_email']}\", \"{$requester_info_row['requester_number']}\", \"{$requester_info_row['requested_blood_type']}\")'>Accept</button>
                        <button class='btn btn-danger' onclick='showRejectConfirmationModal({$requester_info_row['id']}, \"{$requester_info_row['requester_name']}\", \"{$requester_info_row['requester_email']}\", \"{$requester_info_row['requester_number']}\", \"{$requester_info_row['requested_blood_type']}\")'>Reject</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Accept Confirmation Modal -->
    <div class="modal fade" id="acceptConfirmationModal" tabindex="-1" aria-labelledby="acceptConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptConfirmationModalLabel">Accept Requester Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to accept this requester?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="acceptRequesterConfirmed()">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this hidden input field for storing the requesterId for accept -->
    <input type="hidden" id="hiddenRequesterIdAccept">

    <!-- Reject Confirmation Modal -->
    <div class="modal fade" id="rejectConfirmationModal" tabindex="-1" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectConfirmationModalLabel">Reject Requester Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this requester?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="rejectRequesterConfirmed()">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this hidden input field for storing the requesterId for reject -->
    <input type="hidden" id="hiddenRequesterIdReject">
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


    <!-- Include your JavaScript functions -->
  <!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Include your JavaScript functions -->
<script>
    function acceptRequester(requesterId) {
        console.log('Accepted requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'accepted');
    }

    function rejectRequester(requesterId) {
        console.log('Rejected requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'rejected');
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
                return response.text();
            })
            .then(data => {
                console.log('Email Sent to Requester:', data);
            })
            .catch(error => console.error('Error:', error));
    }

    function showAcceptConfirmationModal(requesterId) {
        // Show the accept confirmation modal
        $('#acceptConfirmationModal').modal('show');

        // Store the requesterId in a hidden input for later use
        $('#hiddenRequesterIdAccept').val(requesterId);
    }

    function showRejectConfirmationModal(requesterId) {
        // Show the reject confirmation modal
        $('#rejectConfirmationModal').modal('show');

        // Store the requesterId in a hidden input for later use
        $('#hiddenRequesterIdReject').val(requesterId);
    }

    function acceptRequesterConfirmed() {
        // Get the stored requesterId
        var requesterId = $('#hiddenRequesterIdAccept').val();

        // Close the modal
        $('#acceptConfirmationModal').modal('hide');

        // Perform the acceptance action
        acceptRequester(requesterId);
    }

    function rejectRequesterConfirmed() {
        // Get the stored requesterId
        var requesterId = $('#hiddenRequesterIdReject').val();

        // Close the modal
        $('#rejectConfirmationModal').modal('hide');

        // Perform the rejection action
        rejectRequester(requesterId);
    }

    function moveRequestToHistoryAndRemove(requesterId, status) {
        fetch('move_request_to_history.php', {
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
                return response.text();
            })
            .then(data => {
                console.log('Request moved to history:', data);
                removeRowFromTable(requesterId);
                updateHistoryDropdown(requesterId, status);
            })
            .catch(error => console.error('Error:', error));
    }

    function updateHistoryDropdown(requesterId, status) {
        $('#historyDropdown').append(`<option>${requesterId} - ${status}</option>`);
    }

    function acceptRequester(requesterId) {
        console.log('Accepted requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'accepted');
        moveRequestToHistoryAndRemove(requesterId, 'accepted');
    }

    function rejectRequester(requesterId) {
        console.log('Rejected requester with ID:', requesterId);
        sendRequesterEmail(requesterId, 'rejected');
        moveRequestToHistoryAndRemove(requesterId, 'rejected');
    }

    function removeRowFromTable(requesterId) {
        // Find and remove the row from the table based on requesterId
        $(`#requestedBloodTable tbody tr:has(td:contains('${requesterId}'))`).remove();
    }
</script>
<a class="btn btn-secondary" href="history.php" target="_blank">History</a>
</body>

</html>