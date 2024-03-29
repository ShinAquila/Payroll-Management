<?php
include("../auth.php"); //include auth.php file on all secure pages
include("../add/add_income.php");

$query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $id = $row['deduction_id'];
  $philhealth_id = $row['deduction_id'];
}

$query3 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
  $id = $row['deduction_id'];
  $gsis_id = $row['deduction_id'];
}

$query4 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
  $id = $row['deduction_id'];
  $pagibig_id = $row['deduction_id'];
}

$query5 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
  $id = $row['deduction_id'];
  $sss_id = $row['deduction_id'];
}



// $conn = mysqli_connect('localhost', 'root', '', 'payroll');
$query = mysqli_query($conn, "SELECT * from overtime");
while ($row = mysqli_fetch_array($query)) {
  @$rate = $row['rate'];
}

// $query = mysqli_query($conn, "SELECT * from salary");
// while ($row = mysqli_fetch_array($query)) {
//   @$salary = $row['salary_rate'];
// }
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

    .checkbox-label-padding {
      padding-left: 6%;
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
          <li class="nav-item active">
            <a class="nav-link" href="home_income.php">Income</a>
          </li>
          <li class="nav-item">
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
    <div class="card" style="width: 100%; ">
      <div class="card-header bg-dark text-white">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Employee Income Info</h5>
          <button type="button" data-toggle="modal" data-target="#overtime" class="btn btn-primary">Modify</button>

        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
          <button type="button" data-toggle="modal" data-target="#addAccountIncome" class="btn btn-success">Add
            New</button>

          <p class="mb-0">Overtime rate per hour: <big><b>
                <?php echo $rate; ?>.00
              </b></big></p>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed" id="myTable" style="width: 99%">
            <thead>
              <tr class="bg-secondary text-white">
                <th>Name</th>
                <th style="width: 60px">Start Pay Period</th>
                <th style="width: 60px">End Pay Period</th>
                <th style="width: 50px">Working Days</th>
                <th>Salary Rate</th>
                <th style="width: 30px">Overtime Hours</th>
                <th>Bonus</th>
                <th>Gross Pay</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $conn = mysqli_connect('localhost', 'root', '', 'payroll');
              if (!$conn) {
                die("Database Connection Failed" . mysqli_error());
              }

              $query = mysqli_query($conn, "SELECT * FROM employee JOIN account_info ON employee.emp_id = account_info.employee_id ORDER BY emp_id ASC") or die(mysqli_error());
              while ($row = mysqli_fetch_array($query)) {
                $lname = $row['lname'];
                $fname = $row['fname'];
                $total_overtime_hours = $row['total_overtime_hours'];
                $bonus = $row['bonus'];
                $total_gross_pay = $row['total_gross_pay'];
                $start_pay_period = $row['start_pay_period'];
                $end_pay_period = $row['end_pay_period'];

                $salary_query = mysqli_query($conn, "SELECT * FROM department JOIN employee ON department.dept_id=employee.dept WHERE employee.emp_id = $row[emp_id]");
                $salary_row = mysqli_fetch_assoc($salary_query);
                $salary_rate = $salary_row['dept_salary_rate'];
                ?>
                <tr>
                  <td>
                    <?php echo $row['lname'] ?>,
                    <?php echo $row['fname'] ?>
                  </td>
                  <td>
                    <?php echo $start_pay_period ?>
                  </td>
                  <td>
                    <?php echo $end_pay_period ?>
                  </td>
                  <td align="center">
                    <i style="margin-block: 1%; color: #2d76c4; cursor: pointer; font-size:2rem"
                      class="fa-solid fa-circle-info" data-toggle="modal"
                      data-target="#work_days_details_<?php echo $row['acc_info_id'] ?>"></i>
                  </td>
                  <td>
                    <?php echo $salary_rate ?>
                  </td>
                  <td>
                    <?php echo $total_overtime_hours ?>
                  </td>
                  <td>
                    <?php echo $bonus ?>
                  </td>
                  <td><b>
                      <?php echo $total_gross_pay ?>
                    </b></td>
                  <td align="center">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                      data-target="#update_income_<?php echo $row["acc_info_id"]; ?>"><i
                        class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#delete_income_<?php echo $row["acc_info_id"]; ?>"><i
                        class="fa-solid fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <!-- this modal is for ADDING an income -->
    <div class="modal fade" id="addAccountIncome" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Add Account Income</b></h3>
          <div class="modal-body" style="padding:20px 30px;">
            <form class="form-horizontal" action="#" name="form" method="post">
              <div class="form-group">
                <label>Employee:</label>
                <select name="employee" class="form-control" placeholder="Employee" required>
                  <option value="">Employee</option>

                  <?php
                  require('../db.php');

                  $sql = "SELECT emp_id, lname, fname FROM employee";
                  $result = mysqli_query($c, $sql);

                  if (!$result) {
                    die("Error fetching employees: " . mysqli_error($c));
                  }

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['emp_id'] . "'>" . $row['lname'], ", ", $row['fname'] . "</option>";
                  }

                  mysqli_close($c);
                  ?>

                </select>
              </div>
              <div class="form-group">
                <label>Start Pay Period</label>
                <input type="date" name="start_pay_period" class="form-control" placeholder="Start Pay Period"
                  required="required">
              </div>
              <div class="form-group">
                <label>End Pay Period</label>
                <input type="date" name="end_pay_period" class="form-control" placeholder="End Pay Period"
                  required="required">
              </div>
              <div class="form-group">
                <label>Bonus</label>
                <input type="text" name="bonus" class="form-control" placeholder="Bonus" required="required">
              </div>


              <div class="form-group" align="center">
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                <input type="reset" name="" class="btn btn-danger" value="Clear Fields">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Working Days Details Modal -->
    <?php
    $query = mysqli_query($conn, "SELECT * FROM employee JOIN account_info ON employee.emp_id = account_info.employee_id ORDER BY emp_id ASC") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query)) {
      $days_full_day = $row['days_full_day'];
      $days_half_day = $row['days_half_day'];
      $days_absent = $row['days_absent'];
      ?>
      <div class="modal fade" id="work_days_details_<?php echo $row['acc_info_id'] ?>" role="dialog">
        <div class="modal-dialog" style="max-width: 400px;">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:7px 20px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title" align="center" style="padding:10px"><b>Working Days Details</b></h3>
            <div class="modal-body" style="padding:20px 30px;">

              <div class="modal-body" style="padding:40px 90px;">
                <div style="position: relative;" class="form-group s">
                  <label class="" for="benefits">Days Full Day:</label>
                  <span style="position:absolute; right: 0;" id="benefits">
                    <?php echo $days_full_day; ?>
                  </span>
                </div>

                <div style="position: relative;" class="form-group">
                  <label class="" for="tax">Days Half Day:</label>
                  <span style="position:absolute; right: 0;" id="tax">
                    <?php echo $days_half_day; ?>
                  </span>
                </div>

                <div style="position: relative;" class="form-group">
                  <label class="" for="total_deductions">Days Absent:</label>
                  <span style="position:absolute; right: 0;" id="total_deductions">
                    <?php echo $days_absent; ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    <?php } ?>

    <!-- Update income Modals -->
    <?php
    $query = mysqli_query($conn, "SELECT * FROM employee JOIN account_info ON employee.emp_id = account_info.employee_id ORDER BY emp_id ASC") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <div class="modal fade" id="update_income_<?php echo $row["acc_info_id"]; ?>" role="dialog">
        <div class="modal-dialog" style="max-width: 400px;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:7px 20px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title" align="center" style="padding:10px"><b>Edit Account Income</b></h3>
            <h3 align="center">
              <?php echo $row['lname']; ?>,
              <?php echo $row['fname']; ?>
            </h3>
            <div class="modal-body" style="padding:20px 30px;">

              <form action="../update/update_account.php" method="post" name="form">
                <input type="hidden" name="new" value="1" />
                <input name="id" type="hidden" value="<?php echo $row['acc_info_id']; ?>" />


                <div class="form-group">
                  <label>Bonus</label>
                  <input type="text" name="bonus" class="form-control" value="<?php echo $row['bonus']; ?>"
                    required="required">
                </div><br>

                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>




    <!-- Delete account info Modals -->
    <?php
    $query = mysqli_query($conn, "SELECT * FROM employee JOIN account_info ON employee.emp_id = account_info.employee_id ORDER BY emp_id ASC") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query)) {
      ?>

      <div class="modal fade" id="delete_income_<?php echo $row["acc_info_id"]; ?>" role="dialog">
        <div class="modal-dialog modal-sm">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:7px 20px;">
              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            </div>

            <h3 class="modal-title" align="center" style="padding:10px"><b>Delete Income</b></h3>
            <div class="modal-body">
              <p align="center">You are about to delete:</p>
              <p align="center">The account info of</p>
              <p align="center">
                <?php echo $row['lname'] ?>,
                <?php echo $row['fname'] ?>
              </p>
              <p align="center" style="padding:20px">Are you sure you want to proceed?</p>
              <div align="center">
                <a class="btn btn-danger"
                  href="../delete/delete_income.php?acc_info_id=<?php echo $row["acc_info_id"]; ?>">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    <!-- this modal is for OVERTIME -->
    <div class="modal fade" id="overtime" role="dialog">
      <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
          </div>
          <h3 align="center">Enter the amount of <big><b>Overtime</b></big><br> rate per hour.</h3>
          <div class="modal-body" style="padding:40px 50px;">

            <form class="form-horizontal" action="../update/update_overtime.php" name="form" method="post">
              <div class="form-group">
                <input type="text" name="rate" class="form-control" value="<?php echo $rate; ?>" required="required">
              </div>

              <div class="form-group">
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
    $(document).ready(function () {
      $('#myTable').DataTable({
        "paging": true,
        "searching": true
      });
    });
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