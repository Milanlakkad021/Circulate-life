<?php
include '..//connection.php';  // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = $_POST['blood_group'];
    $unit = (int)$_POST['unit'];

    $query = "SELECT SUM(unit) AS total_units FROM blood_storage WHERE blood_group = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $blood_group);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $available_units = $row['total_units'] ?? 0;

    if ($available_units >= $unit) {
        echo "<span style='color: green;'>✅ $unit units are available</span>";
    } else {
        echo "<span style='color: red;'>❌ Only $available_units units available</span>";
    }

    $stmt->close();
    $conn->close();
}
?>
