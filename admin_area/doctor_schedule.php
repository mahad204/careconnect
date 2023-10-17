<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
function getSpecialtyName($conn, $select_doc) {
    $query = "SELECT doc_name FROM `doctors_list` WHERE doc_id = $select_doc";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return isset($row['doc_name']) ? $row['doc_name'] : 'Unknown';
  }
if (isset($_POST['make_sched'])) {
    $select_doc=$_POST['doctorn'];
    $sched_date=$_POST['schedule'];
    $sched_start_time=$_POST['start_time'];
    $sched_end_time=$_POST['end_time'];
    $averageTime=$_POST['avgTime'];

    $select_query = "SELECT * FROM `doctor_schedule_table` WHERE doctor_id = '$select_doc' AND doctor_schedule_date = '$sched_date'";   
    $result=mysqli_query($conn, $select_query);
    $number=mysqli_num_rows($result);
    if ($number > 0) {
      echo "<script> alert('Day has already been scheduled')</script>";
    } else {
      // Insert data into the doctors_list table
      $sql = "INSERT INTO `doctor_schedule_table` (doctor_id, doctor_schedule_date, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time) VALUES ('$select_doc', '$sched_date', '$sched_start_time', '$sched_end_time', '$averageTime')";
      if (mysqli_query($conn, $sql)) {
          echo "<script> alert('Successfully Added')</script>";
      } else {
          echo "<script> alert('Error: " . mysqli_error($conn) . "')</script>";
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
                        <div class="form-group">
                          <label class="control-label">Doctor</label>
                          <select name="doctorn" id="" class="form-select">
                          <option value="">Select Doctor</option>
                            <?php
                              $select_doctor="select * from `doctors_list`";
                              $result_doctor = mysqli_query($conn,$select_doctor);
                              while ($row=mysqli_fetch_assoc($result_doctor)) {
                                $docName=$row['doc_name'];
                                $docId=$row['doc_id'];
                                echo "<option value='$docId'>$docName</option>";
                              }
                            ?>
                            <!-- <option value="">Select Doctor</option>
                            <option value="">Category1</option>
                            <option value="">Category2</option>
                            <option value="">Category3</option>
                            <option value="">Category4</option> -->
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Schedule Date</label>
                            <input type="date" name="schedule" id=""  class="form-control" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Start Time</label>
                            <input type="time" class="form-control" name="start_time" required="">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">End Time</label>
                            <input type="time" class="form-control" name="end_time" >
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Average consulting time</label>
                            <select name="avgTime" id="" class="form-select">
                            <option value="">Select Consulting Duration</option>
                            
                            <option value="5">5min</option>
                            <option value="10">10min</option>
                            <option value="15">15min</option>
                            <option value="20">20min</option>
                            <option value="25">25min</option>
                            <option value="30">30min</option>
                            <option value="35">35min</option>
                            <option value="40">40min</option>
                            <option value="45">45min</option>
                            <option value="50">50min</option>
                            <option value="55">55min</option>
                            <option value="60">60min</option>
                          </select>
                        </div>
					</div>
							
					<div class="card-footer">
						<div class="doc">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="make_sched"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>

			<!-- Table Panel -->
			<div class="col-md-8">
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="m-0 font-weight-bold text-danger">Doctor Schedule List</h6>
                                </div>
                                <div class="col d-flex justify-content-end" >
                                    <button class="btn btn-success btn-circle btn-sm" type="button" name="add_sched">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_filter float-end">
                                                <label for="">
                                                    Search
                                                    <input type="search" class="form-control form-control-sm" placeholder aria-control="doctor_schedule_table">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        #
                                                        </th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        Doctor Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        Schedule Date
                                                        </th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        Start Time
                                                        </th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        End Time
                                                        </th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >
                                                        Consulting Time
                                                        </th>
                                                        <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1">
                                                        Status
                                                        </th>
                                                        <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1" >
                                                        Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $i = 1;
                                                        $scheds = mysqli_query($conn, "SELECT * FROM `doctor_schedule_table` ORDER BY doctor_schedule_id ASC");
                                                        ?>
                                                    <?php foreach($scheds as $sched) :?>
                                                    <tr role="row" class="odd">
                                                        <td class="text-center"><?php echo $i++ ?></td>
                                                        <td class="text-center"><b><?php echo getSpecialtyName($conn, $sched['doctor_id']) ?></b></td>
                                                        <td class="text-center"><?php echo $sched['doctor_schedule_date'] ?></td>
                                                        <td class="text-center"><?php echo $sched['doctor_schedule_start_time'] ?></td>
                                                        <td class="text-center"><?php echo $sched['doctor_schedule_end_time'] ?></td>
                                                        <td class="text-center"><?php echo $sched['average_consulting_time'] ?></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm status_button">
                                                                Active
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div align="center">
                                                                <button class="btn btn-warning btn-circle btn-sm edit_button" name="edit_button_sched">
                                                                    <i class="fas fa-edit">
                                                                    </i>
                                                                </button>
                                                                <button class="btn btn-warning btn-circle btn-sm edit_button" name="delete_btn">
                                                                    <i class="fas fa-times">
                                                                    </i>
                                                                </button>
                                                            </div>
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
                </div>
		    </div>
	    </div>	
    </div>
</div>
