<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



// Set content type to JSON and allow CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Get data from the POST request
$requesterId = isset($_POST['requesterId']) ? $_POST['requesterId'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;

// Validate input
if (!$requesterId || !$status) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Create connection to the database (replace these with your actual database credentials)
$server = "localhost";
$username = "root";
$password = "password";
$database = "bbd";

$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Fetch requester's email from the database
$emailQuery = "SELECT requester_email FROM requester_info WHERE id = $requesterId";
// Log the query for debugging
error_log("Query: $emailQuery");

$result = $conn->query($emailQuery);

if ($result === false) {
    // Check for query execution error
    echo json_encode(['success' => false, 'message' => 'Error in query: ' . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $to = $row['requester_email'];

    // Dummy email sending logic (replace this with your actual email sending code)
    $subject = "Blood Request Status";
    $message = "Your blood request status is: " . $status;

// Use PHPMailer for secure email sending
$phpmailer = new PHPMailer(true);
try {
    //Server settings for Gmail
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;  // Use 465 for SSL
    $phpmailer->Username = 'joseph.olorbida@evsu.edu.ph';  // Your Gmail email address
    $phpmailer->Password = 'Deathafterdeath12';  // Your Gmail password
    $phpmailer->SMTPSecure = 'tls';  // Use 'ssl' for SSL

    //Recipients
    $phpmailer->setFrom('joseph.olorbida@evsu.edu.ph', 'Joseph');
    $phpmailer->addAddress($to);

    //Content
    $phpmailer->isHTML(true);
    $phpmailer->Subject = $subject;
    $phpmailer->Body = $message;

    $phpmailer->send();
    echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to send email: ' . $phpmailer->ErrorInfo]);
}

} else {
    echo json_encode(['success' => false, 'message' => 'Requester not found']);
}

// Close the database connection
$conn->close();
?>

<script>
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
            return response.json();
        })
        .then(data => {
            console.log('Email Sent to Requester:', data);
        })
        .catch(error => console.error('Error:', error));
}
</script>
