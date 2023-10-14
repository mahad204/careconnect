<?php
include('includes/db_connect.php');
session_start();

//getting all doctors
function getSpecialtyName($conn, $specialty_id) {
    $query = "SELECT specialty FROM `medical-specialty` WHERE id = $specialty_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return isset($row['specialty']) ? $row['specialty'] : 'Unknown';
}
function getdoctors(){
    global $conn;
    if (!isset($_GET['sid'])) {
        
    $doctorsQuery = "SELECT * FROM `doctors_list`";
    $queryResult = mysqli_query($conn, $doctorsQuery);
    $num_of_rows=mysqli_num_rows($queryResult);
    if ($num_of_rows==0) {
        echo "<h2 class='text-center'><b>No Doctors for this specialty</b></h2>";
     }else {
         echo "<h1 class='text-center'>Doctors with Titles</h1>
         <form class='d-flex' role='search' action='index.php?page=doctorsHome' method='GET'>
             <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' name='search_data'>
             <input type='submit' value='search' class='btn btn-outline-success' name='search_doc'>
       </form>
       <br>";
     }

    while ($row = mysqli_fetch_assoc($queryResult)) {
        $doctorName = $row['doc_name'];
        $doctorPrefix = $row['doc_prefix'];
        $doctorEmail = $row['doc_email'];
        $clinicAddress = $row['clinic_address'];
        $contactNumber = $row['doc_contact'];
        $doctorImage = $row['doc_img'];
        $specialty_id=$row['specialty_id'];
        $specialty_name = getSpecialtyName($conn, $specialty_id);
        

        echo '<div class="cardy mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 image">
                                <img src="./assets/img/' . $doctorImage . '" alt="' . $doctorName . '" class="table_img">
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Dr. ' . $doctorName . ', ' . $doctorPrefix . '</h5>
                                <p class="card-text">Email: ' . $doctorEmail . '</p>
                                <p class="card-text">Clinic Address: ' . $clinicAddress . '</p>
                                <p class="card-text">Contact #: ' . $contactNumber . '</p>
                                <p class="card-text">Specialty: ' . $specialty_name . '</p>
                                <p class="card-text"><a href="javascript:void(0)" class="view_schedule" data-id="' . $row['doc_id'] . '" data-name="Dr. ' . $doctorName . ', ' . $doctorPrefix . '"><i class="fa fa-calendar"></i> Schedule</a></p>
                            </div>
                            <div class="col-md-3 text-center align-self-end-sm">
                                <button class="btn-outline-primary btn mb-4 set_appointment" type="button" data-id="' . $row['doc_id'] . '" data-name="' . $doctorName . '" data-contact="' . $contactNumber . '" data-address="' . $clinicAddress . '">Set appointment</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
}

//getting unique doctors
function get_unique_doctors(){
    global $conn;
    if (isset($_GET['sid'])) {
        $spid=$_GET['sid'];
        
    $doctorsQuery = "SELECT * FROM `doctors_list` where specialty_id=$spid";
    $queryResult = mysqli_query($conn, $doctorsQuery);
    $num_of_rows=mysqli_num_rows($queryResult);
    if ($num_of_rows==0) {
       echo "<h2 class='text-center'><b>No Doctor's for this specialty</b></h2>";
    }else {
        echo "<h2 class='text-center'><b>Doctor's who are in titled as <?php echo $s ?></b></h2>
        <form class='d-flex' role='search' action='' method='GET'>
            <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search'>
            <input type='submit' value='search' class='btn btn-outline-success'>
      </form>
      <br>";
    }

    while ($row = mysqli_fetch_assoc($queryResult)) {
        $doctorName = $row['doc_name'];
        $doctorPrefix = $row['doc_prefix'];
        $doctorEmail = $row['doc_email'];
        $clinicAddress = $row['clinic_address'];
        $contactNumber = $row['doc_contact'];
        $doctorImage = $row['doc_img'];
        $specialty_id=$row['specialty_id'];
        $specialty_name = getSpecialtyName($conn, $specialty_id);

        echo '<div class="cardy mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 image">
                                <img src="./assets/img/' . $doctorImage . '" alt="' . $doctorName . '" class="table_img">
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Dr. ' . $doctorName . ', ' . $doctorPrefix . '</h5>
                                <p class="card-text">Email: ' . $doctorEmail . '</p>
                                <p class="card-text">Clinic Address: ' . $clinicAddress . '</p>
                                <p class="card-text">Contact #: ' . $contactNumber . '</p>
                                <p class="card-text">Specialty: ' . $specialty_name . '</p>
                                <p class="card-text"><a href="javascript:void(0)" class="view_schedule" data-id="' . $row['doc_id'] . '" data-name="Dr. ' . $doctorName . ', ' . $doctorPrefix . '"><i class="fa fa-calendar"></i> Schedule</a></p>
                            </div>
                            <div class="col-md-3 text-center align-self-end-sm">
                                <input type="hidden" name="doctor_id" id="doctor_id">
                                <button class="btn-outline-primary btn mb-4 set_appointment" type="button" data-id="' . $row['doc_id'] . '" data-name="' . $doctorName . '" data-contact="' . $contactNumber . '" data-address="' . $clinicAddress . '">Set appointment</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
}

function search_doctor(){
    if (isset($_GET['search_doc'])) {
        $search_data_value=$_GET['search_data'];
    $searchQuery = "SELECT * FROM `doctors_list` WHERE doc_name like '%$search_data_value%'";
    $queryResult = mysqli_query($conn,  $searchQuery);

    while ($row = mysqli_fetch_assoc($queryResult)) {
        $doctorName = $row['doc_name'];
        $doctorPrefix = $row['doc_prefix'];
        $doctorEmail = $row['doc_email'];
        $clinicAddress = $row['clinic_address'];
        $contactNumber = $row['doc_contact'];
        $doctorImage = $row['doc_img'];
        $specialty_id=$row['specialty_id'];
        $specialty_name = getSpecialtyName($conn, $specialty_id);
        

        echo '<div class="cardy mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 image">
                                <img src="./assets/img/' . $doctorImage . '" alt="' . $doctorName . '" class="table_img">
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Dr. ' . $doctorName . ', ' . $doctorPrefix . '</h5>
                                <p class="card-text">Email: ' . $doctorEmail . '</p>
                                <p class="card-text">Clinic Address: ' . $clinicAddress . '</p>
                                <p class="card-text">Contact #: ' . $contactNumber . '</p>
                                <p class="card-text">Specialty: ' . $specialty_name . '</p>
                                <p class="card-text"><a href="javascript:void(0)" class="view_schedule" data-id="' . $row['doc_id'] . '" data-name="Dr. ' . $doctorName . ', ' . $doctorPrefix . '"><i class="fa fa-calendar"></i> Schedule</a></p>
                            </div>
                            <div class="col-md-3 text-center align-self-end-sm">
                                <button class="btn-outline-primary btn mb-4 set_appointment" type="button" data-id="' . $row['doc_id'] . '" data-name="' . $doctorName . '" data-contact="' . $contactNumber . '" data-address="' . $clinicAddress . '">Set appointment</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
}
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const appointmentButtons = document.querySelectorAll(".set_appointment");

    appointmentButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            window.location.href = button.getAttribute("data-id") !== null && !<?php echo isset($_SESSION['patient_email_address']) ? 'true' : 'false'; ?>
                ? 'patient_login.php'
                : 'set_appointment.php?doc_id=' + button.getAttribute("data-id");
        });
    });
});
</script>
