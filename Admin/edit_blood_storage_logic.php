<?php
ob_start(); // Start output buffering

include('../connection.php');

// Get the ID of the record to be edited
$id = $_GET['id'];

// Fetch the record
$sql = "SELECT * FROM blood_storage WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No record found";
    exit;
}

// Handle form submission for updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_type = $_POST['blood_group'];
    $units_available = $_POST['unit'];
    
    $update_sql = "UPDATE blood_storage SET blood_group='$blood_type', unit='$units_available' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect after successful update
        header("Location: blood_storage.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
ob_end_flush(); // Flush the output buffer
?>
