<?php
include('../comman/config.php');
error_reporting(0);
?>
<?php
    if (isset($_POST["submit"])) {
        
        $id = $_SESSION['manage_id'];
        $sqli = "SELECT emp_id FROM employeeadd WHERE manage_id = $id";
        $result = mysqli_query($con, $sqli);  
          while ($row = mysqli_fetch_assoc($result)) {
                    $emp1_id = $row['emp_id'];
                    $sql = "SELECT * FROM employee_leave_count where emp_id = $emp1_id";
                    $result2 = mysqli_query($con, $sql);
                    while ($row1 = mysqli_fetch_assoc($result2)) {
                        $data = $row1['emp_id']; 
                                if ($row['left_paid_leave'] >= 10) {
                                    $leav = 10.00;
                                } else {
                                    $leav = $row['left_paid_leave'];
                                }
                                $q = "INSERT INTO employee_leave_count2 VALUES ('', '$data', '0', '0', ' $leav', '0', '0', '0', '0', '0', '$leav', NOW())";
                                $result_insert = mysqli_query($con, $q); 
                 }
        }
        header('location: All_leave_Blance.php');
    }
?>
<?php
    if (isset($_POST["delete"])) {
            $deleteSql = "DELETE FROM employee_leave_count2";
            $deleteResult = mysqli_query($con, $deleteSql);
            if (!$deleteResult) {
                echo "Error: " . mysqli_error($con);
            }else{
                $data = 'hidden';
            }
            header('location: All_leave_Blance.php');
            exit();
    }
?>
<?php 
    if(isset($_POST["leaveadd"])){
        $sql = "SELECT * FROM employee_leave_count";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['emp_id'];
            $total_casual_leave = $row['total_casual_leave'] + 1; 
            $total_sick_leave = $row['total_sick_leave'] + 1;
            $total_paid_leave = $row ['total_paid_leave']+ 1;
            $left_casual_leave = $row['left_casual_leave']+ 1;
            $left_sick_leave = $row['left_sick_leave'] + 1;
            $left_paid_leave = $row['left_paid_leave'] + 1;
            $query = "update  employee_leave_count set total_casual_leave='$total_casual_leave',total_sick_leave='$total_sick_leave',total_paid_leave='$total_paid_leave',left_casual_leave='$left_casual_leave',left_sick_leave='$left_sick_leave',left_paid_leave='$left_paid_leave',created_time=now() where emp_id ='$id'";
            $data = mysqli_query($con, $query) or die('Query is not Select');
       }    
       header('location: All_leave_Blance.php');
       exit();
    }
?>
<?php 
    if(isset($_POST["leavecadd"])){
        $sql = "SELECT * FROM employee_leave_count2";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['emp_id'];
            $total_casual_leave = $row['total_casual_leave'] + 1; 
            $total_sick_leave = $row['total_sick_leave'] + 1;
            $total_paid_leave = $row ['total_paid_leave']+ 1;
            $left_casual_leave = $row['left_casual_leave']+ 1;
            $left_sick_leave = $row['left_sick_leave'] + 1;
            $left_paid_leave = $row['left_paid_leave'] + 1;
            $query = "update  employee_leave_count2 set total_casual_leave='$total_casual_leave',total_sick_leave='$total_sick_leave',total_paid_leave='$total_paid_leave',left_casual_leave='$left_casual_leave',left_sick_leave='$left_sick_leave',left_paid_leave='$left_paid_leave',created_time=now() where emp_id ='$id'";
            $data = mysqli_query($con, $query) or die('Query is not Select');
       }    
       header('location: All_leave_Blance.php');
       exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Leave Request Page</title>
    <?php include('./links/cssLinks.php'); ?>

</head>
<body>
  <?php include('./sidbar.php'); ?>
  <div class="main-content" id="panel">
    <?php include('./hader.php')?>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col">
            <!-- First Table -->
            <div class="d-flex justify-content-between mb-3">
                <div class="ml-auto">
                  <form method="post" action="./All_leave_Blance.php" name="carryForm">
                    <button type="submit" name="submit" class="btn btn-info" id="carrydata">Carry Forward</button> 
                 </form>
                </div>
            </div>
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-left">Employee Leave Balance</h3>
                <div>
                   <form method="post" action="./All_leave_Blance.php" style="display: inline;">
                     <button type="submit" name="leaveadd" class="btn btn-info" id="carrydata">Month Leave Add</button>
                   </form>
                    <button type="button" title="Excal" class="btn btn-link pr-0" style="color:green" onclick="downloadExcel()">
                        <i class="fa fa-file-excel-o fa-2x"></i>
                    </button>
                    <a href="../pdf_code/mgenerate_pdf.php">
                        <button type="button" title="PDF" style="color:red" class="btn btn-link pl-0">
                            <i class="fa fa-file-pdf-o fa-2x"></i>
                        </button>
                    </a>   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-light table-flush" id="tableshow">
                    <thead class="thead-light">
                        <tr>
                              <th scope="col" class="sort" data-sort="name">SNo</th>
                              <th scope="col" class="sort" data-sort="budget">Employee Name</th>
                              <th scope="col" class="sort" data-sort="budget">Total Casual Leave</th>
                              <th scope="col" class="sort" data-sort="status">Total Paid Leave</th>
                              <th scope="col" class="sort" data-sort="status">Total Sick Leave</th>
                              <th scope="col" class="sort" data-sort="completion">Use Casual Leave </th>   
                              <th scope="col" class="sort" data-sort="status">Use Sick Leave </th>
                              <th scope="col" class="sort" data-sort="completion">Use Paid Leave </th>  
                              <th scope="col" class="sort" data-sort="status">Left Casual Leave </th> 
                              <th scope="col" class="sort" data-sort="completion">Left Sick Leave </th>   
                              <th scope="col" class="sort" data-sort="status">Left Paid Leave </th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php 
                            $id = $_SESSION['manage_id'];
                            $sql="SELECT employee.*, employeeadd.*, employee_leave_count.* FROM employee
                             LEFT JOIN employeeadd ON employee.emp_id = employeeadd.emp_id
                             LEFT JOIN employee_leave_count ON employee_leave_count.emp_id = employee.emp_id";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if($row['manage_id'] ==  $id){
                                    $dataFound = true;
                        ?>
                        <tr>
                                  <td class="text-center"><?php echo $row['employee_leave_count_id']; ?></td>
                                  <td class="text-center"><?php echo $row['emp_name'];?></td>
                                  <td class="text-center"><?php echo $row['total_casual_leave'];?></td>
                                  <td class="text-center"><?php echo $row['total_sick_leave'];?></td>
                                  <td class="text-center"><?php echo $row['total_paid_leave'];?></td>
                                  <td class="text-center"><?php echo $row['total_use_casual_leave'];?></td>
                                  <td class="text-center"><?php echo $row['total_use_sick_leave'];?></td>
                                  <td class="text-center"><?php echo $row['total_use_paid_leave'];?></td>
                                  <td class="text-center"><?php echo $row['left_casual_leave'];?></td>
                                  <td class="text-center"><?php echo $row['left_sick_leave'];?></td>
                                  <td class="text-center"><?php echo $row['left_paid_leave'];?></td>
                        </tr>
                        <?php } }    if (!$dataFound) { ?>
                            <td class="text-center" colspan="12">
                                <div class="alert alert-info mb-0" role="alert">
                                  <h5 class="alert-heading">Leave Is Not Apply</h5>
                                   <p class="mb-0">First add Employee your Under</p>
                                </div>
                            </td>
                        <?php 
                           } 
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- End of First Table -->
            <!-- Second Table -->
                <div class="card-header border-0 d-flex justify-content-between align-items-center mt-3">
                    <h3 class="mb-0 text-left">Employee Carry Forword Leave Balance</h3>
                    <div  class="d-flex align-items-center">
                    <button type="button" title="Excal" class="btn btn-link pr-0" style="color:green" onclick="carryExcel()">
                        <i class="fa fa-file-excel-o fa-2x"></i>
                    </button>
                        <a href="../pdf_code/mgenerate_pdf.php">
                            <button type="button" title="PDF" style="color:red" class="btn btn-link pl-0">
                                <i class="fa fa-file-pdf-o fa-2x"></i>
                            </button>
                        </a> 
                        <form method="post" action="./All_leave_Blance.php">
                            <button type="submit" name="delete" class="btn btn-link pr-2" style="color:red" title="Delete Carry Forword Leave Balance" id="deletedata"><i class="fa fa-trash fa-2x"></i></button>
                            <button type="submit" name="leavecadd" class="btn btn-info" id="carrydata">Month Leave Add</button>
                        </form>
                    </div>
                </div>          
                <div class="table-responsive" id="carryTable">
                    <table class="table align-items-center  table-light table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">SNo</th>
                                <th scope="col" class="sort" data-sort="budget">Employee Name</th>
                                <th scope="col" class="sort" data-sort="budget">Total Casual Leave</th>
                                <th scope="col" class="sort" data-sort="status">Total Paid Leave</th>
                                <th scope="col" class="sort" data-sort="status">Total Sick Leave</th>
                                <th scope="col" class="sort" data-sort="completion">Use Casual Leave </th>   
                                <th scope="col" class="sort" data-sort="status">Use Sick Leave </th>
                                <th scope="col" class="sort" data-sort="completion">Use Paid Leave </th>  
                                <th scope="col" class="sort" data-sort="status">Left Casual Leave </th> 
                                <th scope="col" class="sort" data-sort="completion">Left Sick Leave </th>   
                                <th scope="col" class="sort" data-sort="status">Left Paid Leave </th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php 
                                $id = $_SESSION['manage_id'];
                                $sql="SELECT employee.*, employeeadd.*, employee_leave_count2.* FROM employee 
                                LEFT JOIN employeeadd ON employee.emp_id = employeeadd.emp_id
                                LEFT JOIN employee_leave_count2 ON employee_leave_count2.emp_id = employee.emp_id";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['employee_leave_count2_id'] == '' ){
                                    ?>
                                    <td colspan="12" hidden></td>
                                <?php
                                    }else{
                                ?>
                              <tr>
                                    <td class="text-center"><?php echo $row['employee_leave_count2_id']; ?></td>
                                    <td class="text-center"><?php echo $row['emp_name'];?></td>
                                    <td class="text-center"><?php echo $row['total_casual_leave'];?></td>
                                    <td class="text-center"><?php echo $row['total_sick_leave'];?></td>
                                    <td class="text-center"><?php echo $row['total_paid_leave'];?></td>
                                    <td class="text-center"><?php echo $row['total_use_casual_leave'];?></td>
                                    <td class="text-center"><?php echo $row['total_use_sick_leave'];?></td>
                                    <td class="text-center"><?php echo $row['total_use_paid_leave'];?></td>
                                    <td class="text-center"><?php echo $row['left_casual_leave'];?></td>
                                    <td class="text-center"><?php echo $row['left_sick_leave'];?></td>
                                    <td class="text-center"><?php echo $row['left_paid_leave'];?></td>
                              </tr>
                            <?php } }  ?>
                        </tbody>
                    </table>
                </div>
            <!-- End of Second Table -->
          </div>                                    
        </div> 
        <?php include('./comman/footer.php');?>
      </div>
  </div>
  <script>
        function downloadExcel() {
            const table = document.getElementById('tableshow');
            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'leave_requests.xlsx');
        }
    </script>
    <script>
        function carryExcel() {
            const table = document.getElementById('carryTable');
            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'leave_requests.xlsx');
        }
    </script>
        <?php include('./links/jsLinks.php'); ?>
</body>
</html>
