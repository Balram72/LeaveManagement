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

$sql = "SELECT employee.*, employee_leave_count2.* FROM employee LEFT JOIN employee_leave_count2 ON employee_leave_count2.emp_id = employee.emp_id";
$result = mysqli_query($con, $sql);
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
    $html .= ' 
                                <tr>
                                        <td>' . $row["employee_leave_count2_id"] . '</td>
                                        <td> ' . $row["emp_name"] . '</td>
                                        <td>' . $row["total_casual_leave"] . '</td>
                                        <td>' .  $row["total_sick_leave"] . '</td>
                                        <td>' . $row["total_paid_leave"] . '</td>
                                        <td>' . $row["total_use_casual_leave"] . '</td>
                                        <td>' . $row["total_use_sick_leave"] . '</td>
                                        <td>' .  $row["total_use_paid_leave"] . '</td>
                                        <td>' . $row["left_casual_leave"] . '</td>
                                        <td>' . $row["left_sick_leave"] . '</td>
                                        <td>' .  $row["left_paid_leave"] . '</td>
                                        ';
}
$html .= '</tr> </tbody> </table>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();
