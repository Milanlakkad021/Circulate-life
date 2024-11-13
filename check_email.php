<?php
include('connection.php');

if (isset($_GET['email'])) {
    $email = $conn->real_escape_string($_GET['email']);

    // Check email in admin, donor, and recipient tables
    $query1 = "SELECT email FROM admin WHERE email = '$email'";
    $query2 = "SELECT email FROM donor WHERE email = '$email'";
    $query3 = "SELECT email FROM recipient WHERE email = '$email'";

    $result1 = $conn->query($query1);
    $result2 = $conn->query($query2);
    $result3 = $conn->query($query3);

    if ($result1->num_rows > 0 || $result2->num_rows > 0 || $result3->num_rows > 0) {
        echo 'taken'; // Email is already taken
    } else {
        echo 'available'; // Email is available
    }
}

$conn->close();
?>
