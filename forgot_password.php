<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-box">
            <h2>Forgot Password</h2>
            <form action="send_otp.php" method="post">
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <button type="submit">Send OTP</button>
            </form>
        </div>
    </div>
</body>
</html>
