<?php
include('connection.php');
session_start();

// Retrieve OTP and email from session
$session_otp = $_SESSION['otp'];
$email = $_SESSION['email'];

// Retrieve form data
$otp = $_POST['otp'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Check if OTP matches
if ($otp == $session_otp) {
    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update the password in the database
        $stmt = $conn->prepare("UPDATE donor SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            echo "Password reset successfully!";
            header('Location: login.php');
        } else {
            echo "Failed to reset password. Please try again.";
        }
    } else {
        echo "Passwords do not match.";
    }
} else {
    echo "Invalid OTP.";
}
?>
