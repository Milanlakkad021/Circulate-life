<?php include('admin_header.php');
include('../connection.php'); ?>
<link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <h2>Blood Storage</h2>
        <p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBloodEntry">Add Blood Entry</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#removeBloodEntry">Remove Blood Entry</button>
        </p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Blood Type</th>
                    <th>Units Available</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $members = $conn->query("SELECT * FROM blood_storage");
                while ($row = $members->fetch_array()) {
                    ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['unit']; ?></td>
                        <td><a href="edit_blood_storage.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Blood Entry Modal -->
<div class="modal fade" id="addBloodEntry" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Blood Entry</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="add_blood_entry.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="donor_username" id="donor_username" placeholder="Donor Username" required>
                    <div class="inline-fields">
                        <select name="blood_group" id="blood_group" required>
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
                        <input type="number" name="unit" id="unit" placeholder="Unit" min="1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addBloodEntry">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- remove Blood Entry Modal -->
<div class="modal fade" id="removeBloodEntry" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove Blood Entry</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="remove_blood_entry.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="donor_username" id="donor_username" placeholder="Username" required>
                    <div class="inline-fields">
                        <select name="blood_group" id="blood_group" required>
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
                        <input type="number" name="unit" id="unit" placeholder="Unit" min="1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addBloodEntry">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $conn->close(); ?>
<?php include('admin_footer.php'); ?>
</body>
</html>
