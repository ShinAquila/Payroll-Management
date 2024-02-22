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

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pixel Foundry - Department</title>
    <link href="../assets/css/justified-nav.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/search.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.min.css">

</head>

<body>

    <div class="container">
        <div class="masthead">
            <h3>
                <b>Pixel Foundry</b><br>
                Welcome
                <?php echo $_SESSION['username']; ?>!<br><br>
                <b><a href="../index.php">Home</a></b>
                <a data-toggle="modal" href="#colins" class="pull-right"><b>
                        Logout
                    </b></a>
            </h3>
            <nav>
                <ul class="nav nav-justified">
                    <li>
                        <a href="home_employee.php">Employee</a>
                    </li>
                    <li class="active">
                        <a href="">Department</a>
                    </li>
                    <li>
                        <a href="home_deductions.php">Deduction</a>
                    </li>
                    <li>
                        <a href="home_salary.php">Income</a>
                    </li>
                </ul>
            </nav>
        </div>

        <br>
        <div class="well bs-component">
            <form class="form-horizontal">
                <fieldset>
                    <button type="button" data-toggle="modal" data-target="#addDepartment" class="btn btn-success">Add
                        New</button>
                    <p align="center"><big><b>List of Departments</b></big></p>
                    <div class="table-responsive">
                        <form method="post" action="">
                            <table class="table table-bordered table-hover table-condensed" id="myTable">
                                <!-- <h3><b>Ordinance</b></h3> -->
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



                                    $query = mysqli_query($conn, "select * from department ORDER BY dept_id asc") or die(mysqli_error());
                                    while ($row = mysqli_fetch_array($query)) {
                                        $dept_id = $row['dept_id'];
                                        $dept_name = $row['dept_name'];
                                        ?>

                                        <tr>
                                            <td align="center"><a
                                                    href="../view/view_department.php?dept_id=<?php echo $row["dept_id"]; ?>"
                                                    title="Update">
                                                    <?php echo $row['dept_name'] ?>
                                                </a></td>

                                            <td align="center">
                                                <a class="btn btn-primary"
                                                    href="../view/view_department.php?dept_id=<?php echo $row["dept_id"]; ?>">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="../delete/delete_department.php?dept_id=<?php echo $row["dept_id"]; ?>">Delete</a>
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

        <!-- this modal is for ADDING an EMPLOYEE -->
        <div class="modal fade" id="addDepartment" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:20px 50px;">
                        <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                        <h3 align="center"><b>Add Department</b></h3>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">

                        <form class="form-horizontal" action="#" name="form" method="post">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Department</label>
                                <div class="col-sm-8">
                                    <input type="text" name="dept_name" class="form-control" placeholder="Department"
                                        required="required">
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