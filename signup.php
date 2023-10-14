<?php
include('./includes/db_connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <!-- <link rel="stylesheet" href="loginstyle.css"> -->
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Patient Registration</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="patient_register_form" data-parsley-validate>
                        <div class="mb-3">
                            <label for="patient_email_address" class="form-label">Patient Email Address<span class="text-danger">*</span></label>
                            <input type="email" name="patient_email_address" id="patient_email_address" class="form-control" required data-parsley-trigger="keyup" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="patient_password" class="form-label">Patient Password<span class="text-danger">*</span></label>
                            <input type="password" name="patient_password" id="patient_password" class="form-control" required data-parsley-trigger="keyup">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="patient_first_name" class="form-label">Patient First Name<span class="text-danger">*</span></label>
                                <input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required data-parsley-trigger="keyup">
                            </div>
                            <div class="col-md-6">
                                <label for="patient_last_name" class="form-label">Patient Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="patient_last_name" id="patient_last_name" class="form-control" required data-parsley-trigger="keyup">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="patient_date_of_birth" class="form-label">Patient Date of Birth<span class="text-danger">*</span></label>
                                <input type="date" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="patient_gender" class="form-label">Patient Gender<span class="text-danger">*</span></label>
                                <select name="patient_gender" id="patient_gender" class="form-select">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="patient_phone_no" class="form-label">Patient Contact No.<span class="text-danger">*</span></label>
                                <input type="text" name="patient_phone_no" id="patient_phone_no" class="form-control" required data-parsley-trigger="keyup">
                            </div>
                            <div class="col-md-6">
                                <label for="patient_maritial_status" class="form-label">Patient Marital Status<span class="text-danger">*</span></label>
                                <select name="patient_maritial_status" id="patient_maritial_status" class="form-select">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="patient_address" class="form-label">Patient Complete Address<span class="text-danger">*</span></label>
                            <textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="hidden" name="action" value="patient_register" />
                            <button type="submit" name="patient_register_button" id="patient_register_button" class="btn btn-primary">Register</button>
                        </div>
                        <div class="form-group text-center">
                            <p>Already have an account? <a href="patient_login.php">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
	if (isset($_POST['action'])) {
		$user_fname=$_POST['patient_first_name'];
		$user_lname=$_POST['patient_last_name'];
		$user_email=$_POST['patient_email_address'];
		$user_gender=$_POST['patient_gender'];
		$user_no=$_POST['patient_phone_no'];
		$user_maritial=$_POST['patient_maritial_status'];
		$user_address=$_POST['patient_address'];
		$user_password=$_POST['patient_password'];
		$hash_password=password_hash($user_password,PASSWORD_DEFAULT);
		$user_dob=$_POST['patient_date_of_birth'];

		$select_query="Select * from `patient_list` where patient_email_address = '$user_email'";
        $result=mysqli_query($conn, $select_query);
        $number=mysqli_num_rows($result);
        if ($number > 0) {
          echo "<script> alert('The Email is already taken')</script>";
        } else {
			//insert query
            $_SESSION['patient_email_address']=$user_email;
            $_SESSION['patient_name']=$row_data['patient_first_name'];
            $_SESSION['patient_contact']=$row_data['patient_phone_no'];
            $_SESSION['patient_address']=$row_data['patient_address'];
			$insert_query = "INSERT INTO `patient_list` (patient_first_name, patient_last_name, patient_email_address, patient_gender, patient_address, patient_phone_no, patient_maritial_status, patient_password,patient_date_of_birth) VALUES ('$user_fname', '$user_lname', '$user_email', '$user_gender', '$user_address', '$user_no', '$user_maritial', '$hash_password','$user_dob')";
			$sql_execute=mysqli_query($conn,$insert_query);
			if ($sql_execute) {
				echo "<script>alert('Data insterted successfully)</script>";
                echo "<script>window.open('patient_login.php','_self')</script>";
			}else {
				die("Could not connect to mysql".mysqli_error($conn));
			}
		}

	}
?>