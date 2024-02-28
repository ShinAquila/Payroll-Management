<?php
include("../db.php"); //include auth.php file on all secure pages
include("../auth.php");

$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}

$query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $id = $row['deduction_id'];
  $philhealth_p = $row['deduction_percent'];
}

$query3 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
  $id = $row['deduction_id'];
  $GSIS_p = $row['deduction_percent'];
}

$query4 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
  $id = $row['deduction_id'];
  $PAGIBIG_p = $row['deduction_percent'];
}

$query5 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
  $id = $row['deduction_id'];
  $SSS_p = $row['deduction_percent'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description">

  <title>Pixel Foundry - Income</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/justified-nav.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/search.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.min.css">

  <style>
    body {
      margin-top: -2%;
    }

    .navbar {
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><b>Pixel Foundry</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home/home_employee.php">Employee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home/home_attendance.php">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home/home_departments.php">Department</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home/home_deductions.php">Deduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home/home_income.php">Income</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../home/home_salary.php">Report</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#colins">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <br><br>



    <?php
    $id = $_REQUEST['acc_info_id'];
    $query = "SELECT * FROM account_info JOIN employee ON account_info.employee_id = employee.emp_id WHERE acc_info_id='" . $id . "'";
    $result = mysqli_query($c, $query) or die(mysqli_error());

    $query_deductions = mysqli_query($c, "SELECT * FROM deductions");
    $row_deductions = mysqli_fetch_assoc($query_deductions);

    $query = mysqli_query($c, "SELECT * from overtime");
    while ($row = mysqli_fetch_array($query)) {
      $rate = $row['rate'];
    }
    $query = mysqli_query($c, "SELECT * from salary");
    while ($row = mysqli_fetch_array($query)) {
      $salary = $row['salary_rate'];
    }

    $total_gross_pay_query = mysqli_query($c, "SELECT * from account_info JOIN employee ON account_info.employee_id = employee.emp_id WHERE acc_info_id='" . $id . "'");
    while ($total_gross_pay_row = mysqli_fetch_array($total_gross_pay_query)) {
      $total_gross_pay = $total_gross_pay_row['total_gross_pay'];
    }

    

    $philhealth_deductions_query = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 1");
    while ($philhealth_row = mysqli_fetch_array($philhealth_deductions_query)) {
      $philhealth = ($total_gross_pay * ($philhealth_row['deduction_percent']/100))/2;
    }

    $gsis_deductions_query = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 3");
    while ($gsis_row = mysqli_fetch_array($gsis_deductions_query)) {
      $gsis = ($total_gross_pay * ($gsis_row['deduction_percent']/100))/2;
    }

    $pagibig_deductions_query = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 4");
    while ($pagibig_row = mysqli_fetch_array($pagibig_deductions_query)) {
      $pagibig = ($total_gross_pay * ($pagibig_row['deduction_percent']/100))/2;
    }

    $sss_deductions_query = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 5");
    while ($sss_row = mysqli_fetch_array($sss_deductions_query)) {
      $sss = ($total_gross_pay * ($sss_row['deduction_percent']/100))/2;
    }



    while ($row = mysqli_fetch_assoc($result)) {
      $overtime_hours = $row['overtime_hours'] * $rate;
      $bonus = $row['bonus'];
      $benefits_deduction = $row['benefits_deductions'];
      $total_gross_pay = $row['total_gross_pay'];
      $netpay = $row['total_net_pay'];


      ?>

      <form class="form-horizontal" action="../update/update_account.php" method="post" name="form">
        <input type="hidden" name="new" value="1" />
        <input name="id" type="hidden" value="<?php echo $row['acc_info_id']; ?>" />
        <div class="form-group">
          <label class="col-sm-5 control-label"></label>
          <div class="col-sm-4">
            <h2>
              <?php echo $row['lname']; ?>,
              <?php echo $row['fname']; ?>
            </h2>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-5 control-label">Deductions:</label>
          <div class="col-sm-4">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="deduction_selected[]"
                value="<?php echo $philhealth_p; ?>" >
              <label class="form-check-label" for="deduction_philhealth" style="padding-left:6%">PhilHealth (<?php echo $philhealth; ?>)</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="deduction_selected[]" value="<?php echo $GSIS_p; ?>"
                >
              <label class="form-check-label" for="deduction_gsis" style="padding-left:6%">GSIS (<?php echo $gsis; ?>)</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="deduction_selected[]" value="<?php echo $PAGIBIG_p; ?>"
                >
              <label class="form-check-label" for="deduction_pagibig" style="padding-left:6%">PAG-IBIG (<?php echo $pagibig; ?>)</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="deduction_selected[]" value="<?php echo $SSS_p; ?>"
                >
              <label class="form-check-label" for="deduction_pagibig" style="padding-left:6%">SSS (<?php echo $sss; ?>)</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-5 control-label">Overtime :</label>
          <div class="col-sm-4">
            <input type="text" name="overtime" class="form-control" value="<?php echo $row['overtime_hours']; ?>"
              required="required">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-5 control-label">Bonus :</label>
          <div class="col-sm-4">
            <input type="text" name="bonus" class="form-control" value="<?php echo $row['bonus']; ?>" required="required">
          </div>
        </div><br><br>

        <div class="form-group">
          <label class="col-sm-5 control-label">Current Netpay :</label>
          <div class="col-sm-4">
            <?php echo $netpay; ?>
          </div>
        </div><br><br>
        <div class="form-group">
          <label class="col-sm-5 control-label"></label>
          <div class="col-sm-4">
            <input type="submit" name="submit" value="Update" class="btn btn-danger">
            <a href="../home/home_income.php" class="btn btn-primary">Cancel</a>
          </div>
        </div>
      </form>
      <?php
    }
    ?>

    <!-- this modal is for my Colins -->
    <div class="modal fade" id="colins" role="dialog">
      <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:20px 50px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            <h3 align="center">You are logged in as <b>
                <?php echo $_SESSION['username']; ?>
              </b></h3>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
            <div align="center">
              <a href="../logout.php" class="btn btn-block btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/search.js"></script>
  <script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/dataTables.min.js"></script>

  <!-- FOR DataTable -->
  <script>
    {
      $(document).ready(function () {
        $('#myTable').DataTable();
      });
    }
  </script>

  <!-- this function is for modal -->
  <script>
    $(document).ready(function () {
      $("#myBtn").click(function () {
        $("#myModal").modal();
      });
    });
  </script>

</body>

</html>