<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) && !empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email'])) {
  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $selected_dept_id = $_POST['department'];

  // Check if the employee already exists
  $check_query = mysqli_query($conn, "SELECT * FROM employee WHERE (lname='$lname' AND fname='$fname') OR email='$email'");
  if (mysqli_num_rows($check_query) > 0) {
    ?>
    <script>
      alert('Employee already exists.');
      window.location.href = '../home/home_employee.php?page=emp_list';
    </script>
    <?php
    exit; // Stop further execution
  }

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


  // If employee doesn't exist, insert the record
  $sql = mysqli_query($conn, "INSERT into employee(lname, fname, gender, email, dept, has_philhealth, has_gsis, has_pagibig, has_sss) VALUES('$lname','$fname','$gender', '$email', '$selected_dept_id','$has_philhealth','$has_gsis','$has_pagibig','$has_sss')");

  if ($sql) {
    ?>
    <script>
          alert('Employee had been successfully added.');
          window.location.href = '../home/home_employee.php';
    </script>
    <?php
  } else {
    ?>
    <script>
      alert('Invalid.');
      window.location.href = '../home/home_employee.php';
    </script>
    <?php
  }
}
?>