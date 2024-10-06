<?php include('donor_header.php'); include('../connection.php') ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <h2 style="text-align: none;">Blood Donation Information</h2>
      <br>
      <table class="table table-bordered">
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
          $username = $_SESSION['username']; // Assuming the username is stored in the session
          $donations = $conn->query("SELECT * FROM blood_donation WHERE username='$username'");

          while ($row = $donations->fetch_array()) {
            ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['blood_group']; ?></td>
              <td><?php echo $row['unit']; ?></td>
              <td><?php echo $row['donation_date']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
</div>

<?php include('donor_footer.php'); ?>
</body>
</html>
