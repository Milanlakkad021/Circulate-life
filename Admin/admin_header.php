<?php
include('../connection.php');
session_start();

if (!isset($_SESSION['email']) and $_SESSION['member_id'] == '') {
	header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="..//css\bootstrap.min.css?v=<?php echo time(); ?>">
	<!-- <link rel="stylesheet" href="..//css/linearicons/style.css"> -->
	<link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
</head>

<body>
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<form class="form-inline">
							<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search dashboard..." aria-label="Search"> -->
							<!-- <button class="btn btn-primary my-2 my-sm-0" type="submit">Go</button> -->
							<img src="../assets/images/Circulate Life.png" alt="Drop of blood image" style="height:80px;">
						</form>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<!-- <img src="../assets\images\img\user.png" class="img-circle" alt="Avatar"> -->
							<span><?php echo $_SESSION['name']; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="admin_dashboard.php"><i
									class="lnr lnr-home"></i>Dashboard</a>
							<a class="dropdown-item" href="admin_personal_details.php"><i class="lnr lnr-user"></i>My
								Profile</a>
							<a class="dropdown-item" data-toggle="modal" data-target="#logout"><i
									class="lnr lnr-exit"></i>Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><i
									class="lnr lnr-home"></i>Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="admin_recipient.php"><i
									class="lnr lnr-user"></i>Recipent</a></li>
						<li class="nav-item"><a class="nav-link" href="admin_donor.php"><i
									class="lnr lnr-user"></i>Donor</a></li>
						<li class="nav-item"><a class="nav-link" href="blood_storage.php"><i
									class="lnr lnr-store"></i>Blood Storage</a></li>
						<li class="nav-item"><a class="nav-link" href="blood_storage_history.php"><i
									class="lnr lnr-book"></i>History</a></li>
						<li class="nav-item"><a class="nav-link" href="blood_requests.php"><i
									class="lnr lnr-drop"></i>Blood Request</a></li>
						<li class="nav-item"><a class="nav-link" href="blood_appointment.php"><i
									class="lnr lnr-drop"></i>Appointment</a></li>
					</ul>
				</nav>
			</div>
		</div>

		<div class="modal fade" id="logout" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Are you sure?</h4>
					</div>
					<div class="modal-body">
						<p>You Want to logout now?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<a href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
					</div>
				</div>
			</div>
		</div>