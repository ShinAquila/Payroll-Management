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
                      <td style="position:relative; display:flex; justify-content: center;">
                        <big><b>
                            <?php echo $total_deductions ?>
                          </b></big>
                          <i style="position: absolute; right: 1rem; margin-block: 1%; color: #2d76c4; cursor: pointer; font-size:2rem" class="fa-solid fa-circle-info" data-toggle="modal"
                          data-target="#deduction_details_<?php echo $acc_info_id ?>"></i>
                        <!-- <button style="float:right;" type="button" class="btn rounded-circle" ></button> -->
                      </td>
                      <td align="center"><big><b>
                            <?php echo $total_net_pay ?>
                          </b></big></td>
                    </tr>

                    <!-- Deduction Details Modal -->
                    <div  class=" modal fade" id="deduction_details_<?php echo $acc_info_id ?>" role="dialog">
                      <div class="modal-dialog modal-sm" style="min-width: 400px"> 
                        <div class="modal-content">
                          <div class="modal-header" style="padding:7px 20px;">
                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                          </div>
                          <h2 align="center"><b>Deduction Details</b></h3>
                          


                          <div class="modal-body" style="padding:40px 140px;">
                            <div style="position: relative;" class="form-group s">
                              <label class="" for="benefits">Benefits:</label>
                              <span style="position:absolute; right: 0;" id="benefits">
                                <?php echo $benefits_deductions; ?>
                              </span>
                            </div>

                            <div style="position: relative;" class="form-group">
                              <label class="" for="tax">Tax:</label>
                              <span style="position:absolute; right: 0;" id="tax">
                                <?php echo $tax_deductions; ?>
                              </span>
                            </div>

                            <div style="position: relative;" class="form-group">
                              <label class="" for="total_deductions">Total:</label>
                              <span style="position:absolute; right: 0;" id="total_deductions">
                                <?php echo $total_deductions; ?>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </tbody>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
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