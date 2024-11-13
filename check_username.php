<?php
include('connection.php');

if (isset($_GET['username'])) {
    $username = $conn->real_escape_string($_GET['username']);

    // Check username in donor and recipient tables
    $query1 = "SELECT username FROM donor WHERE username = '$username'";
    $query2 = "SELECT username FROM recipient WHERE username = '$username'";

    $result1 = $conn->query($query1);
    $result2 = $conn->query($query2);

    if ($result1->num_rows > 0 || $result2->num_rows > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
}

$conn->close();
?>
