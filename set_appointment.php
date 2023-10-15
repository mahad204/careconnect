<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./includes/db_connect.php');
if (isset($_GET['doc_id']) && isset($_GET['doc_name'])) {
    $docId = $_GET['doc_id'];
    $doctorName = $_GET['doc_name'];
    // You have the doctor's name and ID, which you can use in the form.
} else {
   echo "Error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="loginstyle2.css">
</head>
<body>
<div class="container border p-3 box"> 
    <form action="set_appointment.php" method="POST">
        <h2 class="mb-3 text-center" >Patient Details</h2>
        <div class="row">
            <div class="col-md-12 mb-3">     
                <label for="patient_name" class="form-label">Patient Name:</label>
                <h5> <?php echo $_SESSION['patient_name']; ?></h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="patient_contact" class="form-label">Patient Contact:</label>
                <h5> <?php echo $_SESSION['patient_contact']; ?></h5>
            </div>

            <div class="col-md-12 mb-3">
                <label for="patient_address" class="form-label">Patient Address:</label>
                <h5> <?php echo $_SESSION['patient_address']; ?></h5>
            </div>
        </div>

        <h2 class="mb-3 text-center" >Appointment Details</h2>

        <input type="hidden" name="doctor_name" value="<?php echo $doctorName; ?>">
        <div class="mb-3">
            <label for="doctor_name" class="form-label">Doctor Name: </label>
            <h5><?php echo $doctorName?></h5>
        </div>

        <div class="mb-3">
            <label for="appointment_date" class="form-label">Appointment Date:</label>
            <input type="date" name="appointment_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="appointment_day" class="form-label">Appointment Day:</label>
            <input type="text" name="appointment_day" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="available_time" class="form-label">Available Time:</label>
            <input type="time" name="available_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="appointment_reason" class="form-label">Reason for Appointment:</label>
            <textarea name="appointment_reason" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Set Appointment</button>
        <a class="text-center" href="index.php">Home</a>
    </form>
</div>

<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>