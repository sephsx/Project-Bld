<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>List of Blood</title>
</head>

<body>
    <!-- Navigation Section -->
    <section id="title">
        <!-- navbar -->
        <nav class="navbar bg-danger navbar-expand-lg">
            <a class="navbar-brand fs-5 fw-medium" href="home.php">List of Blood</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-medium" href="donor.php">Become a donor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-medium" href="home.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <!-- Blood Request Form Section -->
    <section id="form">
        <div class="container">
            <h2>List of Donor</h2>
            <form method="post" action="request.php">
                <div class="mb-3">
                    <label for="bloodType" class="form-label">Blood Type</label>
                    <select id="bloodType" class="form-select" name="bloodType">
                        <option value="" selected disabled>Select blood type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-danger">Search</button>
            </form>
        </div>
    </section>
</body>
</html>

<?php
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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bloodType'])) {
        // Collect data from the form
        $bloodType = $_POST['bloodType'];

        // Execute query to find donors with the requested blood type
        $sql = "SELECT * FROM donor WHERE bloodType = '$bloodType'";
        $result = $conn->query($sql);

        echo "<br>";
        echo "<br>";

        if ($result->num_rows > 0) {
            // Display the list of donors in a table
            echo "<h2>Available Donors for Blood Type $bloodType</h2>";
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="table-light">';
            echo '<tr>';
            echo '<th scope="col">Blood Type</th>';
            echo '<th scope="col">Full Name</th>';
            echo '<th scope="col">Email</th>';
            echo '<th scope="col">Request</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['bloodType'] . '</td>';
                echo '<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td><button type="button" class="btn btn-outline-danger" onclick="requestBloodFromSearch(\'' . $row['email'] . '\')">Request</button></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            // No donors found
            echo '<script>
                $(document).ready(function(){
                    $("#noDonorsModal").modal("show");
                });
            </script>';
        }

        // Close the database connection
        $conn->close();
    } elseif (isset($_POST['patientName'], $_POST['patientEmail'], $_POST['requestedBloodType'])) {
        // Handle blood request form submission
        $patientName = $_POST['patientName'];
        $patientEmail = $_POST['patientEmail'];
        $requestedBloodType = $_POST['requestedBloodType'];

        // Insert data into blood_requests table
        $sql = "INSERT INTO blood_requests (patient_name, patient_email, requested_blood_type) 
                VALUES ('$patientName', '$patientEmail', '$requestedBloodType')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
                alert("Blood request submitted successfully!");
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } elseif (isset($_POST['requesterName'], $_POST['requesterEmail'], $_POST['requesterNumber'], $_POST['requestedBloodType'])) {
        // Handle requester information form submission
        $requesterName = $_POST['requesterName'];
        $requesterEmail = $_POST['requesterEmail'];
        $requesterNumber = $_POST['requesterNumber'];
        $requestedBloodType = $_POST['requestedBloodType'];

        // Insert data into requester_info table
        $sql = "INSERT INTO requester_info (requester_name, requester_email, requester_number, requested_blood_type) 
                VALUES ('$requesterName', '$requesterEmail', '$requesterNumber', '$requestedBloodType')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
                alert("Requester information submitted successfully!");
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
<!-- Modal for No Donors Found -->
<div class="modal fade" id="noDonorsModal" tabindex="-1" aria-labelledby="noDonorsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noDonorsModalLabel">No Donors Found</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>No donors found for Blood Type <?php echo $bloodType; ?></p>
                <p>If there are no donors available, click the button below to request blood.</p>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#requestBloodModal">Request Blood</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Blood Request Form -->
<div class="modal fade" id="requestBloodModal" tabindex="-1" aria-labelledby="requestBloodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestBloodModalLabel">Request Blood</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your blood request form here -->
                <form method="post">
                    <!-- Add fields for patient information and blood type requested -->
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="patientName" name="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="patientEmail" name="patientEmail" required>
                    </div>
                    <!-- Add more fields as needed -->
                    <input type="hidden" name="requestedBloodType" value="<?php echo $bloodType; ?>">
                    <button type="submit" class="btn btn-outline-danger">Submit Request</button>
                </form> <!-- Close the form tag here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for Requester Information -->
<div class="modal fade" id="requesterInfoModal" tabindex="-1" aria-labelledby="requesterInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requesterInfoModalLabel">Requester Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your requester information form here -->
                <form method="post">
                    <!-- Add fields for requester information and blood type requested -->
                    <div class="mb-3">
                        <label for="requesterName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="requesterName" name="requesterName" required>
                    </div>
                    <div class="mb-3">
                        <label for="requesterEmail" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="requesterEmail" name="requesterEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="requesterNumber" class="form-label">Active Number</label>
                        <input type="number" class="form-control" id="requesterNumber" name="requesterNumber" required>
                    </div>
                    <input type="hidden" name="requestedBloodType" value="<?php echo $bloodType; ?>">
                    <button type="submit" class="btn btn-outline-danger">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function requestBloodFromSearch(email) {
        $('#requesterEmail').val(email);

        $('#requesterInfoModal').modal('show');
    }
</script>
