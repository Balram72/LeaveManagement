<?php include('../employee/links/cssLink.php'); ?>
<?php
session_start();
if (isset($_SESSION['empname'])) {
    session_destroy();
?>
<script type="text/javascript">
              $(document).ready(function() {
                  swal({
                    title: "Thank You Sir",
                    text: "Logout Successfully",
                    icon: "success",
                  }).then(function() {
                    window.location.href = "login.php";
                  });
              });
</script>
<?php
} else {
?>
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Error",
            text: "Please Login First",
            icon: "error",
        }).then(function() {
            window.location.href = "login.php";
        });
    });
</script>
<?php
}
?>
<?php  include('../employee/links/jsLink.php');?>
