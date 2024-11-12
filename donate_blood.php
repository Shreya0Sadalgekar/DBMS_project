<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function validateForm() {
      const age = document.forms["donor"]["age"].value;
      const mobile = document.forms["donor"]["mobileno"].value;
      
      // Check if age is less than 20
      if (parseInt(age) < 20) {
        alert("You can't donate blood if you are under 20 years old.");
        return false; // Prevent form submission
      }

      // Check if mobile number is exactly 10 digits
      if (!/^\d{10}$/.test(mobile)) {
        alert("Please enter a valid 10-digit mobile number.");
        return false; // Prevent form submission
      }
      
      return true; // Allow form submission if all validations pass
    }
  </script>
</head>

<body>
  <?php
  $active = 'donate';
  include('head.php')
  ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Fill this for Blood Donation </h1>
          </div>
        </div>

        <!-- Form with onsubmit event to trigger JavaScript validation -->
        <form name="donor" action="savedata.php" method="post" onsubmit="return validateForm()">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name<span style="color:red">*</span></div>
              <div><input type="text" name="fullname" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
              <div><input type="tel" name="mobileno" class="form-control" required pattern="\d{10}" maxlength="10" title="Please enter exactly 10 digits"></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email Id</div>
              <div><input type="text" name="emailid" class="form-control"
              pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$" 
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Age<span style="color:red">*</span></div>
              <div><input type="text" name="age" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Gender<span style="color:red">*</span></div>
              <div>
                <select name="gender" class="form-control" required>
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <div>
                <select name="blood" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <?php
                    include 'conn.php';
                    $sql = "select * from blood";
                    $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <option value="<?php echo $row['blood_id'] ?>"><?php echo $row['blood_group'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Address<span style="color:red">*</span></div>
              <div><textarea class="form-control" name="address" required></textarea></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Medical History<span style="color:red">*</span></div>
              <div><textarea class="form-control" name="medical_history"></textarea></div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php include('footer.php') ?>
  </div>
</body>

</html>
