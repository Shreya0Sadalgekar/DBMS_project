<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Make sure the form field names match these array keys
    $donor_id = $_POST['donor_id'];
    $name = $_POST['donor_name'];
    $number = $_POST['donor_number'];
    $email = $_POST['donor_mail'];
    $age = $_POST['donor_age'];
    $gender = $_POST['donor_gender'];
    $blood_group = $_POST['blood_group']; // Update this as required if using a different key
    $address = $_POST['donor_address'];

    // Correct table name from `donor_list` to `donor_details`
    $sql = "UPDATE donor_details SET donor_name = ?, donor_number = ?, donor_mail = ?, donor_age = ?, donor_gender = ?, donor_blood = ?, donor_address = ? WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssissi", $name, $number, $email, $age, $gender, $blood_group, $address, $donor_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Donor details updated successfully'); window.location.href='donor_list.php';</script>";
    } else {
        echo "<script>alert('Error updating donor details'); window.location.href='donor_list.php';</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
