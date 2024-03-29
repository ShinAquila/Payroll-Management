<?php
include("../auth.php"); //include auth.php file on all secure pages

?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
$query = mysqli_query($conn, "SELECT * from overtime");
while ($row = mysqli_fetch_array($query)) {
  @$rate = $row['rate'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description">

  <title>Pixel Foundry - Report</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    .circular-button {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      border: none;
      cursor: pointer;
      margin-left: 10px;
    }

    .circular-button:hover {
      background-color: #0056b3;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .card-footer {
      border-bottom-left-radius: 15px;
      border-bottom-right-radius: 15px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
      /* Light gray */
    }

    .table-striped tbody tr:nth-of-type(even) {
      background-color: #e9ecef;
      /* Darker gray */
    }

    .bg-dark {
      background-color: #343a40 !important;
      /* Dark gray */
    }

    .text-white {
      color: #ffffff !important;
      /* White */
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
          <li class="nav-item">
            <a class="nav-link" href="home_history.php">History</a>
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
    <div class="card">
      <div class="card-header bg-dark text-white">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Employee Salary Report</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed" id="myTable" style="width: 99%">
            <thead>
              <tr class="bg-secondary text-white">
                <th>Name</th>
                <th>Start Pay Period</th>
                <th>End Pay Period</th>
                <th>Gross Pay</th>
                <th>Deductions</th>
                <th>Net Pay</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($conn, "SELECT * from account_info JOIN employee ON account_info.employee_id = employee.emp_id");
              while ($row = mysqli_fetch_array($query)) {
                $lname = $row['lname'];
                $fname = $row['fname'];
                $benefits_deductions = $row['benefits_deductions'];
                $tax_deductions = $row['tax_deductions'];
                $total_deductions = $row['total_deductions'];
                $acc_info_id = $row['acc_info_id'];
                $total_gross_pay = $row['total_gross_pay'];
                $total_net_pay = $row['total_net_pay'];
                ?>
                <tr>
                  <td>
                    <?php echo $lname . ", " . $fname; ?>
                  </td>
                  <td>
                    <?php echo $row['start_pay_period']; ?>
                  </td>
                  <td>
                    <?php echo $row['end_pay_period']; ?>
                  </td>
                  <td><big><b>
                        <?php echo $total_gross_pay; ?>
                      </b></big></td>
                  <td style="position:relative; display:flex; justify-content: center;">
                    <big><b>
                        <?php echo $total_deductions; ?>
                      </b></big>
                    <i style="position: absolute; right: 1rem; margin-block: 1%; color: #2d76c4; cursor: pointer; font-size:2rem"
                      class="fa-solid fa-circle-info" data-toggle="modal"
                      data-target="#deduction_details_<?php echo $acc_info_id ?>"></i>
                  </td>
                  <td><big><b>
                        <?php echo $total_net_pay; ?>
                      </b></big></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Benefits Details Modal -->
  <?php
  $query = mysqli_query($conn, "SELECT * FROM employee JOIN account_info ON employee.emp_id=account_info.employee_id ORDER BY emp_id ASC") or die(mysqli_error());
  while ($row = mysqli_fetch_array($query)) {
    $has_philhealth = $row['has_philhealth'];
    $has_gsis = $row['has_gsis'];
    $has_pagibig = $row['has_pagibig'];
    $has_sss = $row['has_sss'];
    $benefits_deductions = $row['benefits_deductions'];
    $tax_deductions = $row['tax_deductions'];
    $total_deductions = $row['total_deductions'];
    ?>
    <div class="modal fade" id="deduction_details_<?php echo $row['acc_info_id'] ?>" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Benefits Details</b></h3>
          <div class="modal-body" style="padding:20px 30px;">

            <div style="text-align: center;">
              <label class="" for="benefits">Selected Benefits</label>
              <div class="modal-body">

                <span id="benefits">
                  <?php
                  if ($has_philhealth == 1) {
                    echo "<div>Philhealth</div>";
                  }
                  if ($has_gsis == 1) {
                    echo "<div>GSIS</div>";
                  }
                  if ($has_pagibig == 1) {
                    echo "<div>PAG-IBIG</div>";
                  }
                  if ($has_sss == 1) {
                    echo "<div>SSS</div>";
                  }
                  ?>
                </span>
              </div>
              <div class="form-group s" style="margin-left: 5%;">
                <label class="" for="benefits">Total Benefits:</label>
                <span id="benefits">
                  <?php echo $benefits_deductions; ?>
                </span>
              </div>

              <div class="form-group">
                <label class="" for="tax">Tax:</label>
                <span id="tax">
                  <?php echo $tax_deductions; ?>
                </span>
              </div>

              <div class="form-group">
                <h3><b>Total</b></h3>
                <!-- <label class="" for="total_deductions">Total:</label> -->
                <span id="total_deductions">
                  <?php echo $total_deductions; ?>
                </span>
              </div>
            </div>


          </div>

        </div>
      </div>

    </div>
  <?php } ?>



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