<?php
// Include the database connection file
include('../connection.php');

if (isset($_POST['addBloodEntry'])) {
    // Sanitize and retrieve form data
    $donor_email = $conn->real_escape_string($_POST['donor_email']);
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $unit = (int)$_POST['unit']; // Cast to integer to ensure it's a number

    // Check if the donor email exists in the donor table
    $checkUserQuery = "SELECT * FROM donor WHERE email = '$donor_email'";
    $userResult = $conn->query($checkUserQuery);

    if ($userResult->num_rows > 0) {
        // Insert into blood_donation table
        $sql = "INSERT INTO blood_donation (email, blood_group, unit) VALUES ('$donor_email', '$blood_group', $unit)";

        // Execute the insertion query for blood_donation
        if ($conn->query($sql) === TRUE) {
            // Check if blood group exists in the blood_storage table
            $checkBloodGroupQuery = "SELECT * FROM blood_storage WHERE blood_group = '$blood_group'";
            $bloodGroupResult = $conn->query($checkBloodGroupQuery);

            if ($bloodGroupResult->num_rows > 0) {
                // Blood group exists, so update the units by incrementing the existing value
                $updateStorageQuery = "UPDATE blood_storage SET unit = unit + $unit WHERE blood_group = '$blood_group'";
                if ($conn->query($updateStorageQuery) === TRUE) {
                    // Send certificate to the donor
                    include('send_certificate.php');
                    // Display success message in JavaScript alert
                    echo "<script>alert('Blood entry added and storage updated successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating blood storage: " . $conn->error . "');</script>";
                }
            } else {
                // If blood group doesn't exist, insert a new entry in blood_storage
                $insertStorageQuery = "INSERT INTO blood_storage (blood_group, unit) VALUES ('$blood_group', $unit)";
                if ($conn->query($insertStorageQuery) === TRUE) {
                    // Send certificate to the donor
                    include('send_certificate.php');
                    // Display success message in JavaScript alert
                    echo "<script>alert('New blood entry and storage record added successfully.');</script>";
                } else {
                    echo "<script>alert('Error adding to blood storage: " . $conn->error . "');</script>";
                }
            }
            
            // Redirect to the blood storage page or wherever you need (after showing the message)
            echo "<script>window.location.href = 'blood_storage.php';</script>";
            exit();
        } else {
            // Handle insertion error
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        // email not found, print a message
        echo "<script>alert('Error: The email \"$donor_email\" does not exist in the donor table.');</script>";
    }
}

// Close the database connection
$conn->close();
?>
