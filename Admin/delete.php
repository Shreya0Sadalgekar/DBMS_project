<?php
include 'conn.php';  // Database connection
include 'session.php';  // Session management

if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    // Step 1: Mark the donor as inactive in donor_details
    $sql = "UPDATE donor_details SET donor_status = 'inactive' WHERE donor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $donor_id);
    mysqli_stmt_execute($stmt);

    // Step 2: Update the donor_data table to reflect "not donated"
    $sql2 = "UPDATE donor_data SET donation_status = 'not donated' WHERE donor_id = ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, 'i', $donor_id);
    mysqli_stmt_execute($stmt2);

    // Check if both queries were successful
    if (mysqli_stmt_affected_rows($stmt) > 0 || mysqli_stmt_affected_rows($stmt2) > 0) {
        echo "Donor updated successfully.";
    } else {
        echo "Error updating donor or no changes made.";
    }

    // Close statements
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);

    // Redirect back to the donor list page
    header('Location: donor_list.php');
    exit;
} else {
    echo "Invalid request.";
}
?>
