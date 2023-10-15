<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/db_connect.php');
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

    $select_query="Select * from `doctor_schedule_table` where doctor_schedule_start_time = '$sched_start_time'";
    $result=mysqli_query($conn, $select_query);
    $number=mysqli_num_rows($result);
    if ($number > 0) {
      echo "<script> alert('Time is booked')</script>";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- Bootstrap LInk -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="..styles5.css">
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" role="grid">
                <thead>
                    <tr role="row">
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
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $scheds = mysqli_query($conn, "SELECT * FROM `doctor_schedule_table` ORDER BY doctor_schedule_id ASC");
                        ?>
                    <?php foreach($scheds as $sched) :?>
                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $sched['doctor_schedule_date'] ?></td>
                        <td class="text-center"><?php echo $sched['doctor_schedule_start_time'] ?></td>
                        <td class="text-center"><?php echo $sched['doctor_schedule_end_time'] ?></td>
                        <td class="text-center"><?php echo $sched['average_consulting_time'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                        </table>
        </div>
    </div>
</body>
</html>