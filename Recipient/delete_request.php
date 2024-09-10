<?php
	include('..//connection.php');

	$id = $_GET['id'];

	$delete = $conn->query("DELETE FROM blood_request WHERE id='$id'");
	header('location: blood_request.php');
?>