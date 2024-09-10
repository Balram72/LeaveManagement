<?php
include('../comman/config.php');
error_reporting(0);

if (isset($_GET['id'],$_GET['status'],$_GET['emp_id'],$_GET['leave_id'],$_GET['total_day'])){
    $ueid = $_GET['id'];
    $statue = $_GET['status'];
    $emp_id = $_GET['emp_id'];
    $leave_id = $_GET['leave_id'];
    $total_day = $_GET['total_day'];

      $query = "UPDATE employee_leave_request_table SET statue='$statue' WHERE emp_le_re_id ='$ueid'";
      mysqli_query($con, $query) or die("Query is not run");
      if($_GET['status'] == 2){
          if($_GET['leave_id'] == 1){
              $sql = " UPDATE employee_leave_count 
              SET total_use_casual_leave = total_use_casual_leave + $total_day,
              left_casual_leave = left_casual_leave - $total_day WHERE emp_id = $emp_id";
          }elseif($_GET['leave_id'] == 2){
              $sql = "UPDATE employee_leave_count 
              SET total_use_sick_leave = total_use_sick_leave + $total_day,
              left_sick_leave = left_sick_leave - $total_day WHERE emp_id = $emp_id";
          }elseif($_GET['leave_id'] == 3){
              $sql = "UPDATE employee_leave_count 
              SET total_use_paid_leave = total_use_paid_leave +$total_day,
              left_paid_leave = left_paid_leave - $total_day WHERE emp_id = $emp_id";
          }
          mysqli_query($con,$sql) or die("Query is not run");
          header("location:leave_request.php");
      }else{
        header("location:leave_request.php");
      }   
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
  <!-- Sidenav -->
  <?php include('./sidbar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php  include('./hader.php')?>
    <!-- Page content -->
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                  <div class="card-header border-0">
                  <h3 class="mb-0 text-center">Employee Leave Request Table</h3>
                </div>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">NO</th>
                    <th scope="col" class="sort" data-sort="budget">Employee Name</th>
                    <th scope="col" class="sort" data-sort="budget">Employee Email</th>
                    <th scope="col" class="sort" data-sort="status">Employee id</th>
                    <th scope="col" class="sort" data-sort="status">status</th>
                    <th scope="col" class="sort" data-sort="completion">View</th>   
                    <th scope="col" class="sort" data-sort="status">Operation</th>
                  </tr>
                </thead>
                <tbody class="list">
                    <?php 
                        $id = $_SESSION['manage_id'];
                        $sql="SELECT emp_le_re_id,e.emp_name,e.emp_id,e.emp_email,lt.leave_type,lt.leave_id,from_date,to_date,total_day,reason,statue FROM employee_leave_request_table JOIN employee e ON employee_leave_request_table.emp_id = e.emp_id JOIN leave_table lt ON employee_leave_request_table.leave_id = lt.leave_id where manage_id = $id";
                           $result = mysqli_query($con, $sql);
                           while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['emp_le_re_id']; ?></td>
                        <td><?php echo $row['emp_name'];?></td>
                        <td><?php echo $row['emp_email'];?></td>
                        <td><?php echo $row['leave_type'];?></td>
                        <td>
                          <?php 
                            if($row['statue']=='1'){
                                  echo 'peanding';
                            }
                            if($row['statue']=='2'){
                              echo 'Accept';
                            }
                            if($row['statue']=='3'){
                              echo 'Reject';
                            }
                          ?>
                        </td> 
                        <td><a href="../employee/show_datils.php?id=<?php echo $row['emp_id']; ?>" title="Employee Information show" ><i class="fa fa-eye fa-2x"></i></a></td>
                        <td> 
                            <select class="form-control col-lg-7" onchange="status_update(this.options[this.selectedIndex].value,<?php echo $row['emp_le_re_id'];?>,<?php echo $row['emp_id'];?>,<?php echo $row['leave_id'];?>,<?php echo $row['total_day'];?>)" name="statue">
                              <option>OPERATION</option>
                              <option value="2" class="text-green">ACCEPTED</option>
                              <option value="3" class="text-red">REJECTED</option>
                            </select>
                         </td>
                      
                        <?php } ?>
                    </tr>
                </tbody>
              </table>
        </div>
      </div>
      <!-- Footer -->
      <?php include('../comman/footer.php') ?>
    </div>
  </div>
 <script type="text/javascript">
    function status_update(value,emp_le_re_id,emp_id,leave_id,total_day) {
        let url = "http://localhost/LeaveManagement/manager/leave_request.php";
        window.location.href = url+"?id="+emp_le_re_id+"&status="+value+"&emp_id="+emp_id+"&leave_id="+leave_id+"&total_day="+total_day;
    }
</script>
<?php include('./links/jsLinks.php'); ?>

</body>

</html>