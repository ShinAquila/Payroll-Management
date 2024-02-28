<?php
include("../auth.php"); //include auth.php file on all secure pages
include("../add/add_employee.php");
?>

<?php

$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}

$query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $id = $row['deduction_id'];
  $philhealth = $row['deduction_percent'];
}

$query3 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
  $id = $row['deduction_id'];
  $GSIS = $row['deduction_percent'];
}

$query4 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
  $id = $row['deduction_id'];
  $PAGIBIG = $row['deduction_percent'];
}

$query5 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
  $id = $row['deduction_id'];
  $SSS = $row['deduction_percent'];
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
          <li class="nav-item active">
            <a class="nav-link" href="home_deductions.php">Deduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home_income.php">Income</a>
          </li>
          <li class="nav-item">
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
    <br><br>

    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <button type="button" data-toggle="modal" data-target="#deductions" class="btn btn-success">Update</button>
          <p align="center"><big><b>List of Benefits</b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <table class="table table-bordered table-hover table-condensed" id="myTable">
                <thead>
                  <tr class="info">
                    <th>
                      <p align="center">Benefit Name</p>
                    </th>
                    <th>
                      <p align="center">Benefit Percent</p>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $conn = mysqli_connect('localhost', 'root', '', 'payroll');
                  if (!$conn) {
                    die("Database Connection Failed" . mysqli_error());
                  }

                  $query = mysqli_query($conn, "SELECT * FROM deductions ORDER BY deduction_id ASC") or die(mysqli_error());
                  while ($row = mysqli_fetch_array($query)) {
                    $deduction_id = $row['deduction_id'];
                    $deduction_name = $row['deduction_name'];
                    $deduction_percent = $row['deduction_percent'];
                    ?>

                    <tr>
                      <td align="center">
                        <?php echo $deduction_name ?>
                      </td>
                      <td align="center">
                        <?php echo $deduction_percent ?>%
                      </td>
                    </tr>

                  <?php } ?>
                </tbody>

                <tr class="info">
                  <th>
                    <p align="center">Benefit Name</p>
                  </th>
                  <th>
                    <p align="center">Benefit Percent</p>
                  </th>
                </tr>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
    </div>

    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <p align="center"><big><b>List of Taxes</b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <table class="table table-bordered table-hover table-condensed" id="myTable">
                <thead>
                  <tr class="info">
                    <th>
                      <p align="center">Tax Bracket</p>
                    </th>
                    <th>
                      <p align="center">Computation</p>
                    </th>
                    <th>
                      <p align="center">Formula</p>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 28,300</p>
                    </td>
                    <td align="center">
                      <p align="center">Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 20,833) * 0.15)</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 33,333</p>
                    </td>
                    <td align="center">
                      <p align="center">Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 33,333) * 0.20) + 1,875</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 66,667</p>
                    </td>
                    <td align="center">
                      <p align="center">Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 66,667) * 0.25) + 8,541.80</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 166,667</p>
                    </td>
                    <td align="center">
                      <p align="center">Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 166,667) * 0.30) + 33,541.80</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 666,667</p>
                    </td>
                    <td align="center">
                      <p align="center">Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 666,667) * 0.35) + 183,541.80</p>
                    </td>
                  </tr>

                  <tr>
                    <td align="center">
                      <p align="center"></p>
                    </td>
                    <td align="center">
                      <p align="center"></p>
                    </td>
                    <td align="center">
                      <p align="center"></p>
                    </td>

                  </tr>

                  <tr>
                    <td align="center">
                      <p align="center">≥ 10,417</p>
                    </td>
                    <td align="center">
                      <p align="center">Semi-Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 10,417) * 0.15)</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 16,667</p>
                    </td>
                    <td align="center">
                      <p align="center">Semi-Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 16,667) * 0.20) + 937.50</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 33,333</p>
                    </td>
                    <td align="center">
                      <p align="center">Semi-Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 33,333) * 0.25) + 4,270.70</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 83,333</p>
                    </td>
                    <td align="center">
                      <p align="center">Semi-Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 83,333) * 0.30) + 16,770.70</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <p align="center">≥ 333,333</p>
                    </td>
                    <td align="center">
                      <p align="center">Semi-Monthly</p>
                    </td>
                    <td align="center">
                      <p align="center">((Total Gross Pay - 333,333) * 0.35) + 91,770.70</p>
                    </td>
                  </tr>
                </tbody>
                <tr class="info">
                  <th>
                    <p align="center">Tax Bracket</p>
                  </th>
                  <th>
                    <p align="center">Computation</p>
                  </th>
                  <th>
                    <p align="center">Formula</p>
                  </th>
                </tr>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
    </div>



    <div class="modal fade" id="deductions" role="dialog">
      <div class="modal-dialog" style="max-width: 300px;">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px;"><b>Deduction</b></h3>
          <div class="modal-body" style="padding:40px 50px;">
            <form class="form-horizontal" action="../add/add_deductions.php" name="form" method="post">
              <div class="form-group">
                <label>PhilHealth</label>
                <input type="text" name="philhealth" class="form-control" required="required"
                  value="<?php echo $philhealth; ?>">
              </div>
              <div class="form-group">
                <label>GSIS</label>
                <input type="text" name="gsis" class="form-control" value="<?php echo $GSIS; ?>" required="required">
              </div>
              <div class="form-group">
                <label>PAG-IBIG</label>
                <input type="text" name="pag_ibig" class="form-control" value="<?php echo $PAGIBIG; ?>"
                  required="required">
              </div>
              <div class="form-group">
                <label>SSS</label>
                <input type="text" name="sss" class="form-control" value="<?php echo $SSS; ?>" required="required">
              </div>
              <div class="form-group text-center"> <!-- Added class for text-center -->
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
              </div>
            </form>
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