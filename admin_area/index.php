<?php 
session_start();
if (!isset($_SESSION['admin_email_address'])) {
  // If the admin is not logged in, show the login page
  include('admin_login.php');
  exit; // Stop executing further code
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard </title>
    <!-- Bootstrap ccs link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <!-- Css -->
    <link rel="stylesheet" href="./styles7.css">
        <!-- font awesome Link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  <div class="container-fluid p-0">
    <!-- First Child -->
    <nav class="navbar navbar-expand-lg fxit" style="background-color: #4b4276;">
      <div class="container-fluid">
        <div class="admin-logo">
          <span class="fa fa-laptop-medical"></span>
          <large><b>Clinic Appointment System</b></large>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php 
            if(isset($_SESSION['admin_name'])){
      
                echo " <li class='nav-item'>
                  <a class='nav-link' href='admin_logout.php'>".$_SESSION['admin_name']."<i class='fa fa-power-off'></i></a>
              </li>";
              }
              ?>

            <!-- <li class="nav-item">
              <a class="nav-link" href="admin_logout.php" class="text-white">Administrator<i class="fa fa-power-off"></i></a>
            </li> -->
          </ul>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <header></header>
    <div class="row">
      <!-- Second child  -->
      <div class="col-md-3">
        <div class="wrapper">
          <div class="sidebar">
            <ul>
              <li><a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a></li>
              <li><a href="index.php?page=appointments" class="nav-item nav-appointments"><span class='icon-field'><i class="fa fa-calendar"></i></span> Appointments</a></li>
              <li><a href="index.php?page=doctors" class="nav-item nav-doctors"><span class='icon-field'><i class="fa fa-user-md"></i></span> Doctors</a></li>
              <li><a href="index.php?page=med_category" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-book-medical"></i></span> Medical Specialties</a></li>
              <li><a href="index.php?page=doctor_schedule"  class="nav-item nav-users"><span class='icon-field'><i class="fas fa-user-clock"></i></span> Doctor Schedule</a></li>
              <li><a href="index.php?page=patients" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Patients</a></li>
              <li> <a href="index.php?page=admin_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cog"></i></span> Profile</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Third child -->
      <div class="col-md-9 col">
        <div class="main_content">
            <div class="header med_category">
              Welcome Back Administrator
            </div>
        </div>
        <div class="container p-3">
          <?php
          if (isset($_GET['page']) && $_GET['page'] === 'med_category') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('med_categories.php');
          }
          if (isset($_GET['page']) && $_GET['page'] === 'doctors') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('doc-list.php');
          }
          if (isset($_GET['page']) && $_GET['page'] === 'patients') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('patient_list.php');
          }
          if (isset($_GET['page']) && $_GET['page'] === 'appointments') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('appoint_list.php');
          }
          if (isset($_GET['page']) && $_GET['page'] === 'doctor_schedule') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('doctor_schedule.php');
          }
          if (isset($_GET['page']) && $_GET['page'] === 'admin_settings') {
            echo '<style>.main_content .header.med_category { display: none; }</style>';
            include('admin-settings.php');
          }
          ?>
          
        </div>
      </div>
      
    </div>
  </div>
<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>