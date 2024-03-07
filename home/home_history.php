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

  <title>Pixel Foundry - History</title>
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
          <li class="nav-item">
            <a class="nav-link" href="home_salary.php">Report</a>
          </li>
          <li class="nav-item active">
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
          <h5 class="card-title mb-0">Salary History</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed" id="myTable" style="width: 99%">
            <thead>
              <tr class="bg-secondary text-white">
                <th>Name</th>
                <th>Employee Details</th>

                <th>Start Pay Period</th>
                <th>End Pay Period</th>

                <th>Salary Details</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($conn, "SELECT * from salary_history");
              while ($row = mysqli_fetch_array($query)) {
                $lname = $row['last_name'];
                $fname = $row['first_name'];
                ?>
                <tr>
                  <td>
                    <?php echo $lname . ", " . $fname; ?>
                  </td>

                  <td align="center">
                    <i style="margin-block: 1%; color: #2d76c4; cursor: pointer; font-size:2rem"
                      class="fa-solid fa-circle-info" data-toggle="modal"
                      data-target="#employee_details_<?php echo $row['history_id'] ?>"></i>
                  </td>

                  <td>
                    <?php echo $row['start_pay_period']; ?>
                  </td>
                  <td>
                    <?php echo $row['end_pay_period']; ?>
                  </td>

                  <td align="center">
                    <i style="margin-block: 1%; color: #2d76c4; cursor: pointer; font-size:2rem"
                      class="fa-solid fa-circle-info" data-toggle="modal"
                      data-target="#salary_details_<?php echo $row['history_id'] ?>"></i>
                  </td>

                  <td align="center">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                      data-target="#delete_history_<?php echo $row["history_id"]; ?>">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Delete History Modals -->
  <?php
  $query1 = mysqli_query($conn, "SELECT * FROM salary_history") or die(mysqli_error());
  while ($row = mysqli_fetch_array($query1)) {
    ?>
    <div class="modal fade" id="delete_history_<?php echo $row["history_id"]; ?>" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Delete History</b></h3>
          <div class="modal-body">
            <p align="center">You are about to delete this history of:</p>
            <p align="center">
              <?php echo $row['last_name'] . ', ' . $row['first_name']; ?>
            </p>
            <p align="center" style="padding:20px">Are you sure you want to proceed?</p>
            <div align="center">
              <a href="../delete/delete_history.php?history_id=<?php echo $row["history_id"]; ?>" class="btn btn-danger">Delete</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <!-- Employee Details Modal -->
  <?php
  $query = mysqli_query($conn, "SELECT * FROM salary_history") or die(mysqli_error());
  while ($row = mysqli_fetch_array($query)) {
    ?>
    <div class="modal fade" id="employee_details_<?php echo $row['history_id'] ?>" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Employee Details</b></h3>
          <div class="modal-body" style="padding:20px 30px;">

            <div class="form-group">
              <label for="lname">Last Name:</label>
              <input type="text" disabled class="form-control" id="lname" name="lname"
                value="<?php echo $row['last_name']; ?>" required>
            </div>
            <div class="form-group">
              <label for="fname">First Name:</label>
              <input type="text" disabled class="form-control" id="fname" name="fname"
                value="<?php echo $row['first_name']; ?>" required>
            </div>
            <div class="form-group">
              <label for="dept">Department:</label>
              <input type="text" disabled class="form-control" id="dept" name="dept"
                value="<?php echo $row['department']; ?>" required>
            </div>
            <div class="form-group">
              <label for="salary">Salary:</label>
              <input type="text" disabled class="form-control" id="salary" name="salary"
                value="<?php echo $row['salary']; ?>" required>
            </div>
            <div class="form-group">
              <label for="overtime_hours">Total Overtime Hours:</label>
              <input type="text" disabled class="form-control" id="overtime_hours" name="overtime_hours"
                value="<?php echo $row['overtime_hours']; ?>" required>
            </div>


          </div>

        </div>
      </div>

    </div>
  <?php } ?>

  <!-- Salary Details Modal -->
  <?php
  $query = mysqli_query($conn, "SELECT * FROM salary_history") or die(mysqli_error());
  while ($row = mysqli_fetch_array($query)) {
    ?>
    <div class="modal fade" id="salary_details_<?php echo $row['history_id'] ?>" role="dialog">
      <div class="modal-dialog" style="max-width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="padding:7px 20px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <h3 class="modal-title" align="center" style="padding:10px"><b>Salary Details</b></h3>
          <div class="modal-body" style="padding:20px 30px;">

            <div class="form-group">
              <label for="total_benefits">Total Benefits Deduction:</label>
              <input type="text" disabled class="form-control" id="total_benefits" name="total_benefits"
                value="<?php echo $row['total_benefits_deductions']; ?>" required>
            </div>
            <div class="form-group">
              <label for="total_tax">Total Tax Deduction:</label>
              <input type="text" disabled class="form-control" id="total_tax" name="total_tax"
                value="<?php echo $row['total_tax_deductions']; ?>" required>
            </div>
            <div class="form-group">
              <label for="total_deduction">Total Deduction:</label>
              <input type="text" disabled class="form-control" id="total_deduction" name="total_deduction"
                value="<?php echo $row['total_deductions']; ?>" required>
            </div>
            <div class="form-group">
              <label for="total_gross">Total Gross Pay:</label>
              <input type="text" disabled class="form-control" id="total_gross" name="total_gross"
                value="<?php echo $row['total_gross_pay']; ?>" required>
            </div>
            <div class="form-group">
              <label for="total_net">Total Net Pay:</label>
              <input type="text" disabled class="form-control" id="total_net" name="total_net"
                value="<?php echo $row['total_net_pay']; ?>" required>
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