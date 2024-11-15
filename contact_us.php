<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<?php 
$active ='contact';
include('head.php');

?>

<body>
  <div class="container" style="margin-top:50px;">
    <div class="col-lg-4 mb-4">
      <h1>Contact Details</h1>
      <?php
        include 'conn.php';
        $sql = "SELECT * FROM contact_info";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <p>
              <h4>Address:</h4>
              <?php echo $row['contact_address']; ?>
            </p>
            <p>
              <h4>Contact Number:</h4>
              <?php echo $row['contact_phone']; ?>
            </p>
            <p>
              <h4>Email:</h4>
              <?php echo $row['contact_mail']; ?>
            </p>
          <?php }
        } else {
          echo "<p>No contact information available.</p>";
        }
      ?>
    </div>
    <?php include 'footer.php' ?>
    </div>
  </body>
</html>

