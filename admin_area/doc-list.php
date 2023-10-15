<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
function getSpecialtyName($conn, $specialty_id) {
  $query = "SELECT specialty FROM `medical-specialty` WHERE id = $specialty_id";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  return isset($row['specialty']) ? $row['specialty'] : 'Unknown';
}
if (isset($_POST['insert_doctor'])) {
  $prefix=$_POST['name_pref'];
  $namedoc=$_POST['name_of_doc'];
  $clincaddress=$_POST['address_of_clinic'];
  $contactno=$_POST['contact'];
  $emaildoc=$_POST['email'];
  $mspecialty=$_POST['medical_spec'];
  $password_doc=$_POST['password'];
  if ($_FILES["img"]["error"]===4) {
    echo "<script> alert('Image Does Not Exist)</script>";
  }
  else{
    $fileName = $_FILES["img"]['name'];
    $fileSIze=$_FILES["img"]["size"];
    $tmpName = $_FILES['img']['tmp_name'];

    $validImageExtension = ['jpg','jpeg','png'];
    $ImageExtension = explode('.',$fileName);
    $ImageExtension = strtolower(end($ImageExtension));
    if (!in_array($ImageExtension,$validImageExtension )) {
      echo "<script> alert('Invalid Image Extension)</script>";
    }
    elseif ($fileSIze > 5000000) {
      echo "<script> alert('Image Size Is Too Large)</script>";

    }
    else {
      // Generate a unique file name for the uploaded image
        $newImageName = uniqid() . '.' . $ImageExtension;
        $img_upload_path = '../assets/img/'.$newImageName;
        move_uploaded_file($tmpName,$img_upload_path);
        //Select data from database
        $select_query="Select * from `doctors_list` where doc_email = '$emaildoc'";
        $result=mysqli_query($conn, $select_query);
        $number=mysqli_num_rows($result);
        if ($number > 0) {
          echo "<script> alert('The Email is already taken')</script>";
        } else {
          // Insert data into the doctors_list table
          $sql = "INSERT INTO `doctors_list` (doc_name, doc_email, doc_prefix, doc_password, clinic_address, doc_contact, doc_img, specialty_id) VALUES ('$namedoc', '$emaildoc', '$prefix', '$password_doc', '$clincaddress', '$contactno', '$newImageName', '$mspecialty')";
          if (mysqli_query($conn, $sql)) {
              echo "<script> alert('Successfully Added')</script>";
          } else {
              echo "<script> alert('Error: " . mysqli_error($conn) . "')</script>";
          }
        }
  }
}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-doctor" method="POST" enctype='multipart/form-data'>
				<div class="card">
					<div class="card-header">
						   Doctor's Form
				  	</div>
					<div class="card-body">
                        <div id="msg"></div>
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="" class="control-label">Prefix</label>
                            <input type="text" class="form-control" name="name_pref" placeholder="(M.D.)" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <textarea name="name_of_doc" id="" cols="30" docs="2" class="form-control" required=""></textarea>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label">Clinic Address</label>
                            <textarea name="address_of_clinic" id="" cols="30" docs="2" class="form-control" required=""></textarea>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Medical Specialties</label>
                          <select name="medical_spec" id="" class="form-select">
                            <option value="">Select a Category</option>
                            <?php
                              $select_specialty="select * from `medical-specialty`";
                              $result_specialty = mysqli_query($conn,$select_specialty);
                              while ($row=mysqli_fetch_assoc($result_specialty)) {
                                $specialty_title=$row['specialty'];
                                $specialty_id=$row['id'];
                                echo "<option value='$specialty_id'>$specialty_title</option>";
                              }
                            ?>
                            <!-- <option value="">Category1</option>
                            <option value="">Category2</option>
                            <option value="">Category3</option>
                            <option value="">Category4</option> -->
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Contact</label>
                            <input type="text" name="contact" id=""  class="form-control" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" required="">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Image</label>
                            <input type="file" class="form-control" name="img" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="form-group">
                            <img src="" alt="" id="cimg">
                        </div>		
					</div>
							
					<div class="card-footer">
						<div class="doc">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="insert_doctor"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Image</th>
									<th class="text-center">Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$docs = mysqli_query($conn, "SELECT * FROM `doctors_list` ORDER BY doc_id ASC");
								?>
                <?php foreach($docs as $doc) :?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center img_flex">
                    <img src="../assets/img/<?php echo $doc['doc_img'] ?>" alt="" class="table_img">
									</td>
									<td class="">
										 <p>Name: <b><?php echo "Dr. ".$doc['doc_name'].', '.$doc['doc_prefix'] ?></b></p>
										 <p><small>Email: <b><?php echo $doc['doc_email'] ?></b></small></p>
										 <p><small>Clinic Address: <b><?php echo $doc['clinic_address'] ?></b></small></p>
										 <p><small>Contac #: <b><?php echo $doc['doc_contact'] ?></b></small></p>
                     <p><small>Specialty: <b><?php echo getSpecialtyName($conn, $doc['specialty_id']) ?></b></small></p>
										 <p><small><a href="javascript:void(0)" class="view_schedule" data-id="<?php echo $doc['doc_id'] ?>" data-name="<?php echo "Dr. ".$doc['doc_name'].', '.$doc['doc_prefix'] ?>"><i class='fa fa-calendar'></i> Schedule</a></b></small></p>

									</td>
									<td class="text-center">
                  <button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $doc['doc_id'] ?>" data-name="<?php echo $doc['doc_name'] ?>" data-img_path="<?php echo $doc['doc_img'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_doctor" type="button" data-id="<?php echo $doc['doc_id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>