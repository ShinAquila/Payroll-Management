<?php
include("../auth.php"); //include auth.php file on all secure pages
include("../add/add_employee.php");

$query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $id = $row['deduction_id'];
  $philhealth = $row['deduction_percent'];
}

$query2 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 2");
while ($row = mysqli_fetch_array($query2)) {
  $id = $row['deduction_id'];
  $BIR = $row['deduction_percent'];
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
          <li class="nav-item active">
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
    <br>
    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <button type="button" data-toggle="modal" data-target="#addEmployee" class="btn btn-success">Add New</button>
          <p align="center"><big><b>List of Employees</b></big></p>
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
                      <p align="center">Gender</p>
                    </th>
                    <th>
                      <p align="center">Email</p>
                    </th>
                    <th>
                      <p align="center">Department</p>
                    </th>
                    <th>
                      <p align="center">Action</p>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $conn = mysqli_connect('localhost', 'root', '', 'payroll');
                  if (!$conn) {
                    die("Database Connection Failed" . mysqli_error());
                  }



                  $query = mysqli_query($conn, "select * from employee JOIN department ON employee.dept = department.dept_id ORDER BY emp_id asc") or die(mysqli_error());
                  while ($row = mysqli_fetch_array($query)) {
                    $id = $row['emp_id'];
                    $lname = $row['lname'];
                    $fname = $row['fname'];
                    $email = $row['email'];
                    $dept_id = $row['dept_id'];
                    $dept_name = $row['dept_name'];
                    ?>

                    <tr>
                      <td align="center">
                        <?php echo $row['lname'] ?>,
                        <?php echo $row['fname'] ?>
                        </a>
                      </td>
                      <td align="center">
                        <?php echo $row['gender'] ?>
                        </a>
                      </td>
                      <td align="center">
                        <?php echo $row['email'] ?>
                        </a>
                      </td>
                      <td align="center">
                        <?php echo $row['dept_name'] ?>
                        </a>
                      </td>
                      <td align="center">
                        <a class="btn btn-primary"
                          href="../view/view_employee.php?emp_id=<?php echo $row["emp_id"]; ?>">Edit</a>
                        <a class="btn btn-danger"
                          href="../delete/delete.php?emp_id=<?php echo $row["emp_id"]; ?>">Delete</a>
                      </td>
                    </tr>

                  <?php } ?>
                </tbody>

                <tr class="info">
                  <th>
                    <p align="center">Name</p>
                  </th>
                  <th>
                    <p align="center">Gender</p>
                  </th>
                  <th>
                    <p align="center">Email</p>
                  </th>
                  <th>
                    <p align="center">Department</p>
                  </th>
                  <th>
                    <p align="center">Action</p>
                  </th>
                </tr>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- this modal is for ADDING an EMPLOYEE -->
    <div class="modal fade" id="addEmployee" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
          </div>
          <h3 align="center"><b>Add Employee</b></h3>
          <div class="modal-body" style="padding:40px 50px;">

            <form class="form-horizontal" action="#" name="form" method="post">
              <div class="form-group">
                <label class="col-sm-4 control-label">Last Name</label>
                <div class="col-sm-8">
                  <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">First Name</label>
                <div class="col-sm-8">
                  <input type="text" name="fname" class="form-control" placeholder="First Name" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Gender</label>
                <div class="col-sm-8">
                  <select name="gender" class="form-control" placeholder="Gender" required>
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="text" name="email" class="form-control" placeholder="Email" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Department</label>
                <div class="col-sm-8">
                  <select name="department" class="form-control" placeholder="Department" required>
                    <option value="">Department</option>

                    <?php
                    require_once('../db.php');

                    $sql = "SELECT dept_id, dept_name FROM department";
                    $result = mysqli_query($c, $sql);

                    if (!$result) {
                      die("Error fetching departments: " . mysqli_error($c));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
                    }

                    mysqli_close($c);
                    ?>

                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                  <input type="submit" name="submit" class="btn btn-success" value="Submit">
                  <input type="reset" name="" class="btn btn-danger" value="Clear Fields">
                </div>
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