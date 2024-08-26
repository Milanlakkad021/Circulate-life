<?php include('admin_header.php'); ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
    <?php include('edit_blood_storage_logic.php'); ?>
    
    <h2>Edit Blood Storage</h2>
    <form method="post" action="">
        <label for="blood_type">Blood Type:</label><br>
        <input type="text" id="blood_type" name="blood_type" value="<?php echo htmlspecialchars($row['blood_type']); ?>" required><br><br>

        <label for="units_available">Units Available:</label><br>
        <input type="number" id="units_available" name="units_available" value="<?php echo htmlspecialchars($row['units_available']); ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
    </div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>
