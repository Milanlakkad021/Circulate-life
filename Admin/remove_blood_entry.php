<?php
// Include the database connection file
include('../connection.php');

if (isset($_POST['addBloodEntry'])) {
    // Sanitize and retrieve form data
    $recipient_email = $conn->real_escape_string($_POST['recipient_email']);
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $unit = (int)$_POST['unit']; // Cast to integer to ensure it's a number

    // Check if the donor email exists in the donor table
    $checkUserQuery = "SELECT * FROM recipient WHERE email = '$recipient_email'";
    $userResult = $conn->query($checkUserQuery);

    if ($userResult->num_rows > 0) {
        // Insert into blood_donation table with 'removed' as blood status
        $sql = "INSERT INTO blood_donation (email, blood_group, unit, blood) 
                VALUES ('$recipient_email', '$blood_group', $unit, 'removed')";

        // Execute the insertion query for blood_donation
        if ($conn->query($sql) === TRUE) {
            // Check if blood group exists in the blood_storage table
            $checkBloodGroupQuery = "SELECT * FROM blood_storage WHERE blood_group = '$blood_group'";
            $bloodGroupResult = $conn->query($checkBloodGroupQuery);

            if ($bloodGroupResult->num_rows > 0) {
                // Blood group exists, so update the units by decrementing the existing value
                $updateStorageQuery = "UPDATE blood_storage SET unit = unit - $unit WHERE blood_group = '$blood_group'";
                if ($conn->query($updateStorageQuery) === TRUE) {
                    echo "Blood entry added as 'removed' and storage updated successfully.";
                } else {
                    echo "Error updating blood storage: " . $conn->error;
                }
            } else {
                // Blood group doesn't exist in storage, show an error
                echo "Error: Blood group '$blood_group' does not exist in blood storage.";
            }

            // Redirect to the blood storage page or wherever you need
            header("Location: blood_storage.php");
            exit();
        } else {
            // Handle insertion error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // email not found, print a message
        echo "Error: The email '$recipient_email' does not exist in the donor table.";
    }
}

// Close the database connection
$conn->close();
?>
