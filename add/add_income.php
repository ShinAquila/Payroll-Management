<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) != "") {
  $selected_employee = $_POST['employee'];
  $start_pay_period = $_POST['start_pay_period'];
  $end_pay_period = $_POST['end_pay_period'];


  $work_day_query = mysqli_query($conn, "SELECT COUNT(*) AS work_count
  FROM attendance a
  JOIN employee e ON a.employee_id = e.emp_id
  WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
  AND DAYOFWEEK(a.date) != 1
  ");
  $work_day = mysqli_fetch_assoc($work_day_query)['work_count'];


  if ($work_day < 15) {
    ?>
    <script>
      alert('Selected date is not enough to be a 15 Day Pay');
      window.location.href = '../home/home_income.php';
    </script>
    <?php
  } else if ($work_day < 28) {
    ?>
    <script>
      alert('Selected date is not enough to be a 30 Day Pay');
      window.location.href = '../home/home_income.php';
    </script>
    <?php
  } else {
    $days_full_day_query = mysqli_query($conn, "SELECT COUNT(*) AS full_count
    FROM attendance a
    JOIN employee e ON a.employee_id = e.emp_id
    WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
      AND a.status = 'FULL DAY' AND emp_id='$selected_employee'
    GROUP BY e.emp_id;
    ");
    $days_full_day = mysqli_fetch_assoc($days_full_day_query)['full_count'];

    $days_half_day_query = mysqli_query($conn, "SELECT COUNT(*) AS half_count 
    FROM attendance a
    JOIN employee e ON a.employee_id = e.emp_id
    WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
      AND a.status = 'HALF DAY' AND emp_id='$selected_employee'
    GROUP BY e.emp_id;
    ");
    $days_half_day = mysqli_fetch_assoc($days_half_day_query)['half_count'];

    $days_absent_query = mysqli_query($conn, "SELECT COUNT(*) AS absent_count
    FROM attendance a
    JOIN employee e ON a.employee_id = e.emp_id
    WHERE a.date BETWEEN '$start_pay_period' AND '$end_pay_period'
      AND a.status = 'ABSENT' AND emp_id='$selected_employee'
    GROUP BY e.emp_id;
    ");
    $days_absent = mysqli_fetch_assoc($days_absent_query)['absent_count'];


    $overtime_query = mysqli_query($conn, "SELECT * FROM overtime WHERE ot_id='1'");
    $overtime_row = mysqli_fetch_assoc($overtime_query);
    $overtime_hours = $_POST['overtime_hours'];
    $overtime = $overtime_hours * $overtime_row['rate'];

    $bonus = $_POST['bonus'];

    $salary_query = mysqli_query($conn, "SELECT * FROM department JOIN employee ON department.dept_id=employee.dept WHERE emp_id='$selected_employee'");
    $salary_row = mysqli_fetch_assoc($salary_query);
    $salary_rate = $salary_row['dept_salary_rate'];


    $total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $bonus + $overtime;

    $sql = mysqli_query($conn, "INSERT INTO account_info(employee_id, days_full_day, days_half_day, days_absent, overtime_hours, bonus, start_pay_period, end_pay_period, total_gross_pay)VALUES('$selected_employee', '$days_full_day','$days_half_day','$days_absent','$overtime_hours','$bonus', '$start_pay_period', '$end_pay_period','$total_gross_pay')");

    if ($sql) {
      ?>
      <script>
        alert('Employee Income successfully added.');
        window.location.href = '../home/home_income.php';
      </script>
      <?php
    } else {
      ?>
      <script>
        alert('Employee Income failed to be added.');
        window.location.href = '../home/home_income.php';
      </script>
      <?php
    }
  }



}
?>