<?php
include("../auth.php"); //include auth.php file on all secure pages
include("../add/add_department.php");

$sql = mysqli_query($conn, "SELECT * from department");
while ($row = mysqli_fetch_array($sql)) {
    $dept_name = $row['dept_name'];
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item active">
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
                    <button type="button" data-toggle="modal" data-target="#addDepartment" class="btn btn-success">Add
                        New</button>
                    <p align="center"><big><b>List of Departments</b></big></p>
                    <p align="center">Please refer to HR regarding the creation and deletion of Departments</p>
                    <div class="table-responsive">
                        <form method="post" action="">
                            <table class="table table-bordered table-hover table-condensed" id="myTable">
                                <thead>
                                    <tr class="info">
                                        <th>
                                            <p align="center">Department Name</p>
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



                                    $query = mysqli_query($conn, "SELECT * from department WHERE NOT dept_id=0 ORDER BY dept_id asc") or die(mysqli_error());
                                    while ($row = mysqli_fetch_array($query)) {
                                        $dept_id = $row['dept_id'];
                                        $dept_name = $row['dept_name'];
                                    ?>

                                        <tr>
                                            <td align="center">
                                                <?php echo $row['dept_name'] ?>
                                            </td>

                                            <td align="center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_department_<?php echo $row["dept_id"]; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_department_<?php echo $row["dept_id"]; ?>"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <tr class="info">
                                    <th>
                                        <p align="center">Department Name</p>
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

        <!-- this modal is for ADDING a department -->
        <div class="modal fade" id="addDepartment" role="dialog">
            <div class="modal-dialog" style="max-width: 400px;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:7px 20px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <h3 class="modal-title" align="center" style="padding:10px"><b>Add Department</b></h3>
                    <div class="modal-body" style="padding:20px 30px;">
                        <form class="form-horizontal" action="#" name="form" method="post">
                            <div class="form-group">
                                <label>Department:</label>
                                <input type="text" name="dept_name" class="form-control" placeholder="Department" required="required">
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

        <!-- Update department Modals -->
        <?php
        $query = mysqli_query($conn, "SELECT * from department WHERE NOT dept_id=0 ORDER BY dept_id asc") or die(mysqli_error());
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="modal fade" id="update_department_<?php echo $row["dept_id"]; ?>" role="dialog">
                <div class="modal-dialog" style="max-width: 400px;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:7px 20px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <h3 class="modal-title" align="center" style="padding:10px"><b>Edit Department</b></h3>
                        <h3 align="center">
                            <?php echo $row['dept_name']; ?>
                        </h3>
                        <div class="modal-body" style="padding:20px 30px;">

                            <form action="../update/update_department.php" method="post">
                                <input type="hidden" name="new" value="1" />
                                <input type="hidden" name="id" value="<?php echo $row['dept_id']; ?>" />
                                <div class="form-group">
                                    <label>Department Name :</label>
                                    <input type="text" name="dept_name" class="form-control" value="<?php echo $row['dept_name']; ?>" required="required">
                                </div>
                                <div class="form-group" align="center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Delete department Modals -->
        <?php
        $query = mysqli_query($conn, "SELECT * from department WHERE NOT dept_id=0 ORDER BY dept_id asc") or die(mysqli_error());
        while ($row = mysqli_fetch_array($query)) {
        ?>

            <div class="modal fade" id="delete_department_<?php echo $row["dept_id"]; ?>" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:7px 20px;">
                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                        </div>

                        <h3 class="modal-title" align="center" style="padding:10px"><b>Delete Department</b></h3>
                        <div class="modal-body">
                            <p align="center">You are about to delete:</p>
                            <p align="center">
                                <?php echo $row['dept_name'] ?>
                            </p>
                            <p align="center" style="padding:20px">Are you sure you want to proceed?</p>
                            <div align="center">
                                <a class="btn btn-danger" href="../delete/delete_department.php?dept_id=<?php echo $row["dept_id"]; ?>">Delete</a>
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
        {
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        }
    </script>

    <!-- this function is for modal -->
    <script>
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal();
            });
        });
    </script>

</body>

</html>