<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

include('connection.php');
session_start();

$email = $_POST['email'];

// Generate a 6-digit OTP
$otp = rand(100000, 999999);

// Store the OTP and email in session (or in the database)
$_SESSION['email'] = $email;
$_SESSION['otp'] = $otp;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                 // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                          // Enable SMTP authentication
    $mail->Username = 'milanlakkad025@gmail.com';        // Your Gmail email
    $mail->Password = 'milanlakkad@025@##';         // Your Gmail password
    $mail->SMTPSecure = 'tls';                       // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                               // TCP port to connect to

    //Recipients
    $mail->setFrom('milanlakkad025@gmail.com', 'Milan');
    $mail->addAddress($email);                       // Add a recipient

    // Content
    $mail->isHTML(true);                             // Set email format to HTML
    $mail->Subject = 'OTP for Password Reset';
    $mail->Body    = 'Your OTP for password reset is: ' . $otp;

    $mail->send();
    echo 'OTP has been sent to your email.';
    header('Location: verify_otp.php'); // Redirect to the OTP verification page
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
