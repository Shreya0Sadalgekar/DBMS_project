<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $donor_id = $_POST['donor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Insert appointment into the database
    $sql = "INSERT INTO appointments (donor_id, appointment_date, appointment_time) VALUES ('$donor_id', '$appointment_date', '$appointment_time')";

    if (mysqli_query($conn, $sql)) {
        // Success message before redirect
        echo "Appointment scheduled successfully.";
        // Delay the redirect to allow viewing the message
        header("Location: localhost/BDMS/about_us.php");
        exit();
    } else {
        // Show error message if the insertion fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
