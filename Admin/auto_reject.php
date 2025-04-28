<?php
include('../connection.php');

// Auto reject requests older than 15 minutes and still pending
$sql = "UPDATE blood_request 
        SET status = 'reject' 
        WHERE status = 'pending' 
        AND TIMESTAMPDIFF(MINUTE, created_at, NOW()) >= 15";

if ($conn->query($sql) === TRUE) {
    echo "Old pending requests auto-rejected successfully.";
} else {
    echo "Error updating records: " . $conn->error;
}

$conn->close();
?>
