<?php
session_start();
include('./includes/db_connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap LInk -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="loginstyle2.css">
</head>
<body>
<div class="login-container"style="width:450px;">
        <form action="patient_login.php" method="POST">
            <h3>Welcome Back!</h3>
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Email Address" autocomplete=off /> </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="patient_password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" name="user_login">Login</button>
            <p>Dont have an account?<a href="signup.php">Signup</a></p>
        </form>
    </div>
<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
if (isset($_POST['user_login'])) {
    $user_email = $_POST["patient_email_address"];
    $user_password = $_POST["patient_password"];

    $select_query = "SELECT * FROM `patient_list` WHERE patient_email_address = '$user_email'";
    $result = mysqli_query($conn, $select_query);
    $number=mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($number>0) {
        $_SESSION['patient_email_address']=$user_email;
        $_SESSION['patient_name']=$row_data['patient_first_name'];
        $_SESSION['patient_contact']=$row_data['patient_phone_no'];
        $_SESSION['patient_address']=$row_data['patient_address'];
        $_SESSION['patient_password']=$row_data['patient_password'];
        $_SESSION['patient_birth']=$row_data['patient_date_of_birth'];
        $_SESSION['patient_maritial']=$row_data['patient_maritial_status'];
        if (password_verify($user_password, $row_data['patient_password'])) {
            // echo "<script>alert('Login successful')</script>";
            if ($number==1) {
                echo "<script>window.open('index.php','_self')</script>";
            }else {
                echo "<script>window.open('index.php','_self')</script>"; 
            }
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}

?>
