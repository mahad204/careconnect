<?php
session_start();
include('../includes/db_connect.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../loginstyle2.css">
</head>

<body>
    <div class="login-container" style="width:450px;">
        <form action="doctor_login.php" method="POST">
            <h3>doctor</h3>
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="doc_email" id="doc_email" class="form-control" required autofocus
                    data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Email Address" />
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="doctor_password" placeholder="Password" class="form-control"
                    required>
            </div>
            <button type="submit" name="doctor_login">Login</button>
        </form>
    </div>
    <!-- Bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['doctor_login'])) {
    $doctor_email = $_POST["doc_email"];
    $doctor_password = $_POST["doctor_password"];

    $select_query = "SELECT * FROM `doctors_list` WHERE doc_email= '$doctor_email'";
    $result = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($number > 0) {
        $_SESSION['doc_email'] = $doctor_email;
        $_SESSION['doc_id'] = $row_data['doc_id'];
        $_SESSION['doc_name'] = $row_data['doc_name'];
        $_SESSION['doc_email'] = $doctor_email;
        $_SESSION['doc_password'] = $row_data['doc_password'];
        $_SESSION['clinic_address'] = $row_data['clinic_address'];
        $_SESSION['doc_contact'] = $row_data['doc_contact'];
        $_SESSION['specialty_name'] = $row_data['specialty_name'];
        $stored_password = $row_data['doc_password'];
        if ($doctor_password == $stored_password) {
            // echo "<script>alert('Login successful')</script>";
            if ($number == 1) {
                // echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
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