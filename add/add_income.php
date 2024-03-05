<?php
function addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period)
{
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

  $work_days = $days_full_day + $days_half_day + $days_absent;

  if ($work_days == 0) {
    ?>
    <script>
      alert('Employee does not have an attendance on that period.');
      window.location.href = '../home/home_income.php';
    </script>
    <?php
  } else {
    // Query to get total overtime hours for the specified employee within the pay period
    $overtime_query = mysqli_query($conn, "SELECT SUM(overtime_hrs) AS total_overtime_hours 
    FROM attendance 
    WHERE date BETWEEN '$start_pay_period' AND '$end_pay_period' 
    AND employee_id = '$selected_employee'");
    $overtime_row = mysqli_fetch_assoc($overtime_query);
    $total_overtime_hours = isset($overtime_row['total_overtime_hours']) ? $overtime_row['total_overtime_hours'] : 0;


    // Query to get the overtime rate (assuming it's a fixed rate for all overtime hours)
    $overtime_rate_query = mysqli_query($conn, "SELECT rate FROM overtime WHERE ot_id='1'");
    $overtime_rate_row = mysqli_fetch_assoc($overtime_rate_query);
    $overtime_rate = $overtime_rate_row['rate'];

    // Calculate the total overtime pay
    $overtime = $total_overtime_hours * $overtime_rate;


    $bonus = $_POST['bonus'];

    $salary_query = mysqli_query($conn, "SELECT * FROM department JOIN employee ON department.dept_id=employee.dept WHERE emp_id='$selected_employee'");
    $salary_row = mysqli_fetch_assoc($salary_query);
    $salary_rate = $salary_row['dept_salary_rate'];

    $total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $bonus + $overtime;

    $sql = mysqli_query($conn, "INSERT INTO account_info(employee_id, days_full_day, days_half_day, days_absent, total_overtime_hours, bonus, start_pay_period, end_pay_period, total_gross_pay)VALUES('$selected_employee', '$days_full_day','$days_half_day','$days_absent','$total_overtime_hours','$bonus', '$start_pay_period', '$end_pay_period','$total_gross_pay')");

    return $sql;
  }
}

$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
  die("Database Connection Failed" . mysqli_error());
}

if (isset($_POST['submit']) != "") {
  $selected_employee = $_POST['employee'];
  $start_pay_period = $_POST['start_pay_period'];
  $end_pay_period = $_POST['end_pay_period'];

  $start_day = (int) substr($start_pay_period, -2);
  $end_day = (int) substr($end_pay_period, -2);

  if ($start_day != 1 || $end_day != 15) {
    if ($start_day != 16 || $end_day < 28) {
      if ($start_day != 1 || $end_day < 28) {
        ?>
        <script>
          alert('Selected date is not enough to be a Monthly Pay');
          window.location.href = '../home/home_income.php';
        </script>
        <?php
      } else if ($start_day == 1 || $end_day > 28) {
        $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

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
    } else if ($start_day == 16 || $end_day >= 28) {
      $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

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
    ?>
    <script>
      alert('Selected date is not enough to be a 15 Day Pay');
      window.location.href = '../home/home_income.php';
    </script>
    <?php
  } else if ($start_day == 1 || $end_day == 15) {
    $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

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