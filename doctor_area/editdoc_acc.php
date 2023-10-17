<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
// Check if the user is logged in
if (!isset($_SESSION['doc_email'])) {
    header('Location: doctor_login.php');
    exit();
}

// Initialize variables with user's existing data
$doc_name = isset($_SESSION['doc_name']) ? $_SESSION['doc_name'] : '';
$doc_email = isset($_SESSION['doc_email']) ? $_SESSION['doc_email'] : '';
$doc_password = isset($_SESSION['doc_password']) ? $_SESSION['doc_password'] : '';
$clinic_address = isset($_SESSION['clinic_address']) ? $_SESSION['clinic_address'] : '';
$doc_contact = isset($_SESSION['doc_contact']) ? $_SESSION['doc_contact'] : '';

if (isset($_POST['save_changes'])) {
    // Retrieve and validate user's input
    $doc_name = mysqli_real_escape_string($conn, $_POST['doc_name']);
    $doc_email = mysqli_real_escape_string($conn, $_POST['doc_email']);
    $doc_password = mysqli_real_escape_string($conn, $_POST['doc_password']);
    $clinic_address = mysqli_real_escape_string($conn, $_POST['clinic_address']);
    $doc_contact = mysqli_real_escape_string($conn, $_POST['doc_contact']);

    // Update user's data in the session
    $_SESSION['doc_name'] = $doc_name;
    $_SESSION['doc_password'] = $doc_password;
    $_SESSION['clinic_address'] = $clinic_address;
    $_SESSION['doc_email'] = $doc_email;
    $_SESSION['doc_contact'] = $doc_contact;

    // Update user's data in the database
    $doc_email = $_SESSION['doc_email'];

    $updateQuery = "UPDATE doctors_list SET 
                    doc_name = '$doc_name',
                    doc_password = '$doc_password',
                    clinic_address = '$clinic_address',
                    doc_contact = '$doc_contact'
                    WHERE doc_email = '$doc_email'";

    if (mysqli_query($conn, $updateQuery)) {
        // Data in the database has been updated successfully
        // You can redirect the user to their doc_profile page with a success message
        header('Location: index.php?page=profile');
        exit();
    } else {
        // Handle the case where the database update fails
        // You can redirect the user to their doc_profile page with an error message
        header('Location: index.php?page=profile');
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
    <link rel="stylesheet" href="dstyle.css">
    
</head>
<body 
style="padding-top: 70px; 
overflow-x:hidden;
background: #f3f5f9;">
<!-- Navbar Start Here  -->
<div class="container-fluid p-0">
  <div class="row justify-content-md-center">
        <div class="col col-md-6">
            <br>
            <div class="cardyy">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 ctitle">Edit Doctor</div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?page=profile" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="editdoc_acc.php">
                        <div class="mb-3">
                            <label for="doc_name" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" name="doc_name" value="<?php echo $doc_name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="doc_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="doc_email" value="<?php echo $doc_email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="doc_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="doc_password" value="<?php echo $doc_password; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="clinic_address" class="form-label">Clinic Address</label>
                            <input type="text" class="form-control" name="clinic_address" value="<?php echo $clinic_address; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="doc_contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="doc_contact" value="<?php echo $doc_contact; ?>">
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-secondary btn-sm" name="save_changes">Save changes</button>
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