<?php
include("../auth.php"); //include auth.php file on all secure pages

?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
$query = mysqli_query($conn, "SELECT * from overtime");
while ($row = mysqli_fetch_array($query)) {
  @$rate = $row['rate'];
}

$query = mysqli_query($conn, "SELECT * from salary");
while ($row = mysqli_fetch_array($query)) {
  @$salary = $row['salary_rate'];
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
      padding: 2%;
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
            <a class="nav-link" href="home_employee.php">Employee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home_attendance.php">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home_departments.php">Department</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home_deductions.php">Deduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home_income.php">Income</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="home_salary.php">Report</a>
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

    <br>
    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <p align="center"><big><b>Employee Salary Report</b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <table class="table table-bordered table-hover table-condensed" id="myTable">
                <!-- <h3><b>Ordinance</b></h3> -->
                <thead>
                  <tr class="info">
                    <th>
                      <p align="center">Name</p>
                    </th>
                    <th>
                      <p align="center">Start Pay Period</p>
                    </th>
                    <th>
                      <p align="center">End Pay Period</p>
                    </th>
                    <th>
                      <p align="center">Gross Pay</p>
                    </th>
                    <th>
                      <p align="center">Deductions</p>
                    </th>
                    <th>
                      <p align="center">Net Pay</p>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = mysqli_query($conn, "SELECT * from overtime");
                  while ($row = mysqli_fetch_array($query)) {
                    $rate = $row['rate'];
                  }

                  $query = mysqli_query($conn, "SELECT * from salary");
                  while ($row = mysqli_fetch_array($query)) {
                    $salary_rate = $row['salary_rate'];
                  }

                  $query = mysqli_query($conn, "SELECT * from account_info JOIN employee ON account_info.employee_id = employee.emp_id ");
                  while ($row = mysqli_fetch_array($query)) {
                    $lname = $row['lname'];
                    $fname = $row['fname'];
                    $benefits_deduction = $row['benefits_deduction'];
                    $overtime_hours = $row['overtime_hours'];
                    $bonus = $row['bonus'];


                    $total_gross_pay = $row['total_gross_pay'];
                    $total_net_pay = $row['total_net_pay'];

                    ?>

                    <tr>
                      <td align="center">
                        <?php echo $lname ?>,
                        <?php echo $fname ?>
                      </td>
                      <td align="center">
                        <?php echo $row['start_pay_period']; ?>
                      </td>
                      <td align="center">
                        <?php echo $row['end_pay_period']; ?>
                      </td>
                      <td align="center"><big><b>
                            <?php echo $total_gross_pay ?>
                          </b></big></td>
                      <td align="center"><big><b>
                            <?php echo $benefits_deduction ?>
                          </b></big>
                        <button type="button" data-toggle="modal" data-target="#deduction_details"
                          class="btn btn-primary">i
                      </td>
                      <td align="center"><big><b>
                            <?php echo $total_net_pay ?>
                          </b></big></td>
                    </tr>
                  <?php } ?>
                </tbody>

                <tr class="info">
                  <th>
                    <p align="center">Name</p>
                  </th>
                  <th>
                    <p align="center">Start Pay Period</p>
                  </th>
                  <th>
                    <p align="center">End Pay Period</p>
                  </th>
                  <th>
                    <p align="center">Gross Pay</p>
                  </th>
                  <th>
                    <p align="center">Deductions</p>
                  </th>
                  <th>
                    <p align="center">Net Pay</p>
                  </th>
                </tr>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- this modal is for deduction details -->
    <div class="modal fade" id="deduction_details" role="dialog">
      <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
          </div>
          <h3 align="center">Deduction Details</h3>
          <div class="modal-body" style="padding:40px 50px;">
            <div class="form-group">
              <label class="col-sm-4 control-label" style="margin-left: -20px;">PhilHealth</label>
              <div class="col-sm-8">
                <input style="margin-left: 20px;" disabled type="text" name="philhealth" class="form-control" required="required" value="test">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" style="margin-left: -20px;">GSIS</label>
              <div class="col-sm-8">
                <input style="margin-left: 20px;" disabled type="text" name="gsis" class="form-control" required="required" value="test">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" style="margin-left: -20px;">PAGIBIG</label>
              <div class="col-sm-8">
                <input style="margin-left: 20px;" disabled type="text" name="pagibig" class="form-control" required="required" value="test">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" style="margin-left: -20px;">SSS</label>
              <div class="col-sm-8">
                <input style="margin-left: 20px;" disabled type="text" name="sss" class="form-control" required="required" value="test">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" style="margin-left: -20px;">Tax</label>
              <div class="col-sm-8">
                <input style="margin-left: 20px;" disabled type="text" name="tax" class="form-control" required="required" value="test">
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>

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