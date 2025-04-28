<?php
include('../connection.php');

if (isset($_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);

    // Check in donor table first
    $query = "SELECT blood_group FROM donor WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['blood_group'];
        exit;
    }

    // Then check in recipient table
    $query = "SELECT blood_group FROM recipient WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['blood_group'];
        exit;
    }

    // If not found
    echo "not_found";
}
?>
