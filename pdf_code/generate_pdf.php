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
$id = isset($_GET['empid']) ? $_GET['empid'] : ($_SESSION['empid'] ?? null);
$sql = "SELECT 
        employee_leave_request_table.*, 
        employeeadd.*, 
        manager.*, 
        employee.*, 
        leave_table.* 
    FROM 
        employeeadd 
    INNER JOIN 
        manager ON employeeadd.manage_id = manager.manage_id 
    INNER JOIN 
        employee ON employeeadd.emp_id = employee.emp_id 
    LEFT JOIN 
        employee_leave_request_table ON employeeadd.emp_id = employee_leave_request_table.emp_id 
    LEFT JOIN 
        leave_table ON employee_leave_request_table.leave_id = leave_table.leave_id 
    WHERE 
        employeeadd.emp_id = $id";

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
                                  <th">NO</th>
                                  <th">Manage Name</th>
                                  <th>Manager Email</th>
                                  <th>Manager Mobile Number</th>
                                  <th>Leave Type</th>
                                  <th>Leave Duration</th>
                                  <th>Date Of Apply</th>
                                  <th>Form Date</th>
                                  <th>To Date</th>
                                  <th>Total Day</th>
                                  <th>Statue</th>
                              </tr>
                          </thead>
                          <tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    $html .= ' 
                                <tr>
                                        <td>' . $row["emp_le_re_id"] . '</td>
                                        <td> ' . $row["manage_name"] . '</td>
                                        <td>' . $row["manage_email"] . '</td>
                                        <td>' .  $row["manage_mob"] . '</td>
                                        <td>' . $row["leave_type"] . '</td>
                                        <td>' . $row["duration"] . '</td>
                                        <td>' . date("Y-m-d", strtotime($row["created_time"])) . '</td>
                                        <td>' . $row["from_date"] . '</td>
                                        <td>' .  $row["to_date"] . '</td>
                                        <td>' . $row["total_day"] . '</td>';

    if ($row["statue"] == "1") {
        $view = "Padding";
        $textColor = "color: blue;";
    }
    if ($row["statue"] == "2") {
        $view = "Accept";
        $textColor = "color: green;";
    }
    if ($row["statue"] == "3") {
        $view = "RejectT";
        $textColor = "color: red;";
    }
    $html .= ' <td style="color: ' . $textColor . ';">' . $view . '</td>
             </tr>';
}
$html .= '</tbody> </table>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();
