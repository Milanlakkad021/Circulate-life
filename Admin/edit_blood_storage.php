<?php include('admin_header.php'); ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
    <?php include('edit_blood_storage_logic.php'); ?>
    
    <h2>Edit Blood Storage</h2>
    <form method="post" action="">
        <label for="blood_group">Blood Type:</label><br>
        <input type="text" id="blood_group" name="blood_group" value="<?php echo htmlspecialchars($row['blood_group']); ?>" required><br><br>

        <label for="unit">Units Available:</label><br>
        <input type="number" id="unit" name="unit" value="<?php echo htmlspecialchars($row['unit']); ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
    </div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>
