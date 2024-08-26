<?php
include('../connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Validate input
    if (!empty($request_id) && ($action == 'accept' || $action == 'reject')) {
        // Set status based on the action
        $status = $action == 'accept' ? 'Accept' : 'Rejected';

        // Update the status in the database
        $stmt = $conn->prepare("UPDATE blood_requests SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $request_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Request has been " . ($action == 'accept' ? 'accepted' : 'rejected') . " successfully.";
        } else {
            $_SESSION['error'] = "There was an error processing your request. Please try again.";
        }

        // Close statement
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid request.";
    }
}

// Redirect back to the blood requests page
header("Location: blood_requests.php"); // or the relevant page
exit();

// Close connection
$conn->close();
?>
