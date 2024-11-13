<?php 
include('admin_header.php');
include('../connection.php'); 
?>

<div class="main ">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <?php 
        $sql = "SELECT id, name, age, blood_group, reason_for_blood, when_required, unit, hospital_name, doctor_name, gender, address, pincode, contact, email, file_upload FROM blood_request";
        $result = $conn->query($sql);
        ?>
        <h2>Blood Requests</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Fullname</th>
                <th>Age</th>
                <th>Blood group</th>
                <th>Reason For Blood</th>
                <th>When Required</th>
                <th>Unit</th>
                <th>Hospital Name</th>
                <th>Doctor Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Contact</th>
                <th>Email</th>
                <th>File Upload</th>
                <th>Actions</th> <!-- Add Actions column -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["age"] . "</td>
                        <td>" . $row["blood_group"] . "</td>
                        <td>" . $row["reason_for_blood"] . "</td>
                        <td>" . $row["when_required"] . "</td>
                        <td>" . $row["unit"] . "</td>
                        <td>" . $row["hospital_name"] . "</td>
                        <td>" . $row["doctor_name"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>" . $row["pincode"] . "</td>
                        <td>" . $row["contact"] . "</td>
                        <td>" . $row["email"] . "</td>";

                    // Check if file upload exists and create a link with the original file name
                    if (!empty($row["file_upload"])) {
                        $file_path = '../uploads/' . $row["file_upload"];
                        echo "<td><a href='$file_path' target='_blank'>" . $row["file_upload"] . "</a></td>";
                    } else {
                        echo "<td>No file uploaded</td>";
                    }

                    echo "<td>
                            <form action='javascript:void(0)' method='POST' style='display:inline-block; margin-bottom: 5px;' class='actionForm'>
                                <input type='hidden' name='request_id' value='" . $row["id"] . "'>
                                <input type='hidden' name='email' value='" . $row["email"] . "'>
                                <input type='hidden' name='action' value='accept'>
                                <button type='submit' class='edit-btn accept-btn' id='accept-btn-" . $row["id"] . "'>Accept</button>
                            </form>
                            <form action='javascript:void(0)' method='POST' style='display:inline-block;' class='actionForm'>
                                <input type='hidden' name='request_id' value='" . $row["id"] . "'>
                                <input type='hidden' name='email' value='" . $row["email"] . "'>
                                <input type='hidden' name='action' value='reject'>
                                <button type='submit' class='edit-btn reject-btn' id='reject-btn-" . $row["id"] . "'>Reject</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</div>

<?php include('admin_footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
    // Check local storage to maintain button states
    $('.actionForm').each(function() {
        var requestId = $(this).find('input[name="request_id"]').val();
        var status = localStorage.getItem('request_status_' + requestId);
        if (status === 'accept') {
            $('#accept-btn-' + requestId).css('background-color', 'green');
            $('#reject-btn-' + requestId).css({'background-color': 'red', 'pointer-events': 'none'});
        } else if (status === 'reject') {
            $('#reject-btn-' + requestId).css('background-color', 'green');
            $('#accept-btn-' + requestId).css({'background-color': 'red', 'pointer-events': 'none'});
        }
    });

    $('.actionForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        var form = $(this);
        var action = form.find('input[name="action"]').val();
        var requestId = form.find('input[name="request_id"]').val();

        $.ajax({
            url: 'handle_request.php',
            type: 'POST',
            data: form.serialize(), // Send the form data to handle_request.php
            success: function(response) {
                alert(response); // Show the result
                // Change button states based on action
                if (action === 'accept') {
                    $('#accept-btn-' + requestId).css('background-color', 'green'); // Highlight the "Accept" button
                    $('#reject-btn-' + requestId).css({'background-color': 'red', 'pointer-events': 'none'}); // Disable "Reject" button
                    localStorage.setItem('request_status_' + requestId, 'accept'); // Store state in local storage
                } else if (action === 'reject') {
                    $('#reject-btn-' + requestId).css('background-color', 'green'); // Highlight the "Reject" button
                    $('#accept-btn-' + requestId).css({'background-color': 'red', 'pointer-events': 'none'}); // Disable "Accept" button
                    localStorage.setItem('request_status_' + requestId, 'reject'); // Store state in local storage
                }
            },
            error: function() {
                alert('Error processing the request.');
            }
        });
    });
});

</script>
</body>
</html>
