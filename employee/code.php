<?php 
 include('../comman/config.php');

 if(isset($_POST['click_view_btn'])){
    $show_id = $_POST['show_id'];
    $sql = "SELECT * FROM employee_leave_request_table WHERE emp_le_re_id = $show_id";
    $result = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_assoc($result)) {

        echo '
            <p><strong>Leave Id:-</strong>' .$row['emp_le_re_id'].'</p>
            <p><strong>Form Date:-</strong>' .$row['from_date'].'</p>
            <p><strong>To Date:-</strong>' .$row['to_date'].'</p>
            <p><strong>Reason:-</strong>' .$row['reason'].'</p>
            <p><strong>Applay Date:-</strong>' .$row['created_time'].'</p>';

    }else{
            echo '<h4>No Recod Found</h4>';
    }

 }

 
?>