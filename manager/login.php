<?php    
 error_reporting(0);
 include('../comman/config.php'); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Login Page</title>
    <?php  include('../manager/links/cssLinks.php');?>
</head>
<!-- php code -->
  <?php
    if(isset($_POST['login'])){
          $email = $_POST['email'];
          $password = $_POST['password'];
          $email_search = "select * from manager where manage_email='$email'";
          $query=mysqli_query($con,$email_search);
          $emailcheck=mysqli_num_rows($query);
        if($emailcheck){
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass = $email_pass['manage_password'];
            $_SESSION['manage_id'] = $email_pass['manage_id'];
            $_SESSION['manage_name'] = $email_pass['manage_name'];
            if($password ===  $db_pass ){
              echo '<script type="text/javascript">
                $(document).ready(function() {
                  swal({
                    title: "Welcome Sir",
                    text: "Login Successfully",
                    icon: "success",
                  }).then(function() {
                    window.location.href = "profile.php";
                  });
                });
            </script>';
            }
            else{
              echo '<script type="text/javascript">
                $(document).ready(function() {
                  swal({
                      title: "Error",
                      text: "Password_Not_Matching",
                      icon: "error",
                  }).then(function() {
                    window.location.href = "login.php";
                  });
                });
              </script>';
            }
      }else{
        echo '<script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: "Error",
                text: "Invalid_Email Please First Register",
                icon: "error",
            }).then(function() {
              window.location.href = "login.php";
            });
        });
      </script>';
      }
    }
  ?>
<!-- php code -->
<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white" style="margin-top:-50px">Managers</h1>
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
          <div class="card bg-secondary border-0 mb-0" style="margin-top:-70px">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h1 class="text-gray">sign in</h1>
              </div>
              <form role="form" method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password"  name="password" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
            <div class="row">
                <div class="col-5 text-left ml-3 mt--6">
                      <a href="./password-reset.php" class="text-light">
                          <button type="button" class="btn btn-link my-4">Forgot password?</button>
                      </a>
                </div>
                <div class="col-6 text-right mr-1 mt--6">
                      <a href="./register.php" class="text-light">
                          <button type="button" class="btn btn-link my-4">Create new account</button>
                      </a>
                </div>
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
  <?php include('../manager/links/jsLinks.php') ?>
</body>
</html>