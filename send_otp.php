<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('connection.php');
session_start();

// Set the time zone explicitly to avoid any discrepancies
date_default_timezone_set('Asia/Kolkata'); // Replace 'Asia/Kolkata' with your desired time zone

$email = $_POST['email'];

// Generate a 6-digit OTP
$otp = rand(100000, 999999);
$otpValidityDuration = 1 * 60; // OTP valid for 5 minutes
$otpExpiryTime = time() + $otpValidityDuration; // Calculate expiration time

// Store the OTP, email, and generation time in session
$_SESSION['email'] = $email;
$_SESSION['otp'] = $otp;
$_SESSION['otp_generated_time'] = time();
$_SESSION['otp_expiry_time'] = $otpExpiryTime;

// Format the expiration time for display
$expiryTimeFormatted = date('h:i A', $otpExpiryTime); // Format: 12-hour format (AM/PM)

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'circulatelife021@gmail.com'; // Your Gmail email
    $mail->Password = 'ceor neoc qwkp udap';    // Use App Password if 2FA is enabled
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('circulatelife021@gmail.com', 'Circulate Life');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP for Password Reset';

    // Email Body with validity time
    $mail->Body = '
    <html>
        <head>
            <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
            <style>
            .email-container {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                color: #333;
            }
            .email-header {
                text-align: center;
                margin-bottom: 20px;
            }
            .email-header img {
                max-width: 150px;
            }
            .email-body {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .email-body h1 {
                color: #d9534f;
            }
            .otp {
                font-size: 24px;
                font-weight: bold;
                color: #5bc0de;
            }
            .email-footer {
                margin-top: 20px;
                font-size: 14px;
                color: #777;
            }
            .email-footer a {
                color: #007bff;
                text-decoration: none;
            }

            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="email-header">
                    <img src="assets/images/Circulate Life.png?v=<?php echo time();?>" alt="Criculate life Logo">
                </div>
                <div class="email-body">
                    <h1>Reset Your Password</h1>
                    <p>Dear User,</p>
                    <p>We received a request to reset your password. Please use the OTP below to proceed with the password reset process:</p>
                    <p class="otp">' . $otp . '</p>
                    <p><strong>Note:</strong> This OTP is valid until <strong>' . $expiryTimeFormatted . '</strong>.</p>
                    <p>If you did not request a password reset, please ignore this email or contact our support team.</p>
                </div>
                <div class="email-footer">
                    <p>Thank you for using <strong>Circulate Life</strong>.</p>
                    <p><a href="https://example.com">Visit our website</a> for more information.</p>
                </div>
            </div>
        </body>
    </html>
    ';

    $mail->send();
    echo 'OTP has been sent to your email.';
    header('Location: verify_otp.php'); // Redirect to verify OTP page
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>