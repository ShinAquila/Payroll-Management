<?php

include("../db.php");
include("../auth.php");

// Retrieve data from POST
$id = $_POST['id'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$gender = $_POST['gender'];
$selected_dept = $_POST['department'];
$email = $_POST['email'];

$sql = mysqli_query($c, "UPDATE employee SET lname='$lname', fname='$fname', gender='$gender', email='$email', dept='$selected_dept' WHERE emp_id='$id'");

if ($sql) {
  ?>
  <script>
    alert('Employee successfully updated.');
    window.location.href = '../home/home_employee.php';
  </script>
  <?php
} else {
  ?>
  <script>
    alert('Employee failed to update.');
    window.location.href = '../home/home_employee.php';
  </script>
  <?php
}

mysqli_close($c);
