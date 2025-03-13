<?php
include('..//connection.php');
session_start();

// Get form data
$user_id = $_SESSION['user_id']; // The logged-in user's ID
$user_type = $_SESSION['user_type']; 
$name = $_POST['name'];
$age = $_POST['age'];
$blood_group = $_POST['blood_group'];
$reason_for_blood = $_POST['reson'];
$when_required = $_POST['wr'];
$unit = $_POST['unit'];
$hospital_name = $_POST['hname'];
$doctor_name = $_POST['dname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$contact = $_POST['contact'];
$email = $_POST['email'];

// Handle file upload
$file_upload = "";
$upload_dir = 'uploads/'; // Directory to save the file

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true); // Create the directory if it does not exist
}

if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == UPLOAD_ERR_OK) {
    $file_name = basename($_FILES['file_upload']['name']);
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $file_path)) {
        $file_upload = $file_name;
    } else {
        echo "Failed to upload file.";
    }
}

// Prepare and bind
$email = $_SESSION['email']; // Get username from session

// Prepare query based on user type
$insert = $conn->query("INSERT INTO blood_request (recipient_email, name, age, blood_group, reason_for_blood, when_required, unit, hospital_name, doctor_name, gender, address, pincode, contact, email, file_upload) 
    VALUES ('$email', '$name', '$age', '$blood_group', '$reason_for_blood', '$when_required', '$unit', '$hospital_name', '$doctor_name', '$gender', '$address', '$pincode', '$contact', '$email', '$file_upload')");

//$insert = $conn->query("INSERT INTO blood_request (username, name, age, blood_group, reason_for_blood, when_required, unit, hospital_name, doctor_name, gender, address, pincode, contact, email, file_upload) 
 //   VALUES ('".$_SESSION['username']."', '$name', '$age', '$blood_group', '$reason_for_blood', '$when_required', '$unit', '$hospital_name', '$doctor_name', '$gender', '$address', '$pincode', '$contact', '$email', '$file_upload')");
//$sql = "INSERT INTO blood_request ('username', 'name', 'age', 'blood_group', 'reason_for_blood', 'when_required', 'unit, hospital_name', 'doctor_name', 'gender', 'address', 'pincode', 'contact', 'email', 'file_upload') 
  //  VALUES ('".$_SESSION['username']."', '$name', '$age', '$blood_group', '$reason_for_blood', '$when_required', '$unit', '$hospital_name', '$doctor_name', '$gender', '$address', '$pincode', '$contact', '$email', '$file_upload')";
//$stmt = $conn->prepare($sql)

// Don't forget to use the right types for each parameter!
//$stmt->bind_param("sssssssssssssss", $_SESSION['username'], $name, $age, $blood_group, $reason_for_blood, $when_required, $unit, $hospital_name, $doctor_name, $gender, $address, $pincode, $contact, $email, $file_upload);

if($insert){
    header('location:blood_request.php');
}else {
    header('location:blood_request.php');
}
?>
