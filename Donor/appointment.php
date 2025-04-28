<?php include('donor_header.php'); ?>
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

    <h2 style="text-align: none;">Appointment Information</h2>
    <p>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appointment">
        Book an Appointment</button>
    </p>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Appointment ID</th>
          <th>Blood Group</th>
          <th>Email</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Fetch appointment data for the logged-in user
        $appointments = $conn->query("SELECT * FROM appointment WHERE email='" . $_SESSION['email'] . "'");
        while ($row = $appointments->fetch_array()) {
        ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
            <td><?php echo $row['time']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
              <button type="button" data-toggle="modal" data-target="#deleteAppointment<?php echo $row['id'] ?>"
                class="btn btn-danger">
                Delete
              </button>
            </td>
          </tr>

          <!-- Delete Appointment Modal -->
          <div class="modal fade" id="deleteAppointment<?php echo $row['id'] ?>" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Are you sure?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p>
                    <?php if ($row['status'] == 'pending') : ?>
                      Do you want to delete this appointment?
                    <?php else : ?>
                      You cannot delete this appointment as it is already <strong><?php echo $row['status']; ?></strong>.
                    <?php endif; ?>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <?php if ($row['status'] == 'pending') : ?>
                    <a href="delete_appointment.php?id=<?php echo $row['id']; ?>">
                      <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                  <?php else : ?>
                    <button type="button" class="btn btn-danger" disabled>Cannot Delete</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <!-- End of Delete Appointment Modal -->
        <?php } ?>
      </tbody>
    </table>

  </div>
</div>

<!-- add request modal -->
<div class="modal fade" id="appointment" role="dialog">
  <div class="modal-dialog"> <!-- Larger modal size -->
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Book an Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="appointment_data.php" method="post" enctype="multipart/form-data" onsubmit="return validateAppointmentForm()">

          <!-- Blood Group Selection -->
          <select name="blood_group" id="blood_group" required>
            <option value="">Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>

          <!-- Email Input -->
          <input type="email" name="email" id="email" placeholder="Enter Your Email" required>

          <!-- Date Picker -->
          <input type="text" name="date" id="wr" placeholder="Appointment Date" required>

          <!-- Time Selection -->
          <select name="time" id="time" required>
            <option value="">Select Time For Appointment</option>
            <option value="09:00 AM - 12:30 PM">09:00 AM - 12:30 PM</option>
            <option value="02:00 PM - 05:00 PM">02:00 PM - 05:00 PM</option>
          </select>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="book_appointment">Book Appointment</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include('donor_footer.php'); ?>
</body>


</html>