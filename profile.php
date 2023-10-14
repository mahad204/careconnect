<?php 
include 'includes/db_connect.php'; 
session_start(); 
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
<body 
style="padding-top: 70px; 
overflow-x:hidden;
background: #f3f5f9;">
<!-- Navbar Start Here  -->
<div class="container-fluid p-0">
  <!-- First Child -->
    <nav class="navbar navbar-expand-lg fxit ">
      <div class="container-fluid">
        <img src="./images/staff-logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ">
                <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] === '' ? 'active' : ''; ?>" href="index.php">Home</a>
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
            if(!isset($_SESSION['patient_email_address'])){
              echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome Guest</a>
              </li>";
              }else {
                echo " <li class='nav-item'>
                  <a class='nav-link' href=''>Welcome ".$_SESSION['patient_name']."</a>
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
    <br>
  <!-- Second Child -->
  <div class="row justify-content-md-center">
    <div class="col col-md-6">
        <br>
        <div class="cardyy">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 ctitle">Profile Details</div>
                    <div class="col-md-6 text-right">
                        <a href="profile.php?edit_account" class="btn btn-secondary btn-sm">Edit</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-stripped">
                    <tbody>
                        <tr>
                            <th class="text-right" width="40%">Patient Name</th>
                            <td><?php echo $_SESSION['patient_name'];?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Email Address</th>
                            <td><?php echo $_SESSION['patient_email_address']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Password</th>
                            <td><?php echo $_SESSION['patient_password']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Address</th>
                            <td><?php echo $_SESSION['patient_address']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Contactno</th>
                            <td><?php echo $_SESSION['patient_contact']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Marital Status</th>
                            <td><?php echo $_SESSION['patient_maritial']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Birth</th>
                            <td><?php echo $_SESSION['patient_birth']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-12 text-center">
                    <a href="profile.php?delete_account" class="btn btn-secondary btn-sm">Delete Account</a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
const navLinks = document.querySelectorAll('.nav-link');
for (const navLink of navLinks) {
  navLink.addEventListener('click', function() {
    // Remove the active class from all other navbar links
    navLinks.forEach(link => link.classList.remove('active'));

    // Add the active class to the clicked link
    this.classList.add('active');
  });
}
</script>
