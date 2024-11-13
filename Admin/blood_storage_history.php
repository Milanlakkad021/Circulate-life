<?php include('admin_header.php');
include('../connection.php'); ?>
<link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <h2>Blood Donation History</h2>

        <!-- Search Form -->
        <form class="form-inline my-2 my-lg-0" method="get" action="">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search by Username or Blood Group" aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="width: 310px;">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Go</button>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Username</th>
                    <th>Blood Group</th>
                    <th>Units</th>
                    <th>Donation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if the search term is set
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                // Modify the query based on the search term
                if (!empty($searchTerm)) {
                    $donations = $conn->query("SELECT * FROM blood_donation WHERE username LIKE '%$searchTerm%' OR blood_group LIKE '%$searchTerm%'");
                } else {
                    $donations = $conn->query("SELECT * FROM blood_donation");
                }

                // Display the records
                while ($row = $donations->fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['unit']; ?></td>
                        <td><?php echo $row['donation_date']; ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php $conn->close(); ?>
<?php include('admin_footer.php'); ?>
</body>

</html>
