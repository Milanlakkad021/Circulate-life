<?php include('admin_header.php');
include('../connection.php') ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
<?php 
   $sql = "SELECT id,  name, username, password, email, usertype, body_weight, body_height, age, blood_group, gender, dob, address, pincode, contact, file_upload FROM donor WHERE usertype = 'donor'";
    $result = $conn->query($sql);
    ?>
    <h2>Donor Information</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Usertype</th>
            <th>Body Weight</th>
            <th>Body Height</th>
            <th>Age</th>
            <th>Blood group</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Pincode</th>
            <th>Contact</th>
            <th>Fil Upload</th>

        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["username"] . "</td><td>" . $row["password"] . "</td><td>" . $row["usertype"] . "</td><td>" . $row["body_weight"] . "</td><td>" . $row["body_height"] . "</td><td>" . $row["age"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["address"] . "</td><td>" . $row["pincode"] . "</td><td>" . $row["contact"] . "</td><td>" . $row["file_upload"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        $conn->close();
        ?>
</div>
</div>

<?php include('admin_footer.php'); ?>
</body>

</html>
