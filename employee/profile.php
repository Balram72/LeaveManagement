<?php include('../comman/config.php');
if($_SESSION['empid'] == ''){
  header('location:login.php');
}else{
  header('localtion:profil.php');
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Employee Profile</title>
  <?php  include('../employee/links/cssLink.php');?>
</head>
<?php 
// insert Code Start
    if(isset($_POST['edit'])){
      $id = $_SESSION['empid'];
      $dob = $_POST['dob'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $country = $_POST['country'];
      $postal_code = $_POST['postal_code'];
      $about = $_POST['about'];
      $q = "insert into employee_details values('','$dob','$gender','$address','$city','$country','$postal_code','$about','$id',now())";
      $data = mysqli_query($con,$q) or die('query is not Select');
      if($data){
        echo '<script type="text/javascript">
        $(document).ready(function() {
            swal({
              title: "Hello Sir",
              text: "Data is Save Successfully",
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
                title: "Hello Sir",
                text: "Data is Not Save",
                icon: "error",
              }).then(function() {
                window.location.href = "profile.php";
              });
          });
        </script>';
      }    
    }
// insert Code End

// Update Code Start
  if(isset($_POST['update'])){
    $id = $_SESSION['empid'];
    $dob = $_POST['udob'];
    $gender = $_POST['ugender'];
    $address = $_POST['uaddress'];
    $city = $_POST['ucity'];
    $country = $_POST['ucountry'];
    $postal_code = $_POST['upostal_code'];
    $about = $_POST['uabout'];

    // Use UPDATE statement instead of INSERT
    $query = "update employee_details set dob='$dob',gender='$gender',address='$address',city='$city',country='$country',postal_code='$postal_code',about='$about',created_time=now() where emp_id ='$id'";
    $data = mysqli_query($con, $query) or die('Query is not Select');

    if($data){
            echo '<script type="text/javascript">
            $(document).ready(function() {
                swal({
                  title: "Hello Sir",
                  text: "Data is Update Successfully",
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
              title: "Hello Sir",
              text: "Data is Not Update",
              icon: "error",
            }).then(function() {
              window.location.href = "profile.php";
            });
        });
      </script>';
    }
  }
// Update Code End
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
    <div class="header pb-7 bg-primary d-flex align-items-center">
      <!-- Mask -->
      <!-- Header container -->
      <div class="container-fluid d-flex  align-items-center">
        <div class="row">
          <div class="col-lg-12 col-md-10 mt-6">
            <h1 class="display-2 text-white">Hello <?php echo $_SESSION['empname'];  ?> </h1>
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
                <?php 
                  $id = $_SESSION['empid'];
                  $sql = "SELECT * FROM employee WHERE employee.emp_id = $id;";
                  $result = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_assoc($result)){
                ?>
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
                          <input type="text" id="input-email" class="form-control" value="<?php echo $row['emp_name']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Email address</label>
                          <input type="text" id="input-username" class="form-control" placeholder="Username" value="<?php echo $row['emp_email']; ?>" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Contacts Number</label>
                          <input type="number" id="input-email" class="form-control" value="<?php echo $row['emp_mobile'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-doj">Date OF Join</label>
                          <input type="date" id="input-doj" class="form-control"  value="<?php echo $row['emp_doj']; ?>" disabled>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                <hr class="my-4" />
               <?php  } ?>
               <?php 
                  $id = $_SESSION['empid'];
                  $sql = "SELECT * FROM employee_details WHERE employee_details.emp_id = $id";
                  $result = mysqli_query($con, $sql);
                  if ($row = mysqli_fetch_assoc($result)){
                ?>
                <!-- edit Form Start-->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                    <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-dob"> Employee Date Of Birth</label>
                              <input type="date" id="input-dob" value="<?php echo $row['dob']  ?>"  name="udob" class="form-control">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                  <label class="form-control-label" for="input-employeename">Gender</label>
                                      <select  class="form-control" id="input-employeename" name="ugender">
                                      <option  selected><?php echo $row['gender']  ?></option>
                                      <option value="Man">Man</option>
                                      <option value="Woman">Woman</option>
                                      <option value="Other">Other</option>
                                    </select>
                            </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="form-control-label" for="input-address">Address</label>
                            <input id="input-address" class="form-control" name="uaddress" value="<?php echo $row['address'] ?>" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label" for="input-city">City</label>
                            <input type="text" id="input-city" class="form-control" value="<?php echo $row['city'] ?>" name="ucity" >
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label" for="input-country">Country</label>
                            <input type="text" id="input-country" class="form-control" value="<?php echo $row['country'] ?>" name="ucountry" >
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label" for="input-country">Postal code</label>
                            <input type="number" id="input-postal-code" class="form-control" name="upostal_code" value="<?php echo $row['postal_code'] ?>">
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
                        <textarea rows="4" name="uabout" class="form-control"><?php echo $row['about'] ?></textarea>
                      </div>
                    </div>
                      <div class="text-right">
                        <button type="submit" name="update" class="btn btn-primary my-4">Update</button>
                      </div>
                <!-- Edit Form  End-->
                <?php
                  }else{
                ?>
                  <!-- Save Form Start-->
                       <h6 class="heading-small text-muted mb-4">Contact information</h6>
                      <div class="pl-lg-4">
                      <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-dob"> Employee Date Of Birth</label>
                                <input type="date" id="input-dob"  name="dob" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                    <label class="form-control-label" for="input-employeename">Gender</label>
                                        <select  class="form-control" id="input-employeename" name="gender">
                                        <option  selected>Select The Employees</option>
                                        <option value="Man">Man</option>
                                        <option value="Woman">Woman</option>
                                        <option value="Other">Other</option>
                                      </select>
                              </div>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label" for="input-address">Address</label>
                              <input id="input-address" class="form-control" name="address" placeholder="Home Address" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-city">City</label>
                              <input type="text" id="input-city" class="form-control" name="city" placeholder="City" >
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-country">Country</label>
                              <input type="text" id="input-country" class="form-control" name="country" placeholder="Country">
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-country">Postal code</label>
                              <input type="number" id="input-postal-code" class="form-control" name="postal_code" placeholder="Postal code">
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
                          <textarea rows="4" name="about" class="form-control" placeholder="A few words about you ..."></textarea>
                        </div>
                      </div>
                        <div class="text-right">
                          <button type="submit" name="edit" class="btn btn-primary my-4">Save</button>
                        </div>
                  <!-- Save Form  End-->
                <?php }?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php include('../comman/footer.php') ?>
    </div>
  </div>
      <?php include('../employee/links/jsLink.php') ?>              
</body>

</html>