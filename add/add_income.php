<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) != "") {
  $selected_employee = $_POST['employee'];
  $start_pay_period = $_POST['start_pay_period'];
  $end_pay_period = $_POST['end_pay_period'];

  $days_full_day_query = mysqli_query($conn, "SELECT COUNT(*) AS full_count
  FROM attendance a
  JOIN employee e ON a.employee_id = e.emp_id
  WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
    AND a.status = 'FULL DAY'
  GROUP BY e.emp_id;
  ");
  $days_full_day = mysqli_fetch_assoc($days_full_day_query)['full_count'];

  $days_half_day_query = mysqli_query($conn, "SELECT COUNT(*) AS half_count 
  FROM attendance a
  JOIN employee e ON a.employee_id = e.emp_id
  WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
    AND a.status = 'HALF DAY'
  GROUP BY e.emp_id;
  ");
  $days_half_day = mysqli_fetch_assoc($days_half_day_query)['half_count'];

  $days_absent_query = mysqli_query($conn, "SELECT COUNT(*) AS absent_count
  FROM attendance a
  JOIN employee e ON a.employee_id = e.emp_id
  WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
    AND a.status = 'ABSENT'
  GROUP BY e.emp_id;
  ");
  $days_absent = mysqli_fetch_assoc($days_absent_query)['absent_count'];

  $overtime_query = mysqli_query($conn, "SELECT * FROM overtime WHERE ot_id='1'");
  $overtime_row = mysqli_fetch_assoc($overtime_query);
  $overtime_hours = $_POST['overtime_hours'];
  $overtime = $overtime_hours * $overtime_row['rate'];

  $bonus = $_POST['bonus'];

  $salary_query = mysqli_query($conn, "SELECT * FROM salary WHERE salary_id='1'");
  $salary_row = mysqli_fetch_assoc($salary_query);
  $salary_rate = $salary_row['salary_rate'];

  $total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $bonus + $overtime;

  $sql = mysqli_query($conn, "INSERT INTO account_info(employee_id, days_full_day, days_half_day, days_absent, overtime_hours, bonus, start_pay_period, end_pay_period, total_gross_pay)VALUES('$selected_employee', '$days_full_day','$days_half_day','$days_absent','$overtime_hours','$bonus', '$start_pay_period', '$end_pay_period','$total_gross_pay')");

  if ($sql) {

  } else {

  }
}
?>