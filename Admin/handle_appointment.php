<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';
include('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $email = $_POST['email'];
    $action = $_POST['action'];

    $status = ($action === 'accept') ? 'accept' : 'reject';
    
    // Update appointment status
    $sql = "UPDATE appointment SET status='$status' WHERE id='$appointment_id'";

    if ($conn->query($sql) === TRUE) {
        // Send Email Notification
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'circulatelife021@gmail.com';
            $mail->Password = 'upiv wlif ibyc gjjt'; // Use App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient
            $mail->setFrom('circulatelife021@gmail.com', 'Circulate Life');
            $mail->addAddress($email);

            // Tell PHPMailer that this is an HTML email
            $mail->isHTML(true);

            // Email subject and body
            $subject = ($action === 'accept') ? 'Appointment Accepted' : 'Appointment Rejected';

            $body = ($action === 'accept')
                ? '
                    <html>
                        <body>
                            <div style="font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px;">
                                <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    <h2 style="color: green;">Appointment Accepted</h2>
                                    <p>Your appointment has been <strong>accepted</strong>. Please arrive at the blood center on time.</p>
                                    <p><strong>Location:</strong><br>
                                    123, Swastik Society,<br>Adajan Road, Surat,<br>Gujarat - 395009</p>
                                    <hr style="margin-top:20px;">
                                    <p style="font-size: 12px; color: #888;">Thank you for supporting Circulate Life.</p>
                                </div>
                            </div>
                        </body>
                    </html>'
                : '
                    <html>
                        <body>
                            <div style="font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px;">
                                <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    <h2 style="color: red;">Appointment Rejected</h2>
                                    <p>We regret to inform you that your appointment has been <strong>rejected</strong>.</p>
                                    <p>If you have any questions, feel free to contact us.</p>
                                    <hr style="margin-top:20px;">
                                    <p style="font-size: 12px; color: #888;">Thank you for supporting Circulate Life.</p>
                                </div>
                            </div>
                        </body>
                    </html>';

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            echo "Appointment status updated and email sent successfully.";

        } catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Failed to update appointment status.";
    }
    $conn->close();
}
?>
