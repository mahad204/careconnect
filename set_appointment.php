<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./includes/db_connect.php');
if (isset($_GET['doc_id']) && isset($_GET['doc_name'])) {
    $docId = intval($_GET['doc_id']);
    $doctorName = $_GET['doc_name'];

    $availableDates = [];
    $result = mysqli_query($conn, "SELECT DISTINCT doctor_schedule_date FROM doctor_schedule_table WHERE doctor_id = $docId");
    while ($row = mysqli_fetch_assoc($result)) {
        $availableDates[] = $row['doctor_schedule_date'];
    }
} else {
    echo "Error";
}
if (isset($_GET['doc_id'])) {
    echo "doc is in";
}
if (isset($_POST['set_app'])) {
    if (isset($_SESSION['patient_id']) && isset($docId) ) {
        $patient_id = $_SESSION['patient_id'];
        var_dump($_SESSION);
        $sched_date = $_POST['available_date'];
        $sched_time = $_POST['available_time'];
        $reason = $_POST['appointment_reason'];
        $status = 'Pending';
        $patient_come_into_hospital = 'No';
        $sql = "INSERT INTO `appointment_list` (doctor_id, patient_id, doctor_schedule_id, reason_for_appointment, appointment_time, appointment_date, status, patient_come_into_hospital)
        VALUES ('$docId', '$patient_id',  1, '$reason', '$sched_time', '$sched_date', '$status', '$patient_come_into_hospital')";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Successfully Added')</script>";
        } else {
            echo "<script> alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    } else {
        echo "Error: Patient information not provided.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="loginstyle2.css">
</head>

<body>
    <div class="container border p-3 box">
        <form action="set_appointment.php" method="POST">
            <h2 class="mb-3 text-center">Patient Details</h2>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="patient_name" class="form-label">Patient Name:</label>
                    <input type="text" name="pname" value="<?php echo $_SESSION['patient_name']; ?>" readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="patient_contact" class="form-label">Patient Contact:</label>
                    <input type="text" name="pcontact" value="<?php echo $_SESSION['patient_contact']; ?>" readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="patient_address" class="form-label">Patient Address:</label>
                    <input type="text" name="paddress" value="<?php echo $_SESSION['patient_address']; ?>" readonly>
                </div>
            </div>

            <h2 class="mb-3 text-center">Appointment Details</h2>

            <div class="mb-3">
                <label for="doctor_name" class="form-label">Doctor Name:</label>
                <h5 name="dname">
                    <?php echo $doctorName; ?>
                </h5>
            </div>


            <div class="mb-3">
                <label for="available_date" class="form-label">Appointment Date:</label>
                <select name="available_date" class="form-select">
                    <option value="">Select a date</option>
                    <?php
                    foreach ($availableDates as $date) {
                        echo '<option value="' . $date . '">' . $date . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="available_time" class="form-label">Appointment Time:</label>
                <input type="time" name="available_time">
            </div>

            <div class="mb-3">
                <label for="appointment_reason" class="form-label">Reason for Appointment:</label>
                <textarea name="appointment_reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="set_app">Set Appointment</button>
            <a class="text-center" href="javascript:history.back();">Back</a>
        </form>
    </div>

    <!-- Bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>