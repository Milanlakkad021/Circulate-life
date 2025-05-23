<?php include('recipient_header.php'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="/resources/demos/style.css">
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="container-fluid">

    <h2 style="text-align: none;">Request Information</h2>
    <p>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#needblood">
        Request For Blood</button>
    </p>
    <br>
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $members = $conn->query("SELECT * FROM blood_request WHERE recipient_email='" . $_SESSION['email'] . "'");
        while ($row = $members->fetch_array()) {
          ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['reason_for_blood']; ?></td>
            <td><?php echo $row['when_required']; ?></td>
            <td><?php echo $row['unit']; ?></td>
            <td><?php echo $row['hospital_name']; ?></td>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
              <button type="button" data-toggle="modal" data-target="#deletrequester<?php echo $row['id'] ?>"
                class="btn btn-danger">
                Delete
              </button>
            </td>
          </tr>
          <!-- delete request modal -->
          <div class="modal fade" id="deletrequester<?php echo $row['id'] ?>" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Are you sure?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p>
                    <?php if ($row['status'] == 'pending') : ?>
                      Want to delete this request?
                    <?php else : ?>
                      You cannot delete this request as it is already <strong><?php echo $row['status']; ?></strong>.
                    <?php endif; ?>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <?php if ($row['status'] == 'pending') : ?>
                    <a href="delete_request.php?id=<?php echo $row['id']; ?>">
                      <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                  <?php else : ?>
                    <button type="button" class="btn btn-danger" disabled>Cannot Delete</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- end of delete request modal -->
        <?php }
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- add state modal -->
<div class="modal fade" id="needblood" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Request For Blood</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="blood_request_data.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <input type="text" name="name" id="name" placeholder="Patient Name" onkeypress="return blockNumbers(event)"
            onblur="capitalizeFirstLetter('name')" required>
          <div class="inline-fields">
            <input type="number" name="age" id="age" placeholder="Age" required>
            <select name="blood_group" id="blood_group" required>
              <option value="">Select Blood Group</option>
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
          <input type="text" name="reson" id="reson" placeholder="Reason For Blood" required>
          <input type="text" id="wr" name="wr" placeholder="When Required" required>
          <input type="number" name="unit" id="unit" placeholder="Unit of Blood" oninput="limitInputLengthAndPositive('unit', 4)" required>
          <input type="text" name="hname" id="hname" placeholder="Hospital Name" onkeypress="return blockNumbers(event)"
            onblur="capitalizeFirstLetter('hname')" required>
          <input type="text" name="dname" id="dname" placeholder="Doctor Name" onkeypress="return blockNumbers(event)"
            onblur="capitalizeFirstLetter('dname')" required>
          <div>
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" required>
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other" required>
            <label for="other">Other</label>
          </div>
          <textarea name="address" id="ADDRESS" rows="5" style="resize:none;" placeholder="Full Address"
            required></textarea>
          <div class="inline-fields">
            <input type="number" name="pincode" id="PINCODE" placeholder="Pincode" maxlength="6"
              oninput="limitInputLength('PINCODE', 6 ,6)" required>
            <input type="number" name="contact" id="CONTACT" placeholder="Contact No." maxlength="6"
              oninput="limitInputLength('CONTACT', 10 ,10)" required>
          </div>
          <input type="email" name="email" id="email" placeholder="Email" oninput="checkEmail()" required>
          <label>Upload your Health Reports (PDF only):</label>
          <input type="file" name="file_upload" id="file_upload" accept=".pdf" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="needblood">Add</button>
      </div>
      </form>
    </div>

  </div>
</div>
<?php include('recipient_footer.php'); ?>
</body>

</html>