<?php include('admin_header.php');
include('../connection.php') ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <?php

        // Modify SQL query to fetch only users
        $sql = "SELECT id, name, email, password FROM recipient";
        $result = $conn->query($sql);
        ?>
        <h2>Recipient Information</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }
            $conn->close();
            ?>
    </div>
</div>

<?php include('admin_footer.php'); ?>
</body>

</html>