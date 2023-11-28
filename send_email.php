<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the Composer autoload file
require 'vendor/autoload.php';

// Function to fetch donor information based on donorId
function getDonorInformation($donorId) {
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

    // Fetch donor information based on donorId
    $donor_query = "SELECT * FROM donor WHERE id = $donorId";
    $donor_result = $conn->query($donor_query);

    if ($donor_result->num_rows > 0) {
        // Assuming there is only one donor with the given ID
        $donor_row = $donor_result->fetch_assoc();

        // Close the database connection
        $conn->close();

        // Return donor information as an associative array
        return [
            'firstName' => $donor_row['firstName'],
            'lastName' => $donor_row['lastName'],
            'email' => $donor_row['email']
            // Add more fields as needed
        ];
    } else {
        // Close the database connection
        $conn->close();

        // Donor not found
        return false;
    }
}

// Retrieve donorId and status from the POST request
$donorId = $_POST['donorId'];
$status = $_POST['status'];

// Fetch donor information based on donorId (you may need to implement this)
$donorInformation = getDonorInformation($donorId);

// Check if donor information is available
if ($donorInformation) {
    // Create a new PHPMailer instance
    $phpmailer = new PHPMailer(true);

    try {
        // Replace these values with your Mailtrap settings
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'joseph.olorbida@evsu.edu.ph';
        $phpmailer->Password = 'Deathafterdeath12'; // Use the one you see in your third-party connections

        // Sender and recipient details
        $senderEmail = 'olorbidajoseph05@gmail.com';
        $recipientEmail = $donorInformation['email'];

        // Set email content
        $phpmailer->setFrom($senderEmail);
        $phpmailer->addAddress($recipientEmail);
        $phpmailer->Subject = 'Donor Information Update';
        $phpmailer->Body = "Dear {$donorInformation['firstName']} {$donorInformation['lastName']},\n\n";
        $phpmailer->Body .= "Your donor information has been {$status}.\n";
        $phpmailer->Body .= "Thank you for your contribution!\n\n";
        $phpmailer->Body .= "Best regards,\nYour Organization";

        // Send the email
        $phpmailer->send();

        $response = ['success' => true, 'message' => 'Email sent successfully.'];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => 'Failed to send email. ' . $phpmailer->ErrorInfo];
    }
} else {
    $response = ['success' => false, 'message' => 'Donor information not found.'];
}

// Return the response as JSON
echo json_encode($response);
?>
