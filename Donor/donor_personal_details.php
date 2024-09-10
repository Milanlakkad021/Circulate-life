<?php include('donor_profile_header.php'); ?>
<?php
// Assuming the session is started and connection to the database is established

// Get donor details from the database using session username
$donorUsername = $_SESSION['username'];
$query = "SELECT * FROM donor WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $donorUsername);
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
    $updateQuery = "UPDATE donor SET name = ?, email = ? WHERE username = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sss", $updatedName, $updatedEmail, $donorUsername);

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
            <!-- Display Username (read-only) -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $donorDetails['username']; ?>" readonly>
            </div>

            <!-- Display Password (read-only) -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $donorDetails['password']; ?>" readonly>
            </div>

            <!-- Display Usertype (read-only) -->
            <div class="form-group">
                <label for="usertype">User Type</label>
                <input type="text" class="form-control" id="usertype" name="usertype" value="<?php echo $donorDetails['usertype']; ?>" readonly>
            </div>

            <!-- Editable Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $donorDetails['name']; ?>" required>
            </div>

            <!-- Editable Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $donorDetails['email']; ?>" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>