<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';
include('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $email = $_POST['email'];
    $action = $_POST['action'];

    // Update the status in the database based on the action
    $status = ($action === 'accept') ? 'accept' : 'reject';
    $sql = "UPDATE blood_request SET status='$status' WHERE id='$request_id'";

    if ($conn->query($sql) === TRUE) {
        // Send an email based on the action
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'milanlakkad025@gmail.com'; // Your email
            $mail->Password = 'ykpq xgqk ycdq xmog';   // Your app password if 2FA is enabled
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('milanlakkad025@gmail.com', 'Blood Bank');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $subject = ($action === 'accept') ? 'Blood Request Accepted' : 'Blood Request Rejected';
            $body = ($action === 'accept') ? 'Your blood request has been accepted.<br><br>Address:<br>123, Swastik Society,<br>Adajan Road, Surat,<br>Gujarat - 395009, India.' : 'Your blood request has been rejected.<br><br>Address:<br>123, Swastik Society,<br>Adajan Road, Surat,<br>Gujarat - 395009, India.';
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo ($action === 'accept') ? 'Request accepted and email sent.' : 'Request rejected and email sent.';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo 'Error updating request: ' . $conn->error;
    }
}
$conn->close();
?>