<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Patient Management</h1>

<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-danger">Patient List</h6>
            </div>
            <div class="col" align="right">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="patient_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Contact No.</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$i = 1;
				$patients = mysqli_query($conn, "SELECT * FROM `patient_list` ORDER BY patient_id ASC");
				?>
                <?php foreach($patients as $patient) :?>
                    <tr>
                        <td><?php echo $patient['patient_first_name'] ?></td>
                        <td><?php echo $patient['patient_last_name'] ?></td>
                        <td><?php echo $patient['patient_email_address'] ?></td>
                        <td><?php echo $patient['patient_phone_no'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
