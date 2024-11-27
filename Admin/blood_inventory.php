<?php include 'session.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    #sidebar { position: relative; margin-top: -20px; }
    #content { position: relative; margin-left: 210px; }
    @media screen and (max-width: 600px) {
      #content { position: relative; margin-left: auto; margin-right: auto; }
    }
    .low-stock { color: red; font-weight: bold; }
    .sufficient-stock { color: green; }
  </style>
</head>

<body style="color:black;">
  <?php
  include 'conn.php';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>

  <div id="header">
    <?php include 'header.php'; ?>
  </div>
  <div id="sidebar">
    <?php
    $active = "blood_inventory";
    include 'sidebar.php';
    ?>
  </div>

  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Blood Inventory</h1>
          </div>
        </div>
        <hr>

        <?php
        // Check if the blood_inventory table has data
        $sql_check = "SELECT * FROM blood_inventory";
        $result_check = mysqli_query($conn, $sql_check);
        
        if (mysqli_num_rows($result_check) > 0) {
            // Display alerts for blood types with low stock
            $low_stock_alerts = [];
            $alert_sql = "SELECT blood_group, total_volume FROM blood_inventory WHERE total_volume < 1000";
            $alert_result = mysqli_query($conn, $alert_sql);

            if (mysqli_num_rows($alert_result) > 0) {
                while ($alert_row = mysqli_fetch_assoc($alert_result)) {
                    $low_stock_alerts[] = $alert_row;
                }
            }

            // Show the alerts
            if (!empty($low_stock_alerts)) {
                foreach ($low_stock_alerts as $alert) {
                    echo '<div class="alert alert-danger">Alert: Low stock for ' . $alert['blood_group'] . ' blood type. Only ' . $alert['total_volume'] . 'ml remaining.</div>';
                }
            } else {
                echo '<div class="alert alert-success">All blood types are sufficiently stocked.</div>';
            }
        }
        ?>

        <div class="table-responsive">
          <table class="table table-bordered" style="text-align:center">
            <thead>
              <tr>
                <th>Blood Type</th>
                <th>Total Volume (ml)</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT blood_group, total_volume FROM blood_inventory";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      $blood_group = $row['blood_group'];
                      echo "<tr>";
                      echo "<td>" . $blood_group . "</td>";
                      echo "<td>" . $row['total_volume'] . "</td>";

                      // Check if the volume is below 1000ml to display appropriate status
                      if ($row['total_volume'] < 1000) {
                          echo "<td class='low-stock'>Low Stock</td>";
                      } else {
                          echo "<td class='sufficient-stock'>Sufficient</td>";
                      }
                      echo "</tr>";
                  }
              } else {
                  // Display message when there are no blood entries in the table
                  echo "<tr><td colspan='3' class='text-center'><b>No blood entry found in the inventory.</b></td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      </div> <!-- End of Container Fluid -->
    </div> <!-- End of Content Wrapper -->
  </div> <!-- End of Content -->

  <?php
  } else {
    echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
  ?>
  <form method="post" action="login.php" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-4" style="float:left">
        <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
      </div>
    </div>
  </form>
  <?php } ?>

</body>

</html>