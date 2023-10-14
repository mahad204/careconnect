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
<body>
<?php 
include 'navbar.php'; 
?>
  <!-- Second Child -->
  <!-- <nav class= "navbar navbar-light navbar-expand-lg" style="background-color: #635050;">
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
        </li>
    </ul>
  </nav> -->

  <!-- Third Child -->
  <div class="bg-light">
    <h3 class="text-center">Medical Services</h3>
    <p class="text-center">Hospitality is the core of treatment</p>
  </div>

  <!-- Fourth Child -->
    <!-- Doctors -->
    <?php if (!isset($_GET['page']) && $_GET['page'] !== 'doctorsHome') {;?>
  <div class="container">
    <div class="row gy-3">
    <?php
                    $cats = $conn->query("SELECT * FROM `medical-specialty` order by id asc");
                                while($row=$cats->fetch_assoc()):
                    ?>
                    <div class="col-md-4">
                      <div class="card">
                          <a href="index.php?page=doctors&sid=<?php echo $row['id'] ?>">
                              <img src="assets/img/<?php echo $row['img_path'] ?>" alt="" />
                              <div class="overlay">
                                  <div class="text">
                                      <h2 class="mediname"><?php echo $row['specialty'] ?></h2>
                                      <div class="fdoc">Find Doctor</div>
                                  </div>
                              </div>
                          </a>
                      </div>
                    </div>
                    <?php endwhile; ?>
    </div>
  </div>

  <div class="my-5"></div>

  <!-- Fifth Child -->
  <div class="container yesyesyes">
    <div class="row gy-3">
      <div class="col-md-6">
        <div class="text">
          <h2 class="title-text">Healing starts here</h2>
          <p>
            <b>The right answers the first time</b>
          </p>
          <p class="normal-text">
            Effective treatment depends on getting the right diagnosis. Our experts diagnose and treat the toughest medical challenges.
          </p>
          <p>
            <b>Top-ranked in Kenya.</b>
          </p>
          <p class="normal-text">
            ConnectCare has more No. 1 rankings than any other hospital in the nation according to News & World Report <a href ="">Learn more about our top-ranked specialties.</a>
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card fifthchild">
          <picture>
            <img src="./images/fifthchild.png" alt="Card Image">
          </picture>
        </div>
      </div>
    </div>

    <div class="my-5"></div>

    <div class="row gy-3">
      <div class="col-md-6">
        <div class="card fifthchild">
          <picture>
            <img src="./images/fifthchild1.png" alt="Card Image">
          </picture>
        </div>
      </div>
      <div class="col-md-6">
        <div class="text">
          <h2 class="title-text">World-class care for global patients</h2>
          <p class="normal-text">
            We make it easy for patients around the world for patients around the world to get care from Connectcare
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php }else {
    include('doctors.php');
    
  } ?>
</div>

<!-- Last Child  -->
<div class="bg-dark text-center text-light p-3" >
  <p>All Rights Reserved By Mando Copyright © 2023 </p>
</div>

<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

