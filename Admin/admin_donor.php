<?php include('admin_header.php'); include('../connection.php') ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <?php 
        $sql = "SELECT id, name, email, password, dob, body_weight, blood_group, gender, address, pincode, contact, file_upload FROM donor";
        $result = $conn->query($sql);
        ?>
        <h2>Donor Information</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Password</th>
                <th>DOB</th>
                <th>Body Weight</th>
                <th>Blood group</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Contact</th>
                <th>File Upload</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["password"] . "</td>
                        <td>" . $row["dob"] . "</td>
                        <td>" . $row["body_weight"] . "</td>
                        <td>" . $row["blood_group"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>" . $row["pincode"] . "</td>
                        <td>" . $row["contact"] . "</td>";

                    // Check if file upload exists and create a link
                    if (!empty($row["file_upload"])) {
                        $file_path = '../uploads/' . $row["file_upload"];
                        echo "<td><a href='$file_path' target='_blank'>" . $row["file_upload"] . "</a></td>";
                    } else {
                        echo "<td>No file uploaded</td>";
                    }

                    echo "</tr>";
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
