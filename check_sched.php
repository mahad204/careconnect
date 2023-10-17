<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/db_connect.php');

// Check if the doctor_id is specified in the URL
if (isset($_GET['doctor_id'])) {
    $selectedDoctorId = $_GET['doctor_id'];

    // Your SQL query should retrieve schedules for the selected doctor
    $scheds = mysqli_query($conn, "SELECT * FROM `doctor_schedule_table` WHERE doctor_id = $selectedDoctorId ORDER BY doctor_schedule_id ASC");

    if (mysqli_num_rows($scheds) > 0) {
        // Doctor has schedules, display the table
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Doctor Schedule</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="..styles5.css">
        </head>
        <body>
            <div class="container d-flex align-items-center min-vh-100">
                <div class="card shadow mb-4 w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                            Schedule Date
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                            Start Time
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                            End Time
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                            Consulting Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>';
        foreach ($scheds as $sched) {
            echo '<tr role="row" class="odd">;
                    <td class="text-center">' . $sched['doctor_schedule_date'] . '</td>;
                    <td class="text-center">' . $sched['doctor_schedule_start_time'] . '</td>;
                    <td class="text-center">' . $sched['doctor_schedule_end_time'] . '</td>;
                    <td class="text-center">' . $sched['average_consulting_time'] . '</td>;
             </tr>';
        }
        echo '</tbody>
                </table>
            </div>
            <a class="text-center" href="javascript:history.back();">Back</a>
        </div>
    </div>
</div>
</body>
</html>';
    } else {
        // Doctor has no schedules, display the message
        echo "<h2 class='text-center justify-content-center'><b>Doctor is currently unavailable</b></h2>";
    }
} else {
    // Handle the case when the doctor ID is not provided in the URL
    echo "Doctor ID not specified.";
    // You can also include a back link to the list of doctors
}
?>