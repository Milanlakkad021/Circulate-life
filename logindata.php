<?php
include('connection.php');
session_start();

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];
$remember_me = isset($_POST['remember_me']);

// Function to check user in a specific table
function check_user_in_table($conn, $table, $email) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result();
}

// Check in 'admin' table
$result = check_user_in_table($conn, 'admin', $email);
$user_type = 'admin'; // Set user type

if ($result->num_rows == 0) {
    // If not found in 'admin', check 'donor' table
    $result = check_user_in_table($conn, 'donor', $email);
    $user_type = 'donor'; // Update user type
}

if ($result->num_rows == 0) {
    // If not found in 'donor', check 'recipient' table
    $result = check_user_in_table($conn, 'recipient', $email);
    $user_type = 'recipient'; // Update user type
}

// Process the result
if ($result->num_rows == 1) {
    $fetch = $result->fetch_assoc();

    // Verify the password using password_verify
    if (password_verify($password, $fetch['password'])) {
        // Store user ID, email, and type in session variables
        $_SESSION['user_id'] = $fetch['id'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['name'] = $fetch['name'];
        $_SESSION['user_type'] = $user_type;

        // If "Remember me" is checked
        if ($remember_me) {
            // Set cookies for 30 days
            setcookie('email', $fetch['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('user_id', $fetch['id'], time() + (86400 * 30), "/");
            setcookie('user_type', $user_type, time() + (86400 * 30), "/");
        } else {
            // If "Remember me" is not checked, clear cookies
            if (isset($_COOKIE['email'])) {
                setcookie('email', '', time() - 3600, "/");
                setcookie('user_id', '', time() - 3600, "/");
                setcookie('user_type', '', time() - 3600, "/");
            }
        }

        // Redirect based on user type
        switch ($user_type) {
            case 'admin':
                header('Location: Admin/admin_dashboard.php');
                break;
            case 'donor':
                header('Location: Donor/donor_dashboard.php');
                break;
            case 'recipient':
                header('Location: Recipient/recipient_dashboard.php');
                break;
            default:
                $_SESSION['error'] = 'Unknown user type';
                header('Location: login.php');
                break;
        }
        exit(); // Ensure no further code is executed
    } else {
        // If password is incorrect
        $_SESSION['error'] = 'Invalid password';
        header('Location: login.php');
        exit();
    }
} else {
    // If no valid user is found
    $_SESSION['error'] = 'Invalid email';
    header('Location: login.php');
    exit();
}
?>
