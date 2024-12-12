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
                    <img src="assets/images/Circulate Life.png?v=<?php echo time(); ?>" alt="Criculate life Logo">
                </div>
                <h2 class="h2">Login to your account</h2>
                <form action="logindata.php" method="post">
                    <?php
                    $stored_username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
                    ?>
                    <input type="text" name="username" id="username" placeholder="Username"
                        value="<?php echo $stored_username; ?>" required="">
                    <input type="password" id="password" name="password" placeholder="Password" required="">
                    <div class="remember-me">
                        <input type="checkbox" id="remember-me" name="remember_me" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>>
                        <label for="remember-me">Remember me</label>
                        <span style="margin-left: 155px;">
                            <a href="forgot_password.php">Forgot Password?</a>
                        </span>
                    </div>
                    
                    <button type="submit">LOGIN</button>
                </form>
                
                <div class="not-member">
                    <p>Don't have an account? <a href="register.php">SignUp now</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Js files -->
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>