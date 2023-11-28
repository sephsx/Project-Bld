<?php
$server = "localhost";
$username = "root";
$password = "password";
$database = "bbd";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donorId = $_POST['donorId'];
    $bloodType = $_POST['bloodType'];
    $requesterName = $_POST['requesterName'];
    $requesterMobile = $_POST['requesterMobile'];
    $requesterEmail = $_POST['requesterEmail'];
    $requesterBagsOfBlood = $_POST['requesterbagsofblood'];
    $requestReason = $_POST['requestReason'];

    $sql = "INSERT INTO request (donorId, requesterName, requesterMobile, requesterEmail, requesterBagsOfBlood, requestReason)
            VALUES ('$donorId', '$requesterName', '$requesterMobile', '$requesterEmail', '$requesterBagsOfBlood', '$requestReason')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
            $(document).ready(function () {
                $("#successModal").modal("show");
            });
        </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
