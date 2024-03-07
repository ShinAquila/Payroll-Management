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

$query1 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $philhealth_id = $row['deduction_id'];
  $philhealth_p = $row['deduction_percent'];
}

$query3 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
  $gsis_id = $row['deduction_id'];
  $GSIS_p = $row['deduction_percent'];
}

$query4 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
  $pagibig_id = $row['deduction_id'];
  $PAGIBIG_p = $row['deduction_percent'];
}

$query5 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
  $sss_id = $row['deduction_id'];
  $SSS_p = $row['deduction_percent'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selected_deductions = $_POST['deduction_selected'];
  // echo "Selected Deductions: " . implode(", ", $selected_deductions);

  if (in_array($philhealth_id, $selected_deductions)) {
    $has_philhealth = "1";
  } else {
    $has_philhealth = "0";
  }

  if (in_array($gsis_id, $selected_deductions)) {
    $has_gsis = "1";
  } else {
    $has_gsis = "0";
  }

  if (in_array($pagibig_id, $selected_deductions)) {
    $has_pagibig = "1";
  } else {
    $has_pagibig = "0";
  }

  if (in_array($sss_id, $selected_deductions)) {
    $has_sss = "1";
  } else {
    $has_sss = "0";
  }
}

$sql = mysqli_query($c, "UPDATE employee SET lname='$lname', fname='$fname', gender='$gender', email='$email', dept='$selected_dept', has_philhealth='$has_philhealth', has_gsis='$has_gsis', has_pagibig='$has_pagibig', has_sss='$has_sss' WHERE emp_id='$id'");

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
