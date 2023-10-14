<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Appointment Information</h2>
    <table>
        <thead>
            <tr>
                <th>Appointment No.</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Sam</td>
                <td>Dr. la</td>
                <td>2023-10-15</td>
                <td>Confirmed</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jon</td>
                <td>Dr. sam</td>
                <td>2023-10-16</td>
                <td>Pending</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>