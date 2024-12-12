<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBloodEntry'])) {
    // Retrieve form inputs
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $unit = (int) $_POST['unit'];

    // Validate inputs
    if (!empty($blood_group) && $unit > 0) {
        // Insert into the database
        $sql = "INSERT INTO blood_expir (blood_group, unit, expired_date) VALUES ('$blood_group', '$unit', CURDATE())";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Blood expiry entry added successfully!"); window.location.href = "blood_storage_history.php?active_tab=expir";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Please fill in all fields correctly."); window.history.back();</script>';
    }
} else {
    echo '<script>alert("Invalid request."); window.history.back();</script>';
}

// Close the connection
$conn->close();
?>
