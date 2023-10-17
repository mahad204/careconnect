<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./includes/db_connect.php');

if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit;
}

function getDoctorName($conn, $docId)
{
    $query = "SELECT doc_name FROM `doctors_list` WHERE doc_id = $docId";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return isset($row['doc_name']) ? $row['doc_name'] : 'Unknown';
}

$patientId = $_SESSION['patient_id'];

// Fetch appointments for the logged-in patient
$appointments = mysqli_query($conn, "SELECT * FROM `appointment_list` WHERE patient_id = $patientId ORDER BY appointment_id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap LInk -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style13.css">
</head>
<body style="padding-top: 70px; 
overflow-x:hidden;
background: #f3f5f9;">
<div class="container-fluid">
    <!-- Navbar Start Here  -->
  <div class="container-fluid p-0">
    <!-- First Child -->
    <nav class="navbar navbar-expand-lg fxit ">
      <div class="container-fluid">
        <img src="./images/staff-logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] === '' ? 'active' : ''; ?>"
                href="index.php">Home</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='profile.php'>Profile</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='doctors.php'>Book Appointment</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href=''>My Appointments</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php
            if (!isset($_SESSION['patient_email_address'])) {
              echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome Guest</a>
              </li>";
            } else {
              echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome " . $_SESSION['patient_name'] . "</a>
              </li>";
            }
            if (!isset($_SESSION['patient_email_address'])) {
              echo " <li class='nav-item'>
                <a class='nav-link' href='patient_login.php'>Login</a>
            </li>";
            } else {
              echo " <li class='nav-item'>
                <a class='nav-link' href='patient_logout.php'>Logout</a>
            </li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <h1 class="h3 mb-4 text-gray-800">My Appointments</h1>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Appointment No.</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td>
                            <?= $appointment['appointment_id'] ?>
                        </td>
                        <td>
                            <?= getDoctorName($conn, $appointment['doctor_id']) ?>
                        </td>
                        <td>
                            <?= $appointment['appointment_date'] ?>
                        </td>
                        <td>
                            <?= $appointment['appointment_time'] ?>
                        </td>
                        <td>
                            <button class="btn btn-secondary btn-sm"><?= $appointment['status'] ?></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>