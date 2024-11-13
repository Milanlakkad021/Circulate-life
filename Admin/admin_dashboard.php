<?php 
include('admin_header.php'); 
//include('connection.php'); // Assuming you have a database connection file

// Query to count recipients
$recipient_count_query = "SELECT COUNT(*) AS recipient_count FROM recipient";
$recipient_result = mysqli_query($conn, $recipient_count_query);
$recipient_count = mysqli_fetch_assoc($recipient_result)['recipient_count'];

// Query to count donors
$donor_count_query = "SELECT COUNT(*) AS donor_count FROM donor";
$donor_result = mysqli_query($conn, $donor_count_query);
$donor_count = mysqli_fetch_assoc($donor_result)['donor_count'];

// Query to count total users (recipients + donors)
$total_user_count = $recipient_count + $donor_count;

?>

<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Annual Overview</h3>
                <p class="panel-subtitle"></p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <span class="mb-3" style="font-size: 24px;"><i class="lnr lnr-users"></i></span>
                                <h5 class="card-title"><?php echo $recipient_count; ?></h5>
                                <p class="text-muted">Recipient</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <span class="mb-3" style="font-size: 24px;"><i class="lnr lnr-users"></i></span>
                                <h5 class="card-title"><?php echo $donor_count; ?></h5>
                                <p class="text-muted">Donor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <span class="mb-3" style="font-size: 24px;"><i class="lnr lnr-users"></i></span>
                                <h5 class="card-title"><?php echo $total_user_count; ?></h5>
                                <p class="text-muted">Total Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div id="headline-chart" class="ct-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
</div>

<?php include('admin_footer.php'); ?>

</body>

</html>
