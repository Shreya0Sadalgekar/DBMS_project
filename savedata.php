<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if appointment data is present
    if (isset($_POST['appointment_date']) && isset($_POST['appointment_time'])) {
        // Retrieve donor data
        $fullname = $_POST['fullname'];
        $mobileno = $_POST['mobileno'];
        $emailid = $_POST['emailid'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $blood = $_POST['blood'];
        $address = $_POST['address'];
        $medical_history = $_POST['medical_history'];

        // Retrieve appointment data
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Insert donor data into 'donor_details' table
            $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, donor_medical_history) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $fullname, $mobileno, $emailid, $age, $gender, $blood, $address, $medical_history);

            if ($stmt->execute()) {
                $donor_id = $stmt->insert_id; // Get the donor's ID

                // Insert appointment data into 'appointments' table
                $sql2 = "INSERT INTO appointments (donor_id, appointment_date, appointment_time) 
                         VALUES (?, ?, ?)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("iss", $donor_id, $appointment_date, $appointment_time);

                if ($stmt2->execute()) {
                    // Commit the transaction if both inserts are successful
                    $conn->commit();
                    // Redirect to home page with a success message
                    header("Location: http://localhost/BDMS/home.php?success=1");
                    exit();
                } else {
                    // If appointment insertion fails, throw an exception
                    throw new Exception("Error scheduling appointment: " . $stmt2->error);
                }
            } else {
                // If donor insertion fails, throw an exception
                throw new Exception("Error registering donor: " . $stmt->error);
            }

            // Close statements
            $stmt2->close();
            $stmt->close();
        } catch (Exception $e) {
            // If any error occurs, rollback the transaction
            $conn->rollback();
            echo $e->getMessage();
        }

        // Close connection
        $conn->close();
    } else {
        echo "Appointment details are missing.";
    }
}
?>
