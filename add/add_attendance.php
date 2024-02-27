<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) != "") {
  $selected_employee = $_POST['employee'];
  $date = $_POST['date'];
  $status = $_POST['status'];

  $sql = mysqli_query($conn, "INSERT into attendance(employee_id, date, status)VALUES('$selected_employee','$date','$status')");

  if ($sql) {
    ?>
    <script>
      alert('Attendance had been successfully added.');
      window.location.href = '../home/home_attendance.php?page=emp_list';
    </script>
    <?php
  } else {
    ?>
    <script>
      alert('Invalid.');
      window.location.href = '../index.php';
    </script>
    <?php
  }
}
?>