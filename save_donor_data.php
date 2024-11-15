<?php
// Get the donor and appointment data from the form
$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

// Insert the donor details into the donor_details table
$sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
        VALUES ('{$name}', '{$number}', '{$email}', '{$age}', '{$gender}', '{$blood_group}', '{$address}')";
$result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

// If donor data is inserted successfully, get the donor ID
if ($result) {
    $donor_id = mysqli_insert_id($conn); // Get the last inserted donor ID

    // Insert the appointment details into the appointments table
    $appointment_sql = "INSERT INTO appointments (donor_id, appointment_date, appointment_time) 
                        VALUES ('{$donor_id}', '{$appointment_date}', '{$appointment_time}')";
    $appointment_result = mysqli_query($conn, $appointment_sql) or die("Appointment query unsuccessful.");
    
    // If both donor and appointment data are inserted successfully, redirect to the donor list page
    if ($appointment_result) {
        header("Location: http://localhost/BDMS/admin/donor_list.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>

