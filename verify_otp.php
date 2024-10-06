<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="otp-container">
        <div class="otp-box">
            <h2>Verify OTP</h2>
            <form action="reset_password.php" method="post">
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <input type="password" name="new_password" placeholder="Enter New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
