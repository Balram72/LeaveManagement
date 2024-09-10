<?php include('../comman/config.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Employee Profile</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #show {  display: none;  }
    </style>
</head>
<body>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <div class="header pb-7 bg-primary d-flex align-items-center">
            <!-- Mask -->
            <!-- Header container -->
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM employee WHERE employee.emp_id = $id;";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="container-fluid d-flex align-items-center">
                    <div class="col-lg-12 col-md-10 mt-6">
                        <div class="d-flex justify-content-between align-items-center mr-7">
                            <h1 class="display-2 text-white">Hello <?php echo $row['emp_name']; ?></h1>
                            <a href="../manager/leave_request.php" class="text-light display-2">
                                <i class="fas fa-home fa-fw" title="Back"></i>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Show Profiles</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <h6 class="heading-small text-muted mb-4">Employee Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-id">Employee id</label>
                                                <input type="text" id="input-id" class="form-control" value="<?php echo $row['emp_id']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Employee Name</label>
                                                <input type="text" id="input-email" class="form-control" value="<?php echo $row['emp_name']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Email address</label>
                                                <input type="text" id="input-username" class="form-control" placeholder="Username" value="<?php echo $row['emp_email']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Contacts Number</label>
                                                <input type="number" id="input-email" class="form-control" value="<?php echo $row['emp_mobile']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-doj">Date OF Join</label>
                                                <input type="date" id="input-doj" class="form-control" value="<?php echo $row['emp_doj']; ?>" disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-4" />
                            <?php  } ?>
                            <?php
                            $sql = "SELECT * FROM employee_details WHERE employee_details.emp_id = $id";
                            $result = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <!-- edit Form Start-->
                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-dob"> Employee Date Of Birth</label>
                                                <input type="date" id="input-dob" value="<?php echo $row['dob']  ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-employeename">Gender</label>
                                                <select class="form-control" id="input-employeename" disabled>
                                                    <option selected><?php echo $row['gender']  ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Address</label>
                                                <input id="input-address" class="form-control" value="<?php echo $row['address'] ?>" type="text" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text" id="input-city" class="form-control" value="<?php echo $row['city'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-country">Country</label>
                                                <input type="text" id="input-country" class="form-control" value="<?php echo $row['country'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-country">Postal code</label>
                                                <input type="number" id="input-postal-code" class="form-control" value="<?php echo $row['postal_code'] ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">About me</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">About Me</label>
                                        <textarea rows="4" class="form-control" disabled><?php echo $row['about'] ?></textarea>
                                    </div>
                                </div>
                                <!-- Edit Form  End-->
                            <?php } ?>
                            </form>
                            <div class="table-responsive">
                                <table class="table align-items-center table-light table-flush">
                                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                        <h3 class="mb-0">Show All Leave </h3>
                                        <div>
                                            <button type="button" title="Excal" class="btn btn-link pr-0" style="color:green" onclick="downloadExcel()">
                                                <i class="fa fa-file-excel-o fa-2x"></i>
                                            </button>
                                            <a href="../pdf_code/generate_pdf.php?empid=<?php echo $id ?>">
                                                <button type="button" title="PDF" style="color:red" class="btn btn-link pl-0">
                                                    <i class="fa fa-file-pdf-o fa-2x"></i>
                                                </button>
                                            </a>   
                                        </div>
                                    </div>
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
                                            <th scope="col" class="sort" data-sort="status">View</th>

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
                                                        <td class="show_id"><?php echo $row['emp_le_re_id']; ?></td>
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
                                                            $view = "Reject";
                                                            $textColor = 'color: red;';
                                                        }
                                                        ?>
                                                        <td style="<?= $textColor ?>">
                                                            <?php echo $view; ?>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-link view_data">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                         <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="viewusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title mt-5" style="display: inline-block;">Leave Information</h5>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="float: right;">x</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="view_user_data">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include('../comman/footer.php') ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.2.0"></script>
    <script>
        function downloadExcel() {
            const table = document.querySelector('table');
            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'leave_requests.xlsx');
        }
        $(document).ready(function() {
            $('.view_data').click(function() {
                var show_id = $(this).closest('tr').find('.show_id').text();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'click_view_btn': true,
                        'show_id': show_id,
                    },
                    success: function(response) {
                        $('.view_user_data').html(response)
                        $('#viewusermodal').modal('show');
                    }
                });

            });
        });
    </script>
</body>

</html>