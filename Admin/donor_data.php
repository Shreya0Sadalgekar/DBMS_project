<?php
include 'conn.php';
include 'session.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    #sidebar { position: relative; margin-top: -20px; }
    #content { position: relative; margin-left: 210px; }
    @media screen and (max-width: 600px) {
      #content { margin-left: auto; margin-right: auto; }
    }
  </style>
</head>
<body style="color:black">
  <div id="header"><?php include 'header.php'; ?></div>
  <div id="sidebar"><?php $active = "list"; include 'sidebar.php'; ?></div>

  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Donor Data</h1>
          </div>
        </div>
        <hr>

        <?php
        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $sql = "
          SELECT 
            donor_data.*, 
            donor_details.donor_name, 
            donor_details.donor_number, 
            donor_details.donor_mail, 
            donor_details.donor_age, 
            donor_details.donor_gender, 
            donor_details.donor_address, 
            donor_details.donor_medical_history, 
            appointments.appointment_date 
          FROM donor_data
          JOIN donor_details ON donor_data.donor_id = donor_details.donor_id
          LEFT JOIN appointments ON donor_details.donor_id = appointments.donor_id
          LIMIT {$offset}, {$limit}";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        ?>

        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Medical History</th>
                <th>Current Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = $offset + 1;
              while ($row = mysqli_fetch_assoc($result)) {
                // Determine current status
                $status = "No Appointment"; // Default
                if (!empty($row['appointment_date'])) {
                  $status = "Scheduled - " . $row['appointment_date'];
                }
                if (!empty($row['donor_medical_history'])) {
                  $status = "Donated (Recent)";
                }
              ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['donor_name']; ?></td>
                <td><?php echo $row['donor_number']; ?></td>
                <td><?php echo $row['donor_mail']; ?></td>
                <td><?php echo $row['donor_age']; ?></td>
                <td><?php echo $row['donor_gender']; ?></td>
                <td><?php echo $row['donor_address']; ?></td>
                <td><?php echo $row['donor_medical_history']; ?></td>
                <td><?php echo $status; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <?php
        } else {
          echo "<p>No donor data found.</p>";
        }

        // Pagination
        $result_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM donor_data");
        $total_records = mysqli_fetch_assoc($result_total)['total'];
        $total_pages = ceil($total_records / $limit);

        if ($total_pages > 1) {
        ?>
        <ul class="pagination admin-pagination">
          <?php if ($page > 1) { ?>
          <li><a href="donor_data.php?page=<?php echo $page - 1; ?>">Prev</a></li>
          <?php }
          for ($i = 1; $i <= $total_pages; $i++) {
            $active = $i == $page ? "active" : "";
          ?>
          <li class="<?php echo $active; ?>"><a href="donor_data.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php }
          if ($page < $total_pages) { ?>
          <li><a href="donor_data.php?page=<?php echo $page + 1; ?>">Next</a></li>
          <?php } ?>
        </ul>
        <?php } ?>

      </div>
    </div>
  </div>

<?php
} else {
  echo '<div class="alert alert-danger">Please login first to access this page.</div>';
  echo '<a href="login.php" class="btn btn-primary">Login</a>';
}
?>

</body>
</html>
