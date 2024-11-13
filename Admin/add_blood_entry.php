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
        // Insert into blood_donation table
        $sql = "INSERT INTO blood_donation (username, blood_group, unit) VALUES ('$donor_username', '$blood_group', $unit)";

        // Execute the insertion query for blood_donation
        if ($conn->query($sql) === TRUE) {
            // Check if blood group exists in the blood_storage table
            $checkBloodGroupQuery = "SELECT * FROM blood_storage WHERE blood_group = '$blood_group'";
            $bloodGroupResult = $conn->query($checkBloodGroupQuery);

            if ($bloodGroupResult->num_rows > 0) {
                // Blood group exists, so update the units by incrementing the existing value
                $updateStorageQuery = "UPDATE blood_storage SET unit = unit + $unit WHERE blood_group = '$blood_group'";
                if ($conn->query($updateStorageQuery) === TRUE) {
                    echo "Blood entry added and storage updated successfully.";
                } else {
                    echo "Error updating blood storage: " . $conn->error;
                }
            } else {
                // If blood group doesn't exist, insert a new entry in blood_storage
                $insertStorageQuery = "INSERT INTO blood_storage (blood_group, unit) VALUES ('$blood_group', $unit)";
                if ($conn->query($insertStorageQuery) === TRUE) {
                    echo "New blood entry and storage record added successfully.";
                } else {
                    echo "Error adding to blood storage: " . $conn->error;
                }
            }

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
