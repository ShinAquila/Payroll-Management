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
                      </td>
                      <td align="center">
                        <?php echo $row['gender'] ?>
                      </td>
                      <td align="center">
                        <?php echo $row['email'] ?>
                      </td>
                      <td align="center">
                        <?php echo $row['dept_name'] ?>
                      </td>
                      <td align="center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                          data-target="#update_employee_<?php echo $row["emp_id"]; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#delete_employee_<?php echo $row["emp_id"]; ?>"><i class="fa-solid fa-trash"></i></button>
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

    <!-- Update Employee Modals -->
    <?php
    $query = mysqli_query($conn, "select * from employee JOIN department ON employee.dept = department.dept_id ORDER BY emp_id asc") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <div class="modal fade" id="update_employee_<?php echo $row["emp_id"]; ?>" role="dialog">
        <div class="modal-dialog" style="max-width: 400px;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:7px 20px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title" align="center" style="padding:10px"><b>Edit Employee</b></h3>
            <div class="modal-body" style="padding:20px 30px;">
              <form action="../update/update_employee.php" method="post">
                <input type="hidden" name="new" value="1" />
                <input type="hidden" name="id" value="<?php echo $row['emp_id']; ?>" />
                <div class="form-group">
                  <label for="lname">Last Name:</label>
                  <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row['lname']; ?>"
                    required>
                </div>
                <div class="form-group">
                  <label for="fname">First Name:</label>
                  <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['fname']; ?>"
                    required>
                </div>
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if ($row['gender'] == 'Male')
                      echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['gender'] == 'Female')
                      echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($row['gender'] == 'Other')
                      echo 'selected'; ?>>Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>"
                    required>
                </div>
                <div class="form-group">
                  <label for="department">Department:</label>
                  <select name="department" class="form-control" placeholder="Department" required>
                    <?php
                    require('../db.php');

                    $sql = "SELECT dept_id, dept_name FROM department";
                    $result = mysqli_query($c, $sql);

                    if (!$result) {
                      die("Error fetching departments: " . mysqli_error($c));
                    }

                    while ($dept_row = mysqli_fetch_assoc($result)) {
                      $selected = ($dept_row['dept_id'] == $row['dept_id']) ? 'selected' : '';
                      echo "<option value='" . $dept_row['dept_id'] . "' $selected>" . $dept_row['dept_name'] . "</option>";
                    }

                    mysqli_close($c);
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- Delete Employee Modals -->
    <?php
    $query = mysqli_query($conn, "select * from employee JOIN department ON employee.dept = department.dept_id ORDER BY emp_id asc") or die(mysqli_error());
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <div class="modal fade" id="delete_employee_<?php echo $row["emp_id"]; ?>" role="dialog">
        <div class="modal-dialog" style="max-width: 400px;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:7px 20px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title" align="center" style="padding:10px"><b>Delete Employee</b></h3>
            <div class="modal-body">
              <p align="center">You are about to delete:</p>
              <p align="center">
                <?php echo $row['lname'] . ', ' . $row['fname']; ?>
              </p>
              <p align="center" style="padding:20px">Are you sure you want to proceed?</p>
              <div align="center">
                <a href="../delete/delete.php?emp_id=<?php echo $row["emp_id"]; ?>" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <!-- this modal is for ADDING an EMPLOYEE -->
    <div class="modal fade" id="addEmployee" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Add Employee</b></h3>
          <div class="modal-body" style="padding:20px 30px;">
            <form action="#" name="form" method="post">
              <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required="required">
              </div>
              <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name" required="required">
              </div>
              <div class="form-group">
                <label>Gender:</label>
                <select name="gender" class="form-control" required>
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required="required">
              </div>
              <div class="form-group">
                <label>Department:</label>
                <select name="department" class="form-control" required>
                  <option value="">Select Department</option>
                  <?php
                  require('../db.php');
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
              <div class="form-group" align="center">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <button type="reset" name="" class="btn btn-danger">Clear Fields</button>
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