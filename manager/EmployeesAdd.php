<?php  include('../comman/config.php'); 
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Employee ADD</title>
  <?php  include('../manager/links/cssLinks.php')?>
</head>
<?php
  if (isset($_POST['login'])) {
      $emp_id = $_POST['emp_id'];
      // Check if emp_id already exists
      $check_query = "SELECT * FROM employeeadd WHERE emp_id = '$emp_id'";
      $check_result = mysqli_query($con, $check_query) or die('Query error');
      if (mysqli_num_rows($check_result) > 0 ) {
        echo'<script type="text/javascript">
              $(document).ready(function() {
                  swal({
                    title: "Sorry Sir",
                    text: "employee_is_already_exists_Under_Another_Manager",
                    icon: "error",
                  }).then(function() {
                    window.location.href = "EmployeesAdd.php";
                  });
              });
            </script>';
          exit;
      }
      // Check if limit only 5 
      $mange_id = $_SESSION['manage_id'];
      $countQuery = "SELECT COUNT(*) as count FROM employeeadd WHERE manage_id = '$mange_id'";
      $countResult = mysqli_query($con, $countQuery) or die('Query failed');
      $row = mysqli_fetch_assoc($countResult);
      $currentEmployeeCount = $row['count'];
      echo $currentEmployeeCount;
      if ($currentEmployeeCount >= 5) {
        echo'<script type="text/javascript">
              $(document).ready(function() {
                  swal({
                    title: "Sorry Sir",
                    text: "max_employees_reached",
                    icon: "error",
                  }).then(function() {
                    window.location.href = "EmployeesAdd.php";
                  });
              });
            </script>';
          exit;
      }

      $insert_query = "INSERT INTO employeeadd VALUES ('', '$emp_id', '$mange_id', NOW())";
      $insert_data = mysqli_query($con, $insert_query) or die('Insert query error');
      if ($insert_data) {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                swal({
                  title: "Hello Sir",
                  text: "Employee is Add  Successfully",
                  icon: "success",
                }).then(function() {
                  window.location.href = "profile.php";
                });
            });
          </script>';
      } else {
          echo '<script type="text/javascript">
              $(document).ready(function() {
                  swal({
                    title: "Error",
                    text: "insert_failed",
                    icon: "error",
                  }).then(function() {
                    window.location.href = "login.php;
                  });
              });
            </script>';
          header("location:login.php?error=");
      }
  }
  // employeee Delete funcation Start
    if (isset($_GET['id'])) {
      $employeeId = $_GET['id'];
        $sql = "DELETE FROM employeeadd WHERE emp_id = $employeeId";
        if (mysqli_query($con, $sql)) {
            echo "Record deleted successfully";
            header('localtion:EmployeesAdd.php');
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    }  
  // employeee Delete funcation End

?>
<body>
  <!-- Sidenav -->
  <?php include('./sidbar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php  include('./hader.php')?>
    <!-- Header -->
    <!-- Header -->
    <!-- Page content -->
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-12 order-xl-">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-12">
                  <h3 class="mb-0 text-center">Add Employees</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post">
                <h6 class="heading-small text-muted mb-4">Select Employees</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-employeename">Employee Name</label>
                            <select  class="form-control" id="input-employeename" name="emp_id">
                            <option value="Select The Employees" selected>Select The Employees</option>
                                <?php 
                                      $q="SELECT * from employee";
                                      $result = mysqli_query($con,$q);
                                      while($tmp=mysqli_fetch_assoc($result)) {
                                ?>    
                                <option ><?php echo $tmp['emp_id']; ?>&nbsp;<?php echo $tmp['emp_name']; ?></option>
                                <?php 
                                      }  
                                ?>  
                            </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-right">
                  <button type="submit" name="login" class="btn btn-primary my-3">ADD</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <div class="card-header border-0">
                  <h3 class="mb-0">Employee Name</h3>
                </div>
                <thead class="thead-light">
                  <tr>
                    <th  class="text-center" data-sort="name" >NO</th>
                    <th  class="text-center"  data-sort="budget">Employee Name</th>
                    <th  class="text-center"  data-sort="status">Employee id</th>
                    <th  class="text-center"  data-sort="status">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                    <?php 
                           $mange_id = $_SESSION['manage_id'];
                           $sql = "SELECT * FROM employeeadd  WHERE manage_id = '$mange_id' ";
                           $result = mysqli_query($con, $sql);
                           if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              if ($row['empa_id'] != null) {
                            ?>
                            
                              <tr>
                              <td class="text-center"><?php echo $row['empa_id']; ?></td>
                                <?php $empid = $row['emp_id']; ?>
                              <?php 
                                 $checkemployee = "SELECT * FROM employee WHERE emp_id = '$empid' ";
                                 $data = mysqli_query($con, $checkemployee);
                                 while ($rew = mysqli_fetch_assoc($data)) {
                              ?>
                              <td class="text-center"><?php echo $rew['emp_name']; ?></td>
                              <td class="text-center"><?php echo $rew['emp_email']; ?></td>
                              <td class="text-center"><a class="btn btn-link" style="color:red" title="Delete Employee" href="../manager/EmployeesAdd.php?id=<?php echo $rew['emp_id']; ?>"><i class="fa fa-trash-o fa-2x"></i></a>
                              <a href="../employee/show_datils.php?id=<?php echo $rew['emp_id']; ?>"><i class="fa fa-eye fa-2x"></i></a></td>
                              <?php } ?>
                          </tr>
                        <?php 
                              }
                              }
                            }else{
                            ?>
                              <td class="text-center" colspan="12">
                                <div class="alert alert-info mb-0" role="alert">
                                  <h5 class="alert-heading">Add The Employeee</h5>
                                   <p class="mb-0">First add Employee your Under</p>
                                </div>
                            </td>
                          <?php } ?>
                </tbody>
              </table>
        </div>
      </div>
      <!-- Footer -->
      <?php include('../comman/footer.php') ?>
    </div>
  </div>
  <?php include('./links/jsLinks.php'); ?>
</body>
</html>