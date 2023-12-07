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

// Retrieve history information
$history_query = "SELECT * FROM history";
$history_result = $conn->query($history_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard - History</title>
</head>

<body class="container mt-5">
    <!-- History Section -->
    <h2>History</h2>
    <table class="table table-bordered" id="historyTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requester Name</th>
                <th>Requester Email</th>
                <th>Requester Number</th>
                <th>Requested Blood Type</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($history_row = $history_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$history_row['id']}</td>";
                echo "<td>{$history_row['requester_name']}</td>";
                echo "<td>{$history_row['requester_email']}</td>";
                echo "<td>{$history_row['requester_number']}</td>";
                echo "<td>{$history_row['requested_blood_type']}</td>";
                echo "<td>{$history_row['status']}</td>";
                echo "<td>{$history_row['created_at']}</td>";
                echo "<td>
                        <button class='btn btn-danger' onclick='showDeleteConfirmationModal({$history_row['id']})'>Delete</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Record Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteRecordConfirmed()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this hidden input field for storing the recordId for delete -->
    <input type="hidden" id="hiddenRecordIdDelete">

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript functions -->
    <script>
        function showDeleteConfirmationModal(recordId) {
            // Show the delete confirmation modal
            $('#deleteConfirmationModal').modal('show');

            // Store the recordId in a hidden input for later use
            $('#hiddenRecordIdDelete').val(recordId);
        }

        function deleteRecordConfirmed() {
            // Get the stored recordId
            var recordId = $('#hiddenRecordIdDelete').val();

            // Close the modal
            $('#deleteConfirmationModal').modal('hide');

            // Perform the deletion action
            deleteRecord(recordId);
        }

        function deleteRecord(recordId) {
            // Send an AJAX request to delete the record
            fetch('delete_record.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'recordId=' + recordId,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log('Record deleted:', data);
                // Optionally, you can remove the deleted row from the table
                removeRowFromTable(recordId);
            })
            .catch(error => console.error('Error:', error));
        }

        function removeRowFromTable(recordId) {
            // Find and remove the row from the table based on recordId
            $(`#historyTable tbody tr:has(td:contains('${recordId}'))`).remove();
        }
        function deleteRecord(recordId) {
    // Send an AJAX request to delete the record
    fetch('delete_record.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'recordId=' + recordId,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log('Record deleted:', data);
        // Optionally, you can remove the deleted row from the table
        removeRowFromTable(recordId);
    })
    .catch(error => console.error('Error:', error));
}
    </script>
</body>

</html>
