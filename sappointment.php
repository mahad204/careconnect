<?php
session_start();
include('includes/db_connect.php'); // Include your database connection script

if (isset($_POST['set_appointment'])) {
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_SESSION['patient_id']; // Replace this with your patient ID retrieval logic
    $doctor_schedule_id = null; // Replace with the correct value if needed
    $reason_for_appointment = mysqli_real_escape_string($conn, $_POST['reason_for_appointment']);
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = 'Pending';
    $patient_come_into_hospital = $_POST['patient_come_into_hospital'];

    $sql = "INSERT INTO `appointment_list` (doctor_id, patient_id, doctor_schedule_id, reason_for_appointment, appointment_date, appointment_time, status, patient_come_into_hospital)
            VALUES ('$doctor_id', '$patient_id', '$doctor_schedule_id', '$reason_for_appointment', '$appointment_date', '$appointment_time', '$status', '$patient_come_into_hospital')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment set successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Appointment</title>
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="loginstyle2.css">
</head>
<body>
    <div class="container">
        <h1>Set an Appointment</h1>
        <form action="process_appointment.php" method="post">
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" required>
                <!-- Populate this dropdown with doctor data from your database -->
                <option value="1">Doctor 1</option>
                <option value="2">Doctor 2</option>
                <!-- Add more options as needed -->
            </select>

            <label for="reason_for_appointment">Reason for Appointment:</label>
            <textarea name="reason_for_appointment" rows="4" required></textarea>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" required>

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" name="appointment_time" required>

            <label for="patient_come_into_hospital">Patient Coming to Hospital:</label>
            <select name="patient_come_into_hospital" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

            <button type="submit" name="set_appointment">Set Appointment</button>
        </form>
    </div>
</body>
</html>