<?php
require '../FPDF\fpdf.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';
include('../connection.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$donationDate = date('Y-m-d');
$certificatePath = 'certificate_' . time() . '.pdf';

// 1. Generate PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'Blood Donation Certificate', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(0, 10, "This certificate is proudly presented to\n\n$donorName\n\nfor donating $unit unit(s) of $blood_group blood on $donationDate.\n\nYour contribution can save lives!", 0, 'C');
$pdf->Ln(20);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Thank you for being a hero!', 0, 1, 'C');
$pdf->Output('F', $certificatePath);

// 2. Send Email
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
    $mail->addAddress($donor_email, $donorName);
    $mail->addAttachment($certificatePath);

    $mail->isHTML(true);
    $subject = '🎉 Thank You for Your Life-Saving Blood Donation!';
    $Body = '
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>
            Certificate of Appreciation
        </title>
        <script src="https://cdn.tailwindcss.com">
        </script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&amp;family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
        <style>
        body {
                    font-family: Roboto, sans-serif;
                }
                .signature {
                    font-family: Great Vibes, cursive;
                }
        </style>
    </head>
    <body class="flex items-center justify-center min-h-screen bg-gray-100">
         <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-3xl">
          <div style=background-image: url("../assets/images/Circulate Life.png"); background-size: cover; background-position: center; max-width: 700px; margin: auto; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);>
   
          <div class="p-8">
           <h1 class="text-center text-3xl font-bold text-red-600">
            Circulate Life
           </h1>
           <h2 class="text-center text-2xl font-bold text-red-600">
            Blood Bank
           </h2>
           <p class="text-center text-gray-700 mt-2">
        This certificate has been awarded to <p class="text-center text-4xl signature text-red-600 mt-2">$donorName</p> for his/her voluntary blood donation to this blood bank. This impressive contribution of <strong>$unit </strong> of <strong>$blood_group</strong> blood to the noble cause is highly appreciated.
           </p>
           <div class="flex justify-between items-center mt-8">
            <p class="text-gray-700">
             Date: $donationDate
            </p>
            <img alt="Guaranteed seal" class="w-24 h-24" height="100" src="https://storage.googleapis.com/a1aa/image/Th2vuRFfSqMYpw8eexX1LkHuVdRdZrYnB62_bGinEgw.jpg" width="100"/>
            <p class="text-gray-700">
             Signature: 
            </p>
           </div>

          </div>
         </div>
    </body>
    </html>';

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->send();
    unlink($certificatePath); // ✅ Delete the file after sending
} catch (Exception $e) {
    echo "Email error: " . $mail->ErrorInfo;
}
