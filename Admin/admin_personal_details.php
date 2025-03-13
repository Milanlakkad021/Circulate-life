<?php include('admin_profile_header.php'); ?>
<?php
// Assuming the session is started and connection to the database is established

// Get admin details from the database using session username
$adminUsername = $_SESSION['email'];
$query = "SELECT * FROM admin WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $adminUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $adminDetails = $result->fetch_assoc();
} else {
    echo "Admin details not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Admin Details</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo $adminDetails['name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $adminDetails['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="<?php echo $adminDetails['password']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="usertype">User Type</label>
                <input type="text" class="form-control" id="usertype" name="usertype"
                    value="<?php echo $adminDetails['usertype']; ?>" readonly>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>