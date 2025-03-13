<?php include('recipient_profile_header.php'); ?>
<?php
// Assuming the session is started and connection to the database is established

// Get recipient details from the database using session email
$email = $_SESSION['email'];
$query = "SELECT * FROM recipient WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $recipientDetails = $result->fetch_assoc();
} else {
    echo "Recipient details not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipient Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<div>
    <div class="container">
        <h2 class="mt-4">Recipient Details</h2>
        <form action="" method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo $recipientDetails['name']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $recipientDetails['email']; ?>" readonly>
            </div>
            <!-- Display Password (read-only) -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="<?php echo $recipientDetails['password']; ?>" readonly>
            </div>

            <!-- Display Usertype (read-only) -->
            <div class="form-group">
                <label for="usertype">User Type</label>
                <input type="text" class="form-control" id="usertype" name="usertype"
                    value="<?php echo $recipientDetails['usertype']; ?>" readonly>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>