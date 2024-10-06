<?php 
include('admin_header.php');
include('../connection.php'); 
?>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <?php 
        $sql = "SELECT id, name, age, blood_group, reason_for_blood, when_required, unit, hospital_name, doctor_name, gender, address, pincode, contact, email, file_upload FROM blood_request";
        $result = $conn->query($sql);
        ?>
        <h2>Blood Requests</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Fullname</th>
                <th>Age</th>
                <th>Blood group</th>
                <th>Reason For Blood</th>
                <th>When Required</th>
                <th>Unit</th>
                <th>Hospital Name</th>
                <th>Doctor Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Contact</th>
                <th>Email</th>
                <th>File Upload</th>
                <th>Actions</th> <!-- Add Actions column -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["age"] . "</td>
                        <td>" . $row["blood_group"] . "</td>
                        <td>" . $row["reason_for_blood"] . "</td>
                        <td>" . $row["when_required"] . "</td>
                        <td>" . $row["unit"] . "</td>
                        <td>" . $row["hospital_name"] . "</td>
                        <td>" . $row["doctor_name"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>" . $row["pincode"] . "</td>
                        <td>" . $row["contact"] . "</td>
                        <td>" . $row["email"] . "</td>";

                    // Check if file upload exists and create a link with the original file name
                    if (!empty($row["file_upload"])) {
                        $file_path = '../uploads/' . $row["file_upload"];
                        echo "<td><a href='$file_path' target='_blank'>" . $row["file_upload"] . "</a></td>";
                    } else {
                        echo "<td>No file uploaded</td>";
                    }

                    echo "<td>
                            <form action='handle_request.php' method='POST' style='display:inline-block; margin-bottom: 5px;'>
                                <input type='hidden' name='request_id' value='" . $row["id"] . "'>
                                <button type='submit' name='action' value='accept' class='edit-btn'>Accept</button>
                            </form>
                            <form action='handle_request.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='request_id' value='" . $row["id"] . "'>
                                <button type='submit' name='action' value='reject' class='edit-btn'>Reject</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</div>

<?php include('admin_footer.php'); ?>
</body>
</html>
