<?php include('admin_header.php');
include('../connection.php'); ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">

    <?php
    // Fetch data from the blood_storage table
    $sql = "SELECT * FROM blood_storage";
    $result = $conn->query($sql);
    ?>
    <h2>Blood Storage</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Blood Type</th>
                <th>Units Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['units_available']); ?></td>
                        <td>
                            <a href="edit_blood_storage.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</div>
</div>

<?php include('admin_footer.php'); ?>
</body>

</html>