<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <!-- Bootstrap LInk -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="dstyle.css">
</head>

<body style="
overflow-x:hidden;
background: #f3f5f9;">
    <!-- Navbar Start Here  -->
    <div class="container-fluid p-0">
        <!-- First Child -->
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 ctitle">Profile Details</div>
                            <div class="col-md-6 text-right">
                                <a href="editdoc_acc.php" class="btn btn-secondary btn-sm">Edit</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-stripped">
                            <tbody>
                                <tr>
                                    <th class="text-right" width="40%">Doctor Name</th>
                                    <td>
                                        <?php echo isset($_SESSION['doc_name']) ? $_SESSION['doc_name'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Email Address</th>
                                    <td>
                                        <?php echo isset($_SESSION['doc_email']) ? $_SESSION['doc_email'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Password</th>
                                    <td>
                                        <?php echo isset($_SESSION['doc_password']) ? $_SESSION['doc_password'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Clinic Address</th>
                                    <td>
                                        <?php echo isset($_SESSION['clinic_address']) ? $_SESSION['clinic_address'] : 'N/A'; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-right">Contactno</th>
                                    <td>
                                        <?php echo isset($_SESSION['doc_contact']) ? $_SESSION['doc_contact'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Specialty</th>
                                    <td>
                                        <?php echo isset($_SESSION['specialty_name']) ? $_SESSION['specialty_name'] : ''; ?>
                                    </td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        for (const navLink of navLinks) {
            navLink.addEventListener('click', function () {
                // Remove the active class from all other navbar links
                navLinks.forEach(link => link.classList.remove('active'));

                // Add the active class to the clicked link
                this.classList.add('active');
            });
        }
    </script>