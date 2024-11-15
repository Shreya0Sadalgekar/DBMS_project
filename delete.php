<?php
include 'conn.php';

$donor_id = $_GET['id'];

// Step 1: Delete any associated records in the 'appointments' table first
$delete_appointments_sql = "DELETE FROM appointments WHERE donor_id = ?";
$appointment_stmt = $conn->prepare($delete_appointments_sql);
$appointment_stmt->bind_param("i", $donor_id);
$appointment_stmt->execute();
$appointment_stmt->close();

// Step 2: Now delete the donor record from 'donor_details' table
$delete_donor_sql = "DELETE FROM donor_details WHERE donor_id = ?";
$donor_stmt = $conn->prepare($delete_donor_sql);
$donor_stmt->bind_param("i", $donor_id);
$donor_stmt->execute();
$donor_stmt->close();

// Redirect to donor_list.php after deletion
header("Location: donor_list.php");
$conn->close();
?>
