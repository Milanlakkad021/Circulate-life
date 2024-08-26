<?php
include('donor_header.php');
include('..//connection.php');?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
<?php
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    header('Location: ../../login.php');
    exit();
}

// Get the logged-in user's ID and type
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Fetch blood requests made by this user
$stmt = $conn->prepare("SELECT * FROM blood_requests WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>


        <h1>Your Blood Requests</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Blood Group</th>
                        <th>Reason for Blood</th>
                        <th>When Required</th>
                        <th>Unit</th>
                        <th>Hospital Name</th>
                        <th>Doctor Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['blood_group']; ?></td>
                            <td><?php echo $row['reason_for_blood']; ?></td>
                            <td><?php echo $row['when_required']; ?></td>
                            <td><?php echo $row['unit']; ?></td>
                            <td><?php echo $row['hospital_name']; ?></td>
                            <td><?php echo $row['doctor_name']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have not made any blood requests yet.</p>
        <?php endif; ?>

    </div>
</div>

<?php include('donor_footer.php'); ?>
</body>

</html>
<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>