<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db_connect.php');
function getSpecialtyName($conn, $select_doc)
{
    $query = "SELECT doc_name FROM `doctors_list` WHERE doc_id = $select_doc";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return isset($row['doc_name']) ? $row['doc_name'] : 'Unknown';
}
function getPatientSpecialtyName($conn, $select_patient)
{
    $query = "SELECT patient_first_name FROM `patient_list` WHERE patient_id = $select_patient";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return isset($row['patient_first_name']) ? $row['patient_first_name'] : 'Unknown';
}

?>


<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Appointment List</h1>
    <div class="col-lg-12">
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-danger">Doctor Schedule List</h6>
                            </div>
                            <div class="col d-flex justify-content-end">
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
                                    <div class="col-sm-12 col-md-12">
                                        <div class="dataTables_filter float-end">
                                            <label for="">
                                                Search
                                                <input type="search" class="form-control form-control-sm" placeholder
                                                    aria-control="doctor_schedule_table">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable no-footer" width="100%"
                                            cellspacing="0" role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Appointment No.
                                                    </th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Patient Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Doctor Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Appointment Date
                                                    </th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Appointment Time
                                                    </th>
                                                    <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1">
                                                        Appointment Status
                                                    </th>
                                                    <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1">
                                                        View
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $appointments = mysqli_query($conn, "SELECT * FROM `appointment_list` ORDER BY appointment_id ASC");
                                                ?>
                                                <?php foreach ($appointments as $appointment): ?>
                                                    <tr role="row" class="odd">
                                                        <td class="text-center">
                                                            <?php echo $i++ ?>
                                                        </td>
                                                        <td class="text-center"><b>
                                                                <?php echo getPatientSpecialtyName($conn, $appointment['patient_id']) ?>
                                                            </b></td>
                                                        <td class="text-center"><b>
                                                                <?php echo getSpecialtyName($conn, $appointment['doctor_id']) ?>
                                                            </b></td>
                                                        <td class="text-center">
                                                            <?php echo $appointment['appointment_date'] ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $appointment['appointment_time'] ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-primary btn-sm status_button">
                                                                <?php echo $appointment['status'] ?>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div align="center">
                                                                <button
                                                                    class="btn btn-info btn-circle btn-sm view_button"
                                                                    name="view_btn">
                                                                    <i class="fas fa-eye">
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