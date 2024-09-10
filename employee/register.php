<?php
include('../comman/config.php');
include('../vendor/autoload.php');
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Register Page</title>
    <?php
        include('../employee/links/cssLink.php');
    ?>
</head>
<!-- php code Start -->
    <?php
      if (isset($_POST['submit'])) {
        $emp_name = $_POST['emp_name'];
        if (strlen($emp_name) < 1 || strlen($emp_name) > 50) {
          $error_emp_name = "Employee Name must be between 1 and 50 characters.";
        }
        $emp_email = $_POST['emp_email'];
        $validator = new EmailValidator();
        $dnsValidation = new DNSCheckValidation();
        if (!$validator->isValid($emp_email, $dnsValidation)) {
          $error_emp_email = "Invalid email address or domain.";
        }
        $emp_mobile = $_POST['emp_mobile'];
        if (!preg_match("/^[6-9]\d{9}$/", $emp_mobile)) {
          $error_emp_mobile = "Enter a valid mobile number.";
        }
        $emp_doj = $_POST['emp_doj'];
        $emp_password = $_POST['emp_password'];
            $check_query = "SELECT * FROM employee WHERE emp_email = '$emp_email' OR emp_mobile = '$emp_mobile'";
            $check_result = mysqli_query($con, $check_query);
            $existing_user = mysqli_fetch_assoc($check_result);
            if ($existing_user) {
              echo '<script type="text/javascript">
                  $(document).ready(function() {
                      swal({
                          title: "Error",
                          text: "User with this email or mobile number already exists!",
                          icon: "error",
                          button: "Ok",
                      }).then(function() {
                        window.location.href = "login.php";
                      });
                  });
              </script>';
            }else{
              if (!isset($error_emp_name) && !isset($error_emp_email) && !isset($error_emp_mobile)) {
                $q = "INSERT INTO employee VALUES('', '$emp_name', '$emp_email', '$emp_doj', '$emp_password', '$emp_mobile', NOW())";
                $data = mysqli_query($con, $q) or die('Query is not Select');
                if ($data) {
                  echo '<script type="text/javascript">
                    $(document).ready(function() {
                        swal({
                            title: "Employee created!",
                            text: "Success Register",
                            icon: "success",
                            button: "Ok",
                            timer: 2000
                        }).then(function() {
                            window.location.href = "login.php";
                        });
                    });
                  </script>';
                } else {
                   header("location: register.php");
                }
              }
          }
      }
    ?>
<!-- Php code end  -->
<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.html">
                <img src="../assets/img/brand/blue.png">
              </a>
            </div>
          </div>
        </div>
      </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white" style="margin-top:-100px">Employee</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0" style="margin-top:-140px">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h1 class="text-gray">Sign Up</h1>
              </div>
              <form role="form" method="post">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="Name" type="text" name="emp_name" required>
                  </div>
                  <?php if (isset($error_emp_name)) echo "<p class='error text-danger'>$error_emp_name</p>"; ?>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="emp_email" type="email" required>
                  </div>
                  <?php if (isset($error_emp_email)) echo "<p class='error text-danger'>$error_emp_email</p>"; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" placeholder="Mobile Number" name="emp_mobile" type="text" required>
                  </div>
                  <?php if (isset($error_emp_mobile)) echo "<p class='error text-danger'>$error_emp_mobile</p>"; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <span class="input-group-text">Date Of Join</span>
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control" type="Date" name="emp_doj" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" name="emp_password" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary my-4">Create account</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-4 ml-0 mt--6">
            <a href="./login.php" class="text-light">
              <button type="button" class="btn btn-outline-primary my-4">Login</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center  text-lg-left  text-muted">
            &copy; 2023 <a href="#!" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="#!" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <?php include('../employee/links/jsLink.php'); ?>
</body>
</html>