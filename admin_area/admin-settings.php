<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
?>


    <!-- Navbar Start Here  -->
    <div class="container-fluid p-0">
        <!-- First Child -->
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 ctitle">Site Settings</div>
                            <div class="col-md-6 text-right">
                                <a href="editsite.php" class="btn btn-secondary btn-sm">Edit</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-stripped">
                            <tbody>
                                <tr>
                                    <th class="text-right" >Admin Name</th>
                                    <td>
                                        <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Email Address</th>
                                    <td>
                                        <?php echo isset($_SESSION['admin_email_address']) ? $_SESSION['admin_email_address'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Password</th>
                                    <td>
                                        <?php echo isset($_SESSION['admin_password']) ? $_SESSION['admin_password'] : ''; ?>
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
        const navLinks = adminument.querySelectorAll('.nav-link');
        for (const navLink of navLinks) {
            navLink.addEventListener('click', function () {
                // Remove the active class from all other navbar links
                navLinks.forEach(link => link.classList.remove('active'));

                // Add the active class to the clicked link
                this.classList.add('active');
            });
        }
    </script>