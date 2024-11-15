<?php
// Get data from the form
$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];  // This is the blood group ID selected from the dropdown
$address = $_POST['address'];
$appointment_date = $_POST['appointment_date'];  // Appointment date from the form
$appointment_time = $_POST['appointment_time'];  // Appointment time from the form

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

// Insert donor details into donor_details table
$sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
        VALUES ('{$name}', '{$number}', '{$email}', '{$age}', '{$gender}', '{$blood_group}', '{$address}')";

if (mysqli_query($conn, $sql)) {
    // Get the donor's ID after the donor details insertion
    $donor_id = mysqli_insert_id($conn);

    // Insert appointment details into the appointments table
    $appointment_sql = "INSERT INTO appointments (donor_id, appointment_date, appointment_time) 
                        VALUES ('{$donor_id}', '{$appointment_date}', '{$appointment_time}')";

    if (mysqli_query($conn, $appointment_sql)) {
        // Successful insertion, redirect to the home page
        header("Location: http://localhost/BDMS/home.php?id=$donor_id");
    } else {
        die("Appointment insertion failed: " . mysqli_error($conn));
    }
} else {
    die("Donor details insertion failed: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>

