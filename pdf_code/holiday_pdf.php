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

$sql = "SELECT * FROM holidays";
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
                              <th>Holiday Name</th>
                              <th>Holiday Date</th>
                              </tr>
                          </thead>
                          <tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    $html .= ' 
                                <tr>
                                        <td>' . $row["holidays_id"] . '</td>
                                        <td> ' . $row["holidays_name"] . '</td>
                                        <td>' . $row["holidays_date"] . '</td>
                                        ';
}
$html .= '</tr> </tbody> </table>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();
