<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
if (isset($_POST['insert_specialty'])) {
  $specialty_categ=$_POST['specialty'];
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
    elseif ($fileSIze > 1000000) {
      echo "<script> alert('Image Size Is Too Large)</script>";

    }
    else {
      // Generate a unique file name for the uploaded image
      $newImageName = uniqid() . '.' . $ImageExtension;
      $img_upload_path = '../assets/img/'.$newImageName;
      move_uploaded_file($tmpName,$img_upload_path);
        //Select data from database
        $select_query="Select * from `medical-specialty` where specialty = '$specialty_categ'";
        $result=mysqli_query($conn, $select_query);
        $number=mysqli_num_rows($result);
        if ($number>0) {
            echo "<script>
            alert('This specialty is already present')
        </script>";
        }else{
        $sql="INSERT INTO `medical-specialty` (specialty, img_path) VALUES ('$specialty_categ', '$newImageName')";
        mysqli_query($conn, $sql);
        echo "<script>
        alert('Successfully Added')
        </script>";
        }
    }
  }
}
?>

    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-category" method="POST" enctype='multipart/form-data'>
                    <div class="card">
                        <div class="card-header">
                            Medical Specialties Form
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Specialty</label>
                                <textarea name="specialty" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="control-label">Image</label>
                                <input type="file" class="form-control" name="img" accept=".jpg, .jpeg, .png" value="">
                            </div>
                            <div class="form-group">
                                <img src="" alt="" id="cimg">
                            </div>	     
                        </div>
                                
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" type='submit' name='insert_specialty'>Submit</button>
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
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
                                $categs = mysqli_query($conn, "SELECT * FROM `medical-specialty` ORDER BY id ASC");
								?>
                                <?php foreach($categs as $categ) :?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center img_flex">
                                    <img src="../assets/img/<?php echo $categ['img_path'] ?>" alt="" class="table_img">
									</td>
									<td class="">
										 <b><?php echo $categ['specialty'] ?></b>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $categ['id'] ?>" data-name="<?php echo $categ['specialty'] ?>" data-img_path="<?php echo $categ['img_path'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $categ['id'] ?>">Delete</button>
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