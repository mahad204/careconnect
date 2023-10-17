<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include 'includes/db_connect.php';
// Check if the user is logged in
if (!isset($_SESSION['patient_email_address'])) {
    header('Location: patient_login.php');
    exit();
}


// Initialize variables with user's existing data
$patient_name = $_SESSION['patient_name'];
$patient_email = $_SESSION['patient_email_address'];
$patient_password = $_SESSION['patient_password'];
$patient_address = $_SESSION['patient_address'];
$patient_contact = $_SESSION['patient_contact'];
$patient_maritial = $_SESSION['patient_maritial'];
$patient_birth = $_SESSION['patient_birth'];

if (isset($_POST['save_changes'])) {
    // Retrieve and validate user's input
    $patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $patient_email = mysqli_real_escape_string($conn, $_POST['patient_email']);
    $patient_password = mysqli_real_escape_string($conn, $_POST['patient_password']);
    $patient_address = mysqli_real_escape_string($conn, $_POST['patient_address']);
    $patient_contact = mysqli_real_escape_string($conn, $_POST['patient_contact']);
    $patient_maritial = mysqli_real_escape_string($conn, $_POST['patient_maritial']);
    $patient_birth = mysqli_real_escape_string($conn, $_POST['patient_birth']);

    // Update user's data in the session
    $_SESSION['patient_name'] = $patient_name;
    $_SESSION['patient_password'] = $patient_password;
    $_SESSION['patient_address'] = $patient_address;
    $_SESSION['patient_email_address'] = $patient_email;
    $_SESSION['patient_contact'] = $patient_contact;
    $_SESSION['patient_maritial'] = $patient_maritial;
    $_SESSION['patient_birth'] = $patient_birth;

    // Update user's data in the database
    $patient_email = $_SESSION['patient_email_address'];

    $updateQuery = "UPDATE patient_list SET 
                    patient_first_name = '$patient_name',
                    patient_password = '$patient_password',
                    patient_address = '$patient_address',
                    patient_email_address='$patient_email',
                    patient_phone_no = '$patient_contact',
                    patient_maritial_status = '$patient_maritial',
                    patient_date_of_birth = '$patient_birth'
                    WHERE patient_email_address = '$patient_email'";

    if (mysqli_query($conn, $updateQuery)) {
        // Data in the database has been updated successfully
        // You can redirect the user to their profile page with a success message
        echo "worked";
        header('Location: profile.php?success=1');
        exit();
    } else {
        // Handle the case where the database update fails
        // You can redirect the user to their profile page with an error message
        echo "error";
        // header('Location: profile.php?error=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <!-- Second Child -->
  <div class="row justify-content-md-center">
        <div class="col col-md-6">
            <br>
            <div class="cardyy">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 ctitle">Edit Profile</div>
                        <div class="col-md-6 text-right">
                            <a href="profile.php" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="edit_account.php">
                        <div class="mb-3">
                            <label for="patient_name" class="form-label">Patient Name</label>
                            <input type="text" class="form-control" name="patient_name" value="<?php echo $_SESSION['patient_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_email" class="form-label">Patient Email</label>
                            <input type="text" class="form-control" name="patient_email" value="<?php echo $_SESSION['patient_email_address']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="patient_password" value="<?php echo $_SESSION['patient_password'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="patient_address" value="<?php echo $_SESSION['patient_address'] ;?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="patient_contact" value="<?php echo $_SESSION ['patient_contact']?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_maritial" class="form-label">Marital Status</label>
                            <input type="text" class="form-control" name="patient_maritial" value="<?php echo $_SESSION['patient_maritial'] ;?>">
                        </div>
                        <div class="mb-3">
                            <label for="patient_birth" class="form-label">Birth</label>
                            <input type="text" class="form-control" name="patient_birth" value="<?php echo $_SESSION['patient_birth'] ;?>">
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-secondary btn-sm" name="save_changes">Save changes</button> <!-- Added submit button -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>