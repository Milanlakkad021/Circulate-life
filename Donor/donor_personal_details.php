<?php include('donor_profile_header.php'); ?>
<?php
// Assuming the session is started and connection to the database is established

// Get donor details from the database using session email
$email = $_SESSION['email'];
$query = "SELECT * FROM donor WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $donorDetails = $result->fetch_assoc();
} else {
    echo "Donor details not found!";
    exit;
}

// Handle form submission for updating name and email
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];

    // Update the name and email in the database
    $updateQuery = "UPDATE donor SET name = ?, email = ? WHERE email = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sss", $updatedName, $updatedEmail, $email);

    if ($updateStmt->execute()) {
        echo "Details updated successfully!";
        // Refresh the page to reflect the updated data
        header("Location: donor_personal_details.php");
        exit;
    } else {
        echo "Error updating details!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<div>
    <div class="container">
        <h2 class="mt-4">Donor Details</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo $donorDetails['name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $donorDetails['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="<?php echo $donorDetails['password']; ?>" readonly>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>