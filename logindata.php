<?php
include('connection.php');
session_start();

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Function to check user in a specific table
function check_user_in_table($conn, $table, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result();
}

// Check in 'admin' table
$result = check_user_in_table($conn, 'admin', $username, $password);
$user_type = 'admin'; // Set user type

if ($result->num_rows == 0) {
    // If not found in 'admin', check 'donor' table
    $result = check_user_in_table($conn, 'donor', $username, $password);
    $user_type = 'donor'; // Update user type
}

if ($result->num_rows == 0) {
    // If not found in 'donor', check 'recipient' table
    $result = check_user_in_table($conn, 'recipient', $username, $password);
    $user_type = 'recipient'; // Update user type
}

// Process the result
if ($result->num_rows == 1) {
    $fetch = $result->fetch_assoc();

    // Store user ID, username, and type in session variables
    $_SESSION['user_id'] = $fetch['id'];
    $_SESSION['username'] = $fetch['username'];
    $_SESSION['user_type'] = $user_type;

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
    // If no valid user is found, redirect back to login page with an error
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: login.php'); 
    exit();
}
?>
