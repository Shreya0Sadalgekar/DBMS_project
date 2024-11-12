<?php
$donor_id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Choose Appointment Date and Time</title>
</head>
<body>
  <?php
  $active = 'appointment';
  include('head.php');
  ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Choose Appointment Date and Time</h1>
          </div>
        </div>

        <!-- Appointment Form -->
        <form action="localhost/BDMS/save_appointment.php" method="POST">
          <input type="hidden" name="donor_id" value="<?php echo $donor_id; ?>">

          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Appointment Date<span style="color:red">*</span></div>
              <div><input type="date" id="appointment_date" name="appointment_date" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Appointment Time<span style="color:red">*</span></div>
              <div><input type="time" id="appointment_time" name="appointment_time" class="form-control" required></div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-4 mb-4">
              <button type="submit" class="btn btn-primary">Submit Appointment</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php include('footer.php'); ?>
  </div>
</body>
</html>
