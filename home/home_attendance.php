<?php
include("../auth.php"); //include auth.php file on all secure pages
include("../add/add_attendance.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">

    <title>Pixel Foundry - Attendance</title>
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
                    <li class="nav-item active">
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
        <div class="card" style="width: 90%; margin: 0 auto;">
            <div class="card-header bg-dark text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List of Attendance</h5>
                    <button type="button" data-toggle="modal" data-target="#addAttendance" class="btn btn-success">Add
                        New</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed" id="myTable" style="width: 99%">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Overtime (hrs)</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'payroll');
                            if (!$conn) {
                                die("Database Connection Failed" . mysqli_error());
                            }

                            $query = mysqli_query($conn, "SELECT * from attendance JOIN employee ON attendance.employee_id = employee.emp_id ORDER BY 'date' ASC") or die(mysqli_error());
                            while ($row = mysqli_fetch_array($query)) {
                                $lname = $row['lname'];
                                $fname = $row['fname'];
                                $date = $row['date'];
                                $overtime_hrs = $row['overtime_hrs'];
                                $status = $row['status'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['lname'] . ", " . $row['fname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $date ?>
                                    </td>
                                    <td>
                                        <?php echo $status ?>
                                    </td>
                                    <td>
                                        <?php echo $overtime_hrs ?>
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#update_attendance_<?php echo $row["attendance_id"]; ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete_attendance_<?php echo $row["attendance_id"]; ?>">
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





        <!-- this modal is for ADDING an attendance -->
        <div class="modal fade" id="addAttendance" role="dialog">
            <div class="modal-dialog" style="max-width: 400px;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:7px 20px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <h3 class="modal-title" align="center" style="padding:10px"><b>Add Attendance</b></h3>
                    <div class="modal-body" style="padding:20px 30px;">
                        <form class="form-horizontal" action="#" name="form" method="post">
                            <div class="form-group">
                                <label>Employee</label>
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
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Date"
                                    required="required">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" placeholder="Status" required>
                                    <option value="">Status</option>
                                    <option value="FULL DAY">FULL DAY</option>
                                    <option value="HALF DAY">HALF DAY</option>
                                    <option value="ABSENT">ABSENT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Overtime (hrs)</label>
                                <input type="text" name="overtime_hrs" class="form-control" placeholder="Overtime (hrs)"
                                    required="required">
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


        <!-- Update attendance Modals -->
        <?php
        $query = mysqli_query($conn, "SELECT * from attendance JOIN employee ON attendance.employee_id = employee.emp_id ORDER BY date asc") or die(mysqli_error());
        while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="modal fade" id="update_attendance_<?php echo $row["attendance_id"]; ?>" role="dialog">
                <div class="modal-dialog" style="max-width: 400px;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:7px 20px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <h3 class="modal-title" align="center" style="padding:10px"><b>Edit Attendance</b></h3>
                        <h3 align="center">
                            <?php echo $row['lname']; ?>,
                            <?php echo $row['fname']; ?>
                        </h3>
                        <div class="modal-body" style="padding:20px 30px;">

                            <form action="../update/update_attendance.php" method="post">
                                <input type="hidden" name="new" value="1" />
                                <input type="hidden" name="id" value="<?php echo $row['attendance_id']; ?>" />
                                <div class="form-group">
                                    <label>Date :</label>
                                    <input type="date" name="date" class="form-control" value="<?php echo $row['date']; ?>"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <label>Status :</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="FULL DAY" <?php if ($row['status'] == 'FULL DAY')
                                            echo 'selected'; ?>>FULL DAY</option>
                                        <option value="HALF DAY" <?php if ($row['status'] == 'HALF DAY')
                                            echo 'selected'; ?>>HALF DAY</option>
                                        <option value="ABSENT" <?php if ($row['status'] == 'ABSENT')
                                            echo 'selected'; ?>>ABSENT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Overtime (hrs)</label>
                                    <input type="text" name="overtime_hrs" class="form-control"
                                        value="<?php echo $row['overtime_hrs']; ?>" required="required">
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <!-- Delete attendance Modals -->
        <?php
        $query = mysqli_query($conn, "SELECT * from attendance JOIN employee ON attendance.employee_id = employee.emp_id ORDER BY date asc") or die(mysqli_error());
        while ($row = mysqli_fetch_array($query)) {
            ?>

            <div class="modal fade" id="delete_attendance_<?php echo $row["attendance_id"]; ?>" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:7px 20px;">
                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                        </div>

                        <h3 class="modal-title" align="center" style="padding:10px"><b>Delete Attendance</b></h3>
                        <div class="modal-body">
                            <p align="center">You are about to delete:</p>
                            <p align="center">The
                                <?php echo $row["date"]; ?> attendance of
                            </p>
                            <p align="center">
                                <?php echo $row['lname'] . ', ' . $row['fname']; ?>
                            </p>
                            <p align="center" style="padding:20px">Are you sure you want to proceed?</p>
                            <div align="center">
                                <a class="btn btn-danger"
                                    href="../delete/delete_attendance.php?attendance_id=<?php echo $row["attendance_id"]; ?>">Delete</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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