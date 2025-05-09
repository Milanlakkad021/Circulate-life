<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';
include('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'] ?? null;
    $request_id = $_POST['request_id'] ?? null;
    $email = $_POST['email'];
    $action = $_POST['action'];

    $status = ($action === 'accept') ? 'accept' : 'reject';

    // Determine which type of request we're handling
    if ($appointment_id) {
        $sql = "UPDATE appointment SET status='$status' WHERE id='$appointment_id'";
    } elseif ($request_id) {
        $sql = "UPDATE blood_request SET status='$status' WHERE id='$request_id'";
    } else {
        echo 'Invalid request.';
        exit;
    }

    if ($conn->query($sql) === TRUE) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'circulatelife021@gmail.com';
            $mail->Password = 'upiv wlif ibyc gjjt';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('circulatelife021@gmail.com', 'Circulate Life');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->isHTML(true);
            $subject = ($action === 'accept') ? 'Appointment Accepted' : 'Appointment Rejected';
            $body = ($action === 'accept') ? '
                <html>
                        <head>
                            <style>
                                body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px; }
                                .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #ddd; border-radius: 5px; padding: 20px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1); }
                                .email-header { text-align: center; margin-bottom: 20px; }
                                .email-header img { max-width: 150px; }
                                .email-header h1 { color: #333; }
                                .email-body { color: #555; line-height: 1.6; }
                                .email-footer { text-align: center; margin-top: 20px; font-size: 12px; color: #888; }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <div class="email-header">
                                    <img src="../assets/images/Circulate Life.png" alt="Circulate Life Logo">
                                    <h1>Circulate Life</h1>
                                </div>
                                <div class="email-body">
                                    <p>Dear User,</p>
                                    <h3>Your blood request has been <strong>accepted</strong>.</h3>
                                    <p>Please proceed to the following address to collect the blood unit:</p>
                                    <p>
                                        <strong>Address:</strong><br>
                                        123, Swastik Society,<br>
                                        Adajan Road, Surat,<br>
                                        Gujarat - 395009, India.
                                    </p>
                                    <p>Thank you for trusting <strong>Circulate Life</strong>.</p>
                                </div>
                                <div class="email-footer">
                                    <p>&copy; 2024 Circulate Life. All Rights Reserved.</p>
                                    <p><a href="https://circulatelife.com">Visit Circulate Life Website</a></p>
                                </div>
                            </div>
                        </body>
                    </html>'
                : '
                    <html>
                        <head>
                            <style>
                                body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px; }
                                .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #ddd; border-radius: 5px; padding: 20px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1); }
                                .email-header { text-align: center; margin-bottom: 20px; }
                                .email-header img { max-width: 150px; }
                                .email-header h1 { color: #333; }
                                .email-body { color: #555; line-height: 1.6; }
                                .email-footer { text-align: center; margin-top: 20px; font-size: 12px; color: #888; }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <div class="email-header">
                                    <img src="<absolute-path-to-logo>" alt="Circulate Life Logo">
                                    <h1>Circulate Life</h1>
                                </div>
                                <div class="email-body">
                                    <p>Dear User,</p>
                                    <h3>Your blood request has been <strong>accepted</strong>.</h3>
                                    <p>We regret to inform you that your blood request has been <strong>rejected</strong>. If you have any questions, please contact our support team at Contect us.</p>
                                    <p>Thank you for understanding.</p>
                                </div>
                                <div class="email-footer">
                                    <p><a href="https://circulatelife.com">Visit Circulate Life Website</a></p>
                                </div>
                            </div>
                        </body>
                    </html>';

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo ($action === 'accept') ? 'Request accepted and email sent.' : 'Request rejected and email sent.';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo 'Error updating Request: ' . $conn->error;
    }
}

$conn->close();
