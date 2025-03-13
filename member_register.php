<?php
include('connection.php');
session_start();

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];

// Sanitize input
$fullname = $conn->real_escape_string($fullname);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($usertype == 'donor') {
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $body_weight = $_POST['body_weight'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $contact = $_POST['contact'];
    $file_upload = $_FILES['file_upload']['name'];

    // Sanitize donor input
    $dob = $conn->real_escape_string($dob);
    $age = $conn->real_escape_string($age);
    $body_weight = $conn->real_escape_string($body_weight);
    $blood_group = $conn->real_escape_string($blood_group);
    $gender = $conn->real_escape_string($gender);
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
    $insert = $conn->query("INSERT INTO donor (name, email, password, dob, age, body_weight, blood_group, gender, address, pincode, contact, file_upload) VALUES ('$fullname', '$email', '$hashed_password', '$dob',  '$age', '$body_weight',  '$blood_group', '$gender','$address', '$pincode', '$contact', '$file_upload')");
} else {
    // Insert recipient data into the database
    $insert = $conn->query("INSERT INTO recipient (name, email, password) VALUES ('$fullname', '$email', '$hashed_password')");
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
