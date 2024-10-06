<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-left">
                <div class="logo">
                    <img src="assets\images\img\Logo1.jpg" alt="Criculate life Logo">
                </div>
                <h2 class="h2">Login to your account</h2>
                <form action="logindata.php" method="post">
                    <input type="text" name="username" id="username" placeholder="Username" required="">
                    <input type="password" id="password" name="password" placeholder="Password" required="">
                    <div class="remember-me">
                        <input type="checkbox" id="remember-me" name="remember_me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <button type="submit">LOGIN</button>
                </form>
                <div class="not-member">
                    <a href="forgot_password.php">Forgot Password?</a><br>
                    <a href="register.php">New Member?</a>
                </div>
            </div>

        </div>
    </div>
    <!-- Js files -->
    <script src="js\script.js"></script>
    <script src="js\bootstrap.min.js"></script>
</body>

</html>