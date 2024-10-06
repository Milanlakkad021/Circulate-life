<?php
include('connection.php');
session_start();

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$usertype = $_POST['usertype'];

// Sanitize input
$fullname = $conn->real_escape_string($fullname);
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);
$email = $conn->real_escape_string($email);
$usertype = $conn->real_escape_string($usertype);

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($usertype == 'donor') {
    $body_weight = $_POST['body_weight'];
    $body_height = $_POST['body_height'];
    $age = $_POST['age'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $contact = $_POST['contact'];
    $file_upload = $_FILES['file_upload']['name'];

    // Sanitize donor input
    $body_weight = $conn->real_escape_string($body_weight);
    $body_height = $conn->real_escape_string($body_height);
    $age = $conn->real_escape_string($age);
    $blood_group = $conn->real_escape_string($blood_group);
    $gender = $conn->real_escape_string($gender);
    $dob = $conn->real_escape_string($dob);
    $address = $conn->real_escape_string($address);
    $pincode = $conn->real_escape_string($pincode);
    $contact = $conn->real_escape_string($contact);

    // Handle file upload
    if (!empty($file_upload)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_upload']['name']);
        move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file);
    }

    // Insert donor data into the database
    $insert = $conn->query("INSERT INTO donor (name, username, password, email, usertype, body_weight, body_height, age, blood_group, gender, dob, address, pincode, contact, file_upload) VALUES ('$fullname', '$username', '$hashed_password', '$email', '$usertype', '$body_weight', '$body_height', '$age', '$blood_group', '$gender', '$dob', '$address', '$pincode', '$contact', '$file_upload')");
} else {
    // Insert recipient data into the database
    $insert = $conn->query("INSERT INTO recipient (name, username, password, email, usertype) VALUES ('$fullname', '$username', '$hashed_password', '$email', '$usertype')");
}

if ($insert) {
    $_SESSION['success'] = 'Registration successful!';
    header('Location: login.php');
} else {
    echo '<div class="alert alert-danger" style="background-color: red; color: white;">
            <strong>ERROR!</strong> There was an issue with your registration. Please try again.
          </div>';
}
?>
