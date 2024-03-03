<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) && !empty($_POST['employee']) && !empty($_POST['date']) && !empty($_POST['status'])) {
  $selected_employee = $_POST['employee'];
  $date = $_POST['date'];
  $status = $_POST['status'];

  // Check if attendance already exists for the selected employee on the chosen date
  $check_query = mysqli_query($conn, "SELECT * FROM attendance WHERE employee_id='$selected_employee' AND date='$date'");
  if (mysqli_num_rows($check_query) > 0) {
    ?>
    <script>
      alert('Attendance on chosen date already exists.');
      window.location.href = '../home/home_attendance.php?page=emp_list';
    </script>
    <?php
    exit; // Stop further execution
  }

  // Check if selected date is a Sunday
  $day_of_week = date('w', strtotime($date)); // 0 (for Sunday) through 6 (for Saturday)
  if ($day_of_week == 0) {
    ?>
    <script>
      alert('Chosen date is not a work day.');
      window.location.href = '../home/home_attendance.php?page=emp_list';
    </script>
    <?php
    exit; // Stop further execution
  }

  // If attendance can be added, insert the record
  $sql = mysqli_query($conn, "INSERT into attendance(employee_id, date, status) VALUES('$selected_employee','$date','$status')");

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