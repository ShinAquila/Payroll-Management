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

  // If employee doesn't exist, insert the record
  $sql = mysqli_query($conn, "INSERT into employee(lname, fname, gender, email, dept) VALUES('$lname','$fname','$gender', '$email', '$selected_dept_id')");

  if ($sql) {
    ?>
    <script>
      alert('Employee had been successfully added.');
      window.location.href = '../home/home_employee.php?page=emp_list';
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