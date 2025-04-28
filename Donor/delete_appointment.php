<?php
	include('..//connection.php');

	$id = $_GET['id'];

$query = $conn->query("SELECT status FROM appointment WHERE id = $id");
$row = $query->fetch_assoc();

if ($row['status'] == 'pending') {
    $conn->query("DELETE FROM appointment WHERE id = $id");
    header('Location: appointment_list.php?msg=Appointment deleted successfully');
} else {
    header('Location: appointment_list.php?error=Cannot delete accepted/rejected appointments');
}
?>