<?php include('admin_header.php'); ?>
<?php include('../connection.php'); ?>
<link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="donationTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php echo !isset($_GET['active_tab']) ? 'active' : ''; ?>" id="Donation-tab" data-toggle="tab" href="#donation" role="tab"
                    aria-controls="donation" aria-selected="true">Donation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isset($_GET['active_tab']) && $_GET['active_tab'] === 'expir' ? 'active' : ''; ?>" id="expir-tab" data-toggle="tab" href="#expir" role="tab"
                    aria-controls="expir" aria-selected="false">Expir Blood</a>
            </li>
        </ul>

        <div class="tab-content mt-3" id="donationTabsContent">
            <!-- Donation Tab -->
            <div class="tab-pane fade <?php echo !isset($_GET['active_tab']) ? 'show active' : ''; ?>" id="donation" role="tabpanel" aria-labelledby="donation-tab">
                <h2>Blood Donation History</h2>

                <!-- Search Form -->
                <form class="form-inline my-2 my-lg-0" method="get" action="">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search by Username or Blood Group" aria-label="Search"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="width: 310px;">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Go</button>
                </form>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Donation ID</th>
                            <th>Username</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Blood</th>
                            <th>Donation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                        $donationsQuery = !empty($searchTerm) 
                            ? "SELECT * FROM blood_donation WHERE username LIKE '%$searchTerm%' OR blood_group LIKE '%$searchTerm%'"
                            : "SELECT * FROM blood_donation";

                        $donations = $conn->query($donationsQuery);

                        while ($row = $donations->fetch_array()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['blood_group']}</td>
                                <td>{$row['unit']}</td>
                                <td>{$row['blood']}</td>
                                <td>{$row['donation_date']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Expired Blood Tab -->
            <div class="tab-pane fade <?php echo isset($_GET['active_tab']) && $_GET['active_tab'] === 'expir' ? 'show active' : ''; ?>" id="expir" role="tabpanel" aria-labelledby="expir-tab">
                <h2>Expired Blood Records</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expirblood">Add Expired Blood Entry</button>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Expired Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $expiredQuery = !empty($searchTerm) 
                            ? "SELECT * FROM blood_expir WHERE blood_group LIKE '%$searchTerm%' OR unit LIKE '%$searchTerm%'"
                            : "SELECT * FROM blood_expir";

                        $expired = $conn->query($expiredQuery);

                        while ($row = $expired->fetch_array()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['blood_group']}</td>
                                <td>{$row['unit']}</td>
                                <td>{$row['expired_date']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Expired Blood Entry Modal -->
            <div class="modal fade" id="expirblood" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Expired Blood Entry</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="add_expir_blood_entry.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select name="blood_group" id="blood_group" class="form-control" required>
                                        <option value="">Select Blood Type</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit">Units</label>
                                    <input type="number" name="unit" id="unit" class="form-control" placeholder="Unit" min="1" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="addBloodEntry">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php $conn->close(); ?>
<?php include('admin_footer.php'); ?>
</body>
</html>
