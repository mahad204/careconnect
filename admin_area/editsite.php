<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
// Check if the user is logged in
if (!isset($_SESSION['admin_email_address'])) {
    header('Location: admin_login.php');
    exit();
}

// Initialize variables with user's existing data
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : '';
$admin_email_address = isset($_SESSION['admin_email_address']) ? $_SESSION['admin_email_address'] : '';
$admin_password = isset($_SESSION['admin_password']) ? $_SESSION['admin_password'] : '';

if (isset($_POST['save_changes'])) {
    // Retrieve and validate user's input
    $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $admin_email_address = mysqli_real_escape_string($conn, $_POST['admin_email_address']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Update user's data in the session
    $_SESSION['admin_name'] = $admin_name;
    $_SESSION['admin_password'] = $admin_password;
    $_SESSION['admin_email_address'] = $admin_email_address;

    // Update user's data in the database
    $admin_email_address = $_SESSION['admin_email_address'];

    $updateQuery = "UPDATE admin_table SET 
                admin_name = '$admin_name',
                admin_password = '$admin_password'
                WHERE admin_email_address = '$admin_email_address'";


    if (mysqli_query($conn, $updateQuery)) {
        // Data in the database has been updated successfully
        // You can redirect the user to their admin_profile page with a success message
        header('Location: index.php?page=admin_settings');
        exit();
    } else {
        // Handle the case where the database update fails
        // You can redirect the user to their admin_profile page with an error message
        header('Location: index.php');
        exit();
    }
}
?>

<!adminTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style7.css">
    
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
                        <div class="col-md-6 ctitle">Edit Admin</div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?page=admin_settings" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="editsite.php">
                        <div class="mb-3">
                            <label for="admin_name" class="form-label">Admin Name</label>
                            <input type="text" class="form-control" name="admin_name" value="<?php echo $admin_name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="admin_email_address" class="form-label">Email</label>
                            <input type="email" class="form-control" name="admin_email_address" value="<?php echo $admin_email_address; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="admin_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="admin_password" value="<?php echo $admin_password; ?>">
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