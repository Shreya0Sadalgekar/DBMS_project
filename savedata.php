<?php
$name=$_POST['fullname'];
$number=$_POST['mobileno'];
$email=$_POST['emailid'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$blood_group=$_POST['blood'];
$address=$_POST['address'];
$medical_history = $_POST['medical_history'];

$conn=mysqli_connect("localhost","root","","blood_donation") or die("Connection error");

$sql= "INSERT INTO donor_details(donor_name,donor_number,donor_mail,donor_age,donor_gender,donor_blood,donor_address, donor_medical_history) 
       values('{$name}','{$number}','{$email}','{$age}','{$gender}','{$blood_group}','{$address}','{$medical_history}')";

/*$result=mysqli_query($conn,$sql) or die("query unsuccessful.");

header("Location: http://localhost/BDMS/home.php");*/

//changes here

if (mysqli_query($conn, $sql)) {
       $donor_id = mysqli_insert_id($conn); // Get the new donor's ID
       header("Location: http://localhost/BDMS/appointment_form.php?id=$donor_id"); // Redirect to appointment form
   } else {
       die("Query unsuccessful: " . mysqli_error($conn));
   }

mysqli_close($conn);
 ?>
