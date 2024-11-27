<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['appointment_date']) && isset($_POST['appointment_time'])) {
        $fullname = $_POST['fullname'];
        $mobileno = $_POST['mobileno'];
        $emailid = $_POST['emailid'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $blood = $_POST['blood'];
        $address = $_POST['address'];
        $medical_history = $_POST['medical_history'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // Start transaction
        $conn->begin_transaction();

        try {
            // Check if the donor already exists using the mobile number
            $check_sql = "SELECT donor_id FROM donor_details WHERE donor_number = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("s", $mobileno);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows == 0) {
                // Donor does not exist; proceed with insertion
                $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, donor_medical_history) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssss", $fullname, $mobileno, $emailid, $age, $gender, $blood, $address, $medical_history);

                if ($stmt->execute()) {
                    $donor_id = $stmt->insert_id;

                    // Insert appointment data into 'appointments' table
                    $sql2 = "INSERT INTO appointments (donor_id, appointment_date, appointment_time) 
                             VALUES (?, ?, ?)";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("iss", $donor_id, $appointment_date, $appointment_time);

                    if ($stmt2->execute()) {
                        // Update donor_list with appointment details
                        $update_sql = "UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE donor_id = ?";
                        $update_stmt = $conn->prepare($update_sql);
                        $update_stmt->bind_param("ssi", $appointment_date, $appointment_time, $donor_id);

                        if ($update_stmt->execute()) {
                            // Commit the transaction if all updates are successful
                            $conn->commit();
                            header("Location: http://localhost/BDMS/admin/donor_list.php");
                            exit();
                        } else {
                            throw new Exception("Error updating donor_list: " . $update_stmt->error);
                        }
                    } else {
                        throw new Exception("Error scheduling appointment: " . $stmt2->error);
                    }
                } else {
                    throw new Exception("Error registering donor: " . $stmt->error);
                }
            } else {
                // Donor already exists; do not insert
                echo "Donor with this mobile number already exists.";
                $conn->rollback();
            }

            if (isset($stmt)) $stmt->close();
            if (isset($stmt2)) $stmt2->close();
            $check_stmt->close();
        } catch (Exception $e) {
            $conn->rollback();
            echo $e->getMessage();
        }

        $conn->close();
    } else {
        echo "Appointment details are missing.";
    }
}

?>
