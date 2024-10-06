<?php
// Include the database connection file
include('../connection.php');

if (isset($_POST['addBloodEntry'])) {
    // Sanitize and retrieve form data
    $donor_username = $conn->real_escape_string($_POST['donor_username']);
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $unit = (int)$_POST['unit']; // Cast to integer to ensure it's a number

    // Check if the donor username exists in the donor table
    $checkUserQuery = "SELECT * FROM donor WHERE username = '$donor_username'";
    $userResult = $conn->query($checkUserQuery);

    if ($userResult->num_rows > 0) {
        // If the username exists, prepare the SQL statement for insertion
        $sql = "INSERT INTO blood_donation (username, blood_group, unit) VALUES ('$donor_username', '$blood_group', $unit)";

        // Execute the insertion query
        if ($conn->query($sql) === TRUE) {
            // If the insertion is successful, redirect or display a success message
            echo "New blood entry added successfully.";
            // Redirect to the blood storage page or wherever you need
            header("Location: blood_storage.php");
            exit();
        } else {
            // Handle insertion error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Username not found, print a message
        echo "Error: The username '$donor_username' does not exist in the donor table.";
    }
}

// Close the database connection
$conn->close();
?>
