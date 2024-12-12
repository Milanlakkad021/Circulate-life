<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-left">
                <div class="logo">
                <img src="assets/images/Circulate Life.png?v=<?php echo time(); ?>" alt="Criculate life Logo">
                </div>
                <h2 class="h2">Forgot Password</h2>
                <form action="send_otp.php" method="post">
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    <button type="submit">Send OTP</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>