<?php
require '../vendor/autoload.php';
include('../comman/config.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();

// Enable DOMPDF debugging output
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('debugKeepTemp', true);
$options->set('isHtml5ParserEnabled', true);
$dompdf->setOptions($options);

$id = $_SESSION['manage_id'];
$sqli = "SELECT ea.emp_id, e.emp_name 
            FROM employeeadd ea
            JOIN employee e ON ea.emp_id = e.emp_id
            WHERE ea.manage_id = $id";
$result = mysqli_query($con, $sqli);

$html =
    '
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .text-center {
        text-align: center;
    }

    .blue-text {
        color: blue;
    }

    .green-text {
        color: green;
    }

    .red-text {
        color: red;
    }
</style>
        <table>
                          <thead>
                              <tr>
                              <th>SNo</th>
                              <th>Employee Name</th>
                              <th>Total Casual Leave</th>
                              <th>Total Paid Leave</th>
                              <th>Total Sick Leave</th>
                              <th>Use Casual Leave </th>   
                              <th>Use Sick Leave </th>
                              <th>Use Paid Leave </th>  
                              <th>Left Casual Leave </th> 
                              <th>Left Sick Leave </th>   
                              <th>Left Paid Leave </th>
                              </tr>
                          </thead>
                          <tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    $emp1_id = $row['emp_id'];
    $sql = "SELECT * FROM employee_leave_count where emp_id = $emp1_id";
    $result2 = mysqli_query($con, $sql);

    while ($row1 = mysqli_fetch_assoc($result2)) {
        $html .= ' 
            <tr>
                <td>' . $row1["employee_leave_count_id"] . '</td>
                <td> ' . $row["emp_name"] . '</td>
                <td>' . $row1["total_casual_leave"] . '</td>
                <td>' .  $row1["total_sick_leave"] . '</td>
                <td>' . $row1["total_paid_leave"] . '</td>
                <td>' . $row1["total_use_casual_leave"] . '</td>
                <td>' . $row1["total_use_sick_leave"] . '</td>
                <td>' .  $row1["total_use_paid_leave"] . '</td>
                <td>' . $row1["left_casual_leave"] . '</td>
                <td>' . $row1["left_sick_leave"] . '</td>
                <td>' .  $row1["left_paid_leave"] . '</td>
            </tr>';
    }
}

$html .= '</tbody></table>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();
