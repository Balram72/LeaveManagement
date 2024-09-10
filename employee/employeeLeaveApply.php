<?php include('../comman/config.php');
error_reporting(0);
if($_SESSION['empid'] == ''){
    header('location:login.php');
  }else{
    header('localtion:profil.php');
  }

if (isset($_POST['login'])) {
    $emp_id = $_SESSION['empid'];
    $manage_id = $_POST['manage_id'];
    $leave_id = $_POST['leave_id'];
    $fromday = $_POST['fromday'];
    $duration = $_POST['duration'];
    $today = $_POST['today'];
    $sql = "SELECT count(*) FROM holidays where holidays_date between '$fromday' and '$today'";
    $result = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_array($result)){
            $count=$row[0]; 
    }
    $total_day = $_POST['total_day'] - $count;
    $reason = $_POST['reason'];
    $insert_query = "INSERT INTO employee_leave_request_table VALUES ('', '$emp_id','$manage_id','$leave_id','$fromday','$duration','$today','$total_day','$reason',1,NOW())";
    $insert_data = mysqli_query($con,$insert_query) or die('Insert query error');
    if ($insert_data) {
        header("location:profile.php");
    } else {
        header("location:login.php?error=insert_failed");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Apply Leave</title>
    <?php include('./links/cssLink.php')?>
     <style>
        #tableshow {
            display: none;
        }

        #pdfTableWrapper td {
            max-width: 100px;
            word-wrap: break-word;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidenav -->
    <?php include('./sidbar.php'); ?>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <?php include('./hader.php') ?>
        <!-- Header -->
        <!-- Header -->
        <!-- Page content -->
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-sm-12 order-xl-" id="formshow">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h3 class="mb-0 text-center">Apply Leave</h3>
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
                                                <label class="form-control-label" for="input-username">Employee Name</label>
                                                <input type="text" id="input-username" class="form-control"
                                                    placeholder="Enter Your Name"
                                                    value="<?php echo $_SESSION['empname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-employeename">Manager
                                                    Name</label>
                                                <?php
                                                $id = $_SESSION['empid'];
                                                $q = "SELECT employeeadd.*, manager.*, employeeadd.emp_id FROM employeeadd INNER JOIN manager ON employeeadd.manage_id = manager.manage_id WHERE employeeadd.emp_id = $id";
                                                $result = mysqli_query($con, $q);
                                                while ($tmp = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <input type="text" name="manage_id"
                                                    value=" <?php echo $tmp['manage_id'] ?>" hidden>
                                                <input type="text" id="input-username" class="form-control"
                                                    placeholder="Enter Your Name"
                                                    value=" <?php echo $tmp['manage_name'] ?>" disabled>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-employeename">Leave
                                                    Type</label>
                                                <select class="form-control" id="input-employeename" name="leave_id"
                                                    required>
                                                    <option value="" selected>Select The Leave Type</option>
                                                    <?php
                                                    $q = "SELECT * from leave_table";
                                                    $result = mysqli_query($con, $q);
                                                    while ($tmp = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?php echo $tmp['leave_id']; ?>">
                                                        <?php echo $tmp['leave_type']; ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-fromday">From Date</label>
                                                <input type="Date" class="form-control" id="startDate" name="fromday"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-today">To Day</label>
                                                <input type="Date" class="form-control" id="endDate" name="today"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-duration">Leave
                                                    Duration</label>
                                                <select class="form-control" id="input-duration" name="duration" required>
                                                    <option value="">Select The Leave Duration</option>
                                                    <option value="Fullday">Full Day</option>
                                                    <option value="Firsthalf">First Half</option>
                                                    <option value="Secondhalf">Second Half</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-today">Total Day</label>
                                                <input type="text" id="totalDays" name="total_day" class="form-control"
                                                    value="Nan Days" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Reason</label>
                                                <textarea rows="4" class="form-control" name="reason"
                                                    placeholder="Please Enter A proper Reason...."></textarea>
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
                <div class="table-responsive" id="tableshow">
                        <div class="card-header border-0 d-flex justify-content-between align-items-left">
                            <h3 class="mb-0">Show All Leave </h3>
                          <div>
                                <button type="button" title="Excal" class="btn btn-link pr-0" style="color:green" onclick="downloadExcel()">
                                    <i class="fa fa-file-excel-o fa-2x"></i>
                                </button>
                                <a href="../pdf_code/generate_pdf.php">
                                    <button type="button" title="PDF" style="color:red" class="btn btn-link pl-0">
                                        <i class="fa fa-file-pdf-o fa-2x"></i>
                                    </button>
                                </a> 
                          </div>
                        </div>
                    <table class="table align-items-center table-light table-flush">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col" class="sort" data-sort="name">NO</th>
                                  <th scope="col" class="sort" data-sort="budget">Manage Name</th>
                                  <th scope="col" class="sort" data-sort="status">Manager Email</th>
                                  <th scope="col" class="sort" data-sort="status">Manager Mobile Number</th>
                                  <th scope="col" class="sort" data-sort="status">Leave Type</th>
                                  <th scope="col" class="sort" data-sort="status">Leave Duration</th>
                                  <th scope="col" class="sort" data-sort="status">Date Of Apply</th>
                                  <th scope="col" class="sort" data-sort="status">Form Date</th>
                                  <th scope="col" class="sort" data-sort="status">To Date</th>
                                  <th scope="col" class="sort" data-sort="status">Total Day</th>
                                  <th scope="col" class="sort" data-sort="status">Statue</th>
                              </tr>
                          </thead>
                          <tbody class="list">
                              <?php
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
                              while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['total_day'] ==''){
                                    ?>
                                    <td class="text-center" colspan="12">
                                        <div class="alert alert-info mb-0" role="alert">
                                            <h5 class="alert-heading">Leave Is Not Apply</h5>
                                            <p class="mb-0">No leave requests have been submitted by this employee.</p>
                                        </div>
                                    </td>
                            <?php 
                                    }else{
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['emp_le_re_id']; ?></td>
                                    <td class="text-center"><?php echo $row['manage_name']; ?></td>
                                    <td class="text-center"><?php echo $row['manage_email']; ?></td>
                                    <td class="text-center"><?php echo $row['manage_mob']; ?></td>
                                    <td class="text-center"><?php echo $row['leave_type']; ?></td>
                                    <td class="text-center"><?php echo $row['duration']; ?></td>
                                    <td class="text-center"><?php echo date('Y-m-d', strtotime($row['created_time'])); ?></td>
                                    <td class="text-center"><?php echo $row['from_date']; ?></td>
                                    <td class="text-center"><?php echo $row['to_date']; ?></td>
                                    <td class="text-center"><?php echo $row['total_day']; ?></td>
                                    <?php
                                    if ($row['statue'] == '1') {
                                        $view = "Padding";
                                        $textColor = 'color: blue;';
                                    }
                                    if ($row['statue'] == '2') {
                                        $view = "Accept";
                                        $textColor = 'color: green;';
                                    }
                                    if ($row['statue'] == '3') {
                                        $view = "RejectT";
                                        $textColor = 'color: red;';
                                    }

                                    ?>
                                    <td style="<?= $textColor ?>">
                                        <?php echo $view; ?>
                                    </td>
                                </tr>

                              <?php } } ?>
                          </tbody>
                    </table>
                </div>
            </div>
            <!-- Footer -->
            <?php include('../comman/footer.php') ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- date count -->
    <script>
    var selectedDuration; 
    document.getElementById('input-duration').addEventListener('change', function () {
        const select = document.getElementById('input-duration');
        selectedDuration = select.options[select.selectedIndex].value;
        calculateTotalDays();
    });
     
    function calculateTotalDays() {
        var startDate = new Date(document.getElementById('startDate').value);
        var endDate = new Date(document.getElementById('endDate').value);

        if (endDate < startDate) {
            alert("End date cannot be before start date");
            return;
        }
        if (selectedDuration == "Fullday") {
            var timeDiff = endDate - startDate;
            var totalDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            document.getElementById('totalDays').value = totalDays;

        } else if (selectedDuration == "Firsthalf" || selectedDuration == "Secondhalf") {
            document.getElementById('totalDays').value = 0.5;
        } else {
            document.getElementById('totalDays').value = 0.0;
        }
    }
    document.getElementById('startDate').addEventListener('change', calculateTotalDays);
    document.getElementById('endDate').addEventListener('change', calculateTotalDays);
</script>
    <script>
        function downloadExcel() {
            const table = document.querySelector('table');
            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'leave_requests.xlsx');
        }
    </script>
    <?php include('./links/jsLink.php') ?>
    <script>
        if (window.location.hash === '#tableshow') {
            document.getElementById('tableshow').style.display = 'table';
            document.getElementById('formshow').style.display = 'none';
        }
    </script>
</body>
</html>
