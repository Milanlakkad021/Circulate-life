<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('connection.php');
session_start();

$email = $_POST['email'];

// Generate a 6-digit OTP
$otp = rand(100000, 999999);

// Store the OTP and email in session
$_SESSION['email'] = $email;
$_SESSION['otp'] = $otp;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'milanlakkad025@gmail.com'; // Your Gmail email
    $mail->Password = 'ykpq xgqk ycdq xmog';    // Use App Password if 2FA is enabled
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('milanlakkad025@gmail.com', 'Circulate Life');
    $mail->addAddress($email); 

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP for Password Reset';
    $mail->Body = 'Your OTP for password reset is: ' . $otp;

    $mail->send();
    echo 'OTP has been sent to your email.';
    header('Location: verify_otp.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
