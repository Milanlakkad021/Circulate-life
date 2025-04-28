<?php
session_start();
include('..//connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_appointment'])) {
    
    // Sanitize and retrieve form data
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    // Validate date format (YYYY-MM-DD) and prevent past dates
    $formatted_date = date('Y-m-d', strtotime($date));
    $today = date('Y-m-d');

    if ($formatted_date < $today) {
        echo "<script>alert('You cannot book an appointment in the past.'); window.location.href='appointments.php';</script>";
        exit;
    }

    // Insert appointment data into the database
    $sql = "INSERT INTO appointment (blood_group, email, date, time) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $blood_group, $email, $formatted_date, $time);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href='appointment.php';</script>";
    } else {
        echo "<script>alert('Failed to book appointment. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
