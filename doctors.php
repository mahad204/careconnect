<?php
session_start(); 
include('includes/db_connect.php');
include ('functions/common_function.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <!-- Bootstrap LInk -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style13.css">
</head>
<body>
<div class="container-fluid p-0">
  <!-- First Child -->
    <nav class="navbar navbar-expand-lg fxit z-index: 100;">
      <div class="container-fluid">
        <img src="./images/staff-logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item ">
          <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] === '' ? 'active' : ''; ?>" href="index.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] === 'doctorsHome' ? 'active' : ''; ?>" href="doctors.php">Doctors</a>
          </li>
          <li class="nav-item">
                <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] === 'about' ? 'active' : ''; ?>"
                   href="about.php">About</a>
            </li>
            <?php
            if(!isset($_SESSION['patient_email_address'])){
              echo "";
              }else {
                echo "
              <li class='nav-item'>
                  <a class='nav-link' href=''>Book Appointment</a>
              </li>";
              }
            ?>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php 
            if(!isset($_SESSION['patient_email_address'])){
              echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome Guest</a>
              </li>";
              }else {
                echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome ".$_SESSION['patient_name']."</a>
              </li>
              <li class='nav-item'>
                  <a class='nav-link' href='dashboard.php'>Profile</a>
              </li>";
              }
            if(!isset($_SESSION['patient_email_address'])){
            echo " <li class='nav-item'>
                <a class='nav-link' href='patient_login.php'>Login</a>
            </li>";
            }else {
              echo " <li class='nav-item'>
                <a class='nav-link' href='patient_logout.php'>Logout</a>
            </li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
</div>
<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'doctors') {
        if (!isset($_GET['sid'])) {
            get_unique_doctors();
        } else {
            echo "";
        }
    } else {
        echo "Page is not 'doctors', so the header is not shown.";
    }
} else {
    echo "<header></header>";
}
?>
<hr class="divider" style="max-width: 60vw">
<section class="page-section">
        <div class="container">
            <hr class="divider">
            <?php
                if (isset($_GET['search_doc'])) {
                    // Call the search_doctor function when the search form is submitted
                    search_doctor();
                } else {
                    // Display doctors or unique doctors based on the condition
                    getdoctors();
                    get_unique_doctors();
                }
            ?>
            <!--  -->
            <hr class="divider" style="max-width: 60vw">
        </div>
</section>
<!-- Last Child  -->
<!-- <div class="bg-dark text-center text-light p-3" >
  <p>All Rights Reserved By Mando Copyright © 2023 </p>
</div> -->
