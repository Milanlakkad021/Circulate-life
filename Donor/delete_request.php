<?php
	include('..//connection.php');

	$id = $_GET['id'];

// Fetch the current status of the request
$query = $conn->query("SELECT status FROM requests WHERE id = $id");
$row = $query->fetch_assoc();

if ($row['status'] == 'pending') {
    $conn->query("DELETE FROM blood_request WHERE id = $id");
    header('Location: blood_request.php?msg=Request deleted successfully');
} else {
    header('Location: blood_request.php?error=Cannot delete accepted/rejected requests');
}
?>
?>