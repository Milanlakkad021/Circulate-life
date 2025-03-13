<?php include('admin_profile_header.php'); ?>
<?php


// Check if admin is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$adminUsername = $_SESSION['email'];
$message = "";

// Handle form submission to change password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Fetch the current password hash from the database
    $query = "SELECT password FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $adminUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $adminDetails = $result->fetch_assoc();
        $dbPassword = $adminDetails['password'];

        // Verify the current password with the stored hash
        if (password_verify($currentPassword, $dbPassword)) {
            // Check if the new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateQuery = "UPDATE admin SET password = ? WHERE email = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ss", $hashedPassword, $adminUsername);

                if ($updateStmt->execute()) {
                    $message = "Password updated successfully!";
                } else {
                    $message = "Error updating password!";
                }
            } else {
                $message = "New password and confirm password do not match!";
            }
        } else {
            $message = "Current password is incorrect!";
        }
    } else {
        $message = "Admin details not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Change Password</h2>
        
        <!-- Display Message -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Password Change Form -->
        <form action="" method="POST">
            <!-- Current Password -->
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>

            <!-- Confirm New Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>