<?php include 'session.php'; ?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    #sidebar { position:relative; margin-top:-20px }
    #content { position:relative; margin-left:210px }
    @media screen and (max-width: 600px) {
      #content { position:relative; margin-left:auto; margin-right:auto; }
    }
  </style>

  <!-- JavaScript for Validation -->
  <script>
    function validateForm() {
      const name = document.forms["donor"]["fullname"].value;
      const mobile = document.forms["donor"]["mobileno"].value;
      const email = document.forms["donor"]["emailid"].value;
      const age = document.forms["donor"]["age"].value;

      // Full name should be at least 3 characters
      if (name.length < 3) {
        alert("Full Name must be at least 3 characters long.");
        return false;
      }

      // Mobile number must be exactly 10 digits
      const mobilePattern = /^[0-9]{10}$/;
      if (!mobilePattern.test(mobile)) {
        alert("Mobile Number must be exactly 10 digits.");
        return false;
      }

      // Email ID must follow standard email format
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (email && !emailPattern.test(email)) {
        alert("Please enter a valid Email ID (e.g., abcd@xyz.com).");
        return false;
      }

      // Age must be greater than 18
  if (isNaN(age) || age <= 18) {
    alert("Age must be greater than 18.");
    return false;
  }

      // If all validations pass, allow form submission
      return true;
    }

  function popup() {
  alert("Data added successfully.");
  }

  </script>
</head>

<body style="color:black">
  <?php
    include 'conn.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>
<div id="header">
<?php $active="add"; include 'header.php'; ?>
</div>
<div id="sidebar">
<?php include 'sidebar.php'; ?>
</div>
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title">Add Donor</h1>
        </div>
      </div>
      <hr>
      <form name="donor" action="save_donor_data.php" method="post" onsubmit="return validateForm()">
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Full Name<span style="color:red">*</span></div>
      <div><input type="text" name="fullname" class="form-control" required></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
      <div><input type="text" name="mobileno" class="form-control" required></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Email Id</div>
      <div><input type="email" name="emailid" class="form-control"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Age<span style="color:red">*</span></div>
      <div><input type="text" name="age" class="form-control" required></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Gender<span style="color:red">*</span></div>
      <div><select name="gender" class="form-control" required>
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Blood Group<span style="color:red">*</span></div>
      <div><select name="blood" class="form-control" required>
        <option value="" selected disabled>Select</option>
        <?php
        $sql = "select * from blood";
        $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <option value="<?php echo $row['blood_id'] ?>"><?php echo $row['blood_group'] ?></option>
        <?php } ?>
      </select></div>
    </div>
  </div>

  <!-- New Medical History and Address Section -->
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Medical History<span style="color:red">*</span></div>
      <div><textarea class="form-control" name="medical_history" required></textarea></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Address<span style="color:red">*</span></div>
      <div><textarea class="form-control" name="address" required></textarea></div>
    </div>
  </div>

  <!-- Appointment Scheduling Section -->
  <div class="row">
    <div class="col-lg-7">
      <h1 class="mt-3 mb-3">Choose Appointment Scheduling</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Appointment Date<span style="color:red">*</span></div>
      <div><input type="date" name="appointment_date" class="form-control" required></div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="font-italic">Appointment Time<span style="color:red">*</span></div>
      <div><input type="time" name="appointment_time" class="form-control" required></div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div><input type="submit" name="submit" class="btn btn-primary" value="Submit"></div>
    </div>
  </div>
</form>


      <?php
        } else {
          echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
      ?>
      <form method="post" name="" action="login.php" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-8 col-sm-offset-4" style="float:left">
            <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
          </div>
        </div>
      </form>
      <?php } ?>
     <script>
       function popup() {
         alert("Data added Successfully.");
       }
     </script>
</body>
</html>
