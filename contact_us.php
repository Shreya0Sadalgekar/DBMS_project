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

<body>
<?php $active ='contact'; include 'head.php'; ?>

<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Contact</h1>
      <div class="row">
        <div class="col-lg-4 mb-4">
          <h2>Contact Details</h2>
          <?php
            include 'conn.php';
            $sql = "SELECT * FROM contact_info";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
          <br>
          <p>
            <h4>Address :</h4><?php echo $row['contact_address']; ?>
          </p>
          <p>
            <h4>Contact Number :</h4><?php echo $row['contact_phone']; ?>
          </p>
          <p>
            <h4>Email: </h4><a href="mailto:<?php echo $row['contact_mail']; ?>"><?php echo $row['contact_mail']; ?></a>
          </p>
          <?php } 
            } else {
              echo "<p>No contact information available.</p>";
            }
          ?>
        </div>
      </div>
      <!-- /.row -->
    </div>
  </div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
