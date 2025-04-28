<?php
include('admin_header.php');
include('../connection.php');
?>

<div class="main">
    <div class="container-fluid">
        <h2>Appointments</h2>
        <?php
        $sql = "SELECT * FROM appointment";
        $result = $conn->query($sql);
        ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Blood Group</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $appointmentId = $row['id'];
                    echo "<tr>
                        <td>{$appointmentId}</td>
                        <td>{$row['blood_group']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>";

                    echo "<td>
                            <form action='javascript:void(0)' method='POST' class='actionForm' data-id='{$appointmentId}' style='display:inline-block;'>
                                <input type='hidden' name='appointment_id' value='{$appointmentId}'>
                                <input type='hidden' name='email' value='{$row['email']}'>
                                <input type='hidden' name='action' value='accept'>
                                <button type='submit' class='edit-btn accept-btn' id='accept-btn-{$appointmentId}'>Accept</button>
                            </form>

                            <form action='javascript:void(0)' method='POST' class='actionForm' data-id='{$appointmentId}' style='display:inline-block;'>
                                <input type='hidden' name='appointment_id' value='{$appointmentId}'>
                                <input type='hidden' name='email' value='{$row['email']}'>
                                <input type='hidden' name='action' value='reject'>
                                <button type='submit' class='edit-btn reject-btn' id='reject-btn-{$appointmentId}'>Reject</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No appointments found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</div>

<?php include('admin_footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Restore button states from localStorage
        $('.actionForm').each(function () {
            var form = $(this);
            var appointmentId = form.find('input[name="appointment_id"]').val();
            var status = localStorage.getItem('appointment_status_' + appointmentId);

            if (status === 'accept') {
                $('#accept-btn-' + appointmentId).css('background-color', 'green');
                $('#reject-btn-' + appointmentId).css({
                    'background-color': 'red',
                    'pointer-events': 'none'
                });
            } else if (status === 'reject') {
                $('#reject-btn-' + appointmentId).css('background-color', 'green');
                $('#accept-btn-' + appointmentId).css({
                    'background-color': 'red',
                    'pointer-events': 'none'
                });
            }
        });

        // Handle form submission
        $('.actionForm').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var action = form.find('input[name="action"]').val();
            var appointmentId = form.find('input[name="appointment_id"]').val();

            $.ajax({
                url: 'handle_appointment.php', // Make sure this file exists and handles status update
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    alert(response);

                    if (action === 'accept') {
                        $('#accept-btn-' + appointmentId).css('background-color', 'green');
                        $('#reject-btn-' + appointmentId).css({
                            'background-color': 'red',
                            'pointer-events': 'none'
                        });
                        localStorage.setItem('appointment_status_' + appointmentId, 'accept');
                    } else if (action === 'reject') {
                        $('#reject-btn-' + appointmentId).css('background-color', 'green');
                        $('#accept-btn-' + appointmentId).css({
                            'background-color': 'red',
                            'pointer-events': 'none'
                        });
                        localStorage.setItem('appointment_status_' + appointmentId, 'reject');
                    }
                },
                error: function () {
                    alert('Error processing the request.');
                }
            });
        });
    });
</script>

</body>
</html>
