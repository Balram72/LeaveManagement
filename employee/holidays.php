<?php
include('../comman/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Holiday Page</title>
    <?php include('./links/cssLink.php'); ?>
</head>
<body>
  <?php include('./sidbar.php'); ?>
  <div class="main-content" id="panel">
    <?php include('./hader.php');?>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-left">Holiday List</h3>
                <div>
                    <button type="button" title="Excal" class="btn btn-link pr-0" style="color:green" onclick="downloadExcel()">
                        <i class="fa fa-file-excel-o fa-2x"></i>
                    </button>
                    <a href="../pdf_code/holiday_pdf.php">
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
                              <th class="text-center" data-sort="name">SNo</th>
                              <th class="text-center" data-sort="budget">Holiday  Name</th>
                              <th class="text-center" data-sort="budget">Holiday Date</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php 
                            $sql = "SELECT * FROM holidays";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $row['holidays_id']; ?></td>
                            <td class="text-center"><?php echo $row['holidays_name']; ?></td>
                            <td class="text-center"><?php echo $row['holidays_date']; ?></td>
                        </tr>
                        <?php 
                        } 
                        ?>
                    </tbody>

                </table>
            </div>
            <!-- End of First Table -->
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
        <?php include('./links/jsLinks.php'); ?>
</body>
</html>
