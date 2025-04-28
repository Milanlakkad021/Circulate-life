<?php
session_start();
include('..//connection.php'); // Include your database connection here

// Fetch donation data based on the donation_id parameter
if (isset($_GET['donation_id'])) {
    $donation_id = $_GET['donation_id'];
    $query = "SELECT * FROM blood_donation WHERE id = $donation_id";
    $result = $conn->query($query);
    $donation = $result->fetch_assoc();

    // Extract necessary details
    $donorName = $_SESSION['name']; // Get the donor's name from session
    $bloodGroup = $donation['blood_group'];
    $unit = $donation['unit'];
    $donationDate = $donation['donation_date'];
} else {
    // Redirect to blood donation page if no donation_id is provided
    header('Location: blood_donation.php');
    exit();
}

// Include FPDF library
require('..//FPDF\fpdf.php');

// Create instance of FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Set background color for a more formal appearance
$pdf->SetFillColor(255, 255, 255); // White background
$pdf->Rect(0, 0, 210, 297, 'F');

// Add a thin border around the page
$pdf->SetDrawColor(0, 0, 0); // Black border
$pdf->SetLineWidth(0.5);
$pdf->Rect(5, 5, 200, 287); // Rectangle border

// Title - Main Header
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(0, 0, 0); // Black color for title
$pdf->SetXY(10, 15);
$pdf->Cell(190, 10, 'Certificate of Appreciation', 0, 1, 'C');
$pdf->Ln(10);

// Subheader - Blood Bank Name
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Circulate Life Blood Bank', 0, 1, 'C');
$pdf->Ln(15);

// Horizontal Line
$pdf->SetLineWidth(1);
$pdf->Line(10, 50, 200, 50); // Horizontal line separating title and body

// Certificate Body - Message
$pdf->SetFont('Arial', '', 14);  // Set regular font style for the text
$pdf->MultiCell(0, 10, "This certificate is proudly presented to\n", 0, 'C');
$pdf->SetFont('Arial', 'B', 14);  // Set bold font for the donor's name
$pdf->MultiCell(0, 10, strtoupper($donorName), 0, 'C');  // Print donor name in bold
$pdf->SetFont('Arial', '', 14);  // Set regular font style again for the rest of the text
$pdf->MultiCell(0, 10, "for the voluntary donation of\n" . 
    $unit . " unit(s) of " . $bloodGroup . " blood to Circulate Life Blood Bank. Your selfless act is invaluable in saving lives.\n", 0, 'C');
$pdf->Ln(10);


// Donation Date
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, 'Date of Donation: ' . date('d-m-Y', strtotime($donationDate)), 0, 1, 'L');
$pdf->Ln(20);

// Signature and Seal - Placeholder for Signature and Seal
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, 'Signature: ', 0, 0, 'L');

// Add Signature Image (Replace with correct path)
$signature_image = '..//assets\images\Signeture.png';  // Update with the path to your signature image
$pdf->Image($signature_image, 40, 145, 50, 20); // Adjust the position and size of the signature image

// Add Seal Image (Replace with correct path)
$seal_image = '..//assets\images\Stemp.png';  // Update with the path to your seal image
$pdf->Image($seal_image, 150, 135, 40, 40); // Seal Image positioned at the bottom-right

// Add Seal Label
$pdf->SetFont('Arial', '', 12);  // Italic font for label
$pdf->SetTextColor(0, 0, 0);  // Set text color to black
$pdf->Text(150, 180, 'Stemp Of Circulate Life');  // Adjust position as needed

// Footer Text
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetTextColor(128, 128, 128); // Gray footer text
$pdf->SetXY(10, 275);
$pdf->Cell(190, 10, 'Thank you for your invaluable contribution to saving lives.', 0, 1, 'C');

// Output the PDF
$pdf->Output('D', 'certificate_of_appreciation.pdf');
exit();
?>
