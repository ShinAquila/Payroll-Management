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
    $last_name = $salary_row['lname'];
    $first_name = $salary_row['fname'];
    $department = $salary_row['dept_name'];

    $total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $bonus + $overtime;


    $benefits_check_query = mysqli_query($conn, "SELECT * from employee WHERE emp_id='$selected_employee'");
    while ($row = mysqli_fetch_array($benefits_check_query)) {
      $has_philhealth = $row['has_philhealth'];
      $has_gsis = $row['has_gsis'];
      $has_pagibig = $row['has_pagibig'];
      $has_sss = $row['has_sss'];
    }

    $query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id=1");
    while ($row = mysqli_fetch_array($query1)) {
      $philhealth_p = $row['deduction_percent'];
    }
    $query2 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id=3");
    while ($row = mysqli_fetch_array($query2)) {
      $gsis_p = $row['deduction_percent'];
    }
    $query3 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id=4");
    while ($row = mysqli_fetch_array($query3)) {
      $pagibig_p = $row['deduction_percent'];
    }
    $query4 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id=5");
    while ($row = mysqli_fetch_array($query4)) {
      $sss_p = $row['deduction_percent'];
    }





    $tax = 0;
    if ($work_days > 15) {
      if ($total_gross_pay >= 666667) {
        $tax = (($total_gross_pay - 666667) * 0.35) + 183541.80;
      } else if ($total_gross_pay >= 166667) {
        $tax = (($total_gross_pay - 166667) * 0.30) + 33541.80;
      } else if ($total_gross_pay >= 66667) {
        $tax = (($total_gross_pay - 66667) * 0.25) + 8541.80;
      } else if ($total_gross_pay >= 33333) {
        $tax = (($total_gross_pay - 33333) * 0.20) + 1875;
      } else if ($total_gross_pay >= 20833) {
        $tax = (($total_gross_pay - 20833) * 0.15);
      }
    } else if ($work_days <= 15) {
      if ($total_gross_pay >= 333333) {
        $tax = (($total_gross_pay - 333333) * 0.35) + 91770.70;
      } else if ($total_gross_pay >= 83333) {
        $tax = (($total_gross_pay - 83333) * 0.30) + 16770.70;
      } else if ($total_gross_pay >= 33333) {
        $tax = (($total_gross_pay - 33333) * 0.25) + 4270.70;
      } else if ($total_gross_pay >= 16667) {
        $tax = (($total_gross_pay - 16667) * 0.20) + 937.50;
      } else if ($total_gross_pay >= 10417) {
        $tax = (($total_gross_pay - 10417) * 0.15);
      }
    }

    // 

    $philhealth = 0;
    $GSIS = 0;
    $PAGIBIG = 0;
    $SSS = 0;
    $benefits_deduction = 0;


    if ($has_philhealth == 1) {
      $philhealth = ($total_gross_pay * ($philhealth_p / 100)) / 2;
      if ($work_days <= 15) {
        $philhealth = $philhealth / 2;
      }
      $benefits_deduction += $philhealth;
    }


    if ($has_gsis == 1) {
      $GSIS = ($total_gross_pay * ($gsis_p / 100)) / 2;
      if ($work_days <= 15) {
        $GSIS = $GSIS / 2;
      }
      $benefits_deduction += $GSIS;
    }

    if ($has_pagibig == 1) {
      $PAGIBIG = ($total_gross_pay * ($pagibig_p / 100)) / 2;
      if ($work_days <= 15) {
        $PAGIBIG = $PAGIBIG / 2;
      }
      $benefits_deduction += $PAGIBIG;
    }

    if ($has_sss == 1) {
      $SSS = ($total_gross_pay * ($sss_p / 100)) / 2;
      if ($work_days <= 15) {
        $SSS = $SSS / 2;
      }
      $benefits_deduction += $SSS;
    }

    $total_deduction = $benefits_deduction + $tax;
    $total_net_pay = $total_gross_pay - $total_deduction;



    $sql = mysqli_query($conn, "INSERT INTO account_info(employee_id, days_full_day, days_half_day, days_absent, total_overtime_hours, bonus, start_pay_period, end_pay_period, total_gross_pay, benefits_deductions, tax_deductions, total_deductions, total_net_pay)VALUES('$selected_employee', '$days_full_day','$days_half_day','$days_absent','$total_overtime_hours','$bonus', '$start_pay_period', '$end_pay_period','$total_gross_pay','$benefits_deduction','$tax','$total_deduction','$total_net_pay')");

    $sql_tohistory = mysqli_query($conn, "INSERT INTO salary_history(last_name, first_name, department, salary, overtime_hours, start_pay_period, end_pay_period, total_gross_pay, philhealth, gsis, pagibig, sss, total_benefits_deductions, total_tax_deductions, total_deductions, total_net_pay) VALUES ('$last_name', '$first_name', '$department', '$salary_rate', '$total_overtime_hours', '$start_pay_period', '$end_pay_period', '$total_gross_pay', '$philhealth', '$GSIS', '$PAGIBIG', '$SSS', '$benefits_deduction', '$tax', '$total_deduction', '$total_net_pay')");

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
          // alert('Selected date is not enough to be a Monthly Pay');
          // window.location.href = '../home/home_income.php';
        </script>
        <?php
      } else if ($start_day == 1 || $end_day > 28) {
        $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

        if ($sql) {
          ?>
            <script>
              // alert('Employee Income successfully added.');
              // window.location.href = '../home/home_income.php';
            </script>
          <?php
        } else {
          ?>
            <script>
              // alert('Employee Income failed to be added.');
              // window.location.href = '../home/home_income.php';
            </script>
          <?php
        }
      }
    } else if ($start_day == 16 || $end_day >= 28) {
      $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

      if ($sql) {
        ?>
          <script>
            // alert('Employee Income successfully added.');
            // window.location.href = '../home/home_income.php';
          </script>
        <?php
      } else {
        ?>
          <script>
            // alert('Employee Income failed to be added.');
            // window.location.href = '../home/home_income.php';
          </script>
        <?php
      }
    }
    ?>
    <script>
      // alert('Selected date is not enough to be a 15 Day Pay');
      // window.location.href = '../home/home_income.php';
    </script>
    <?php
  } else if ($start_day == 1 || $end_day == 15) {
    $sql = addEmployeeIncome($conn, $selected_employee, $start_pay_period, $end_pay_period);

    if ($sql) {
      ?>
        <script>
          // alert('Employee Income successfully added.');
          // window.location.href = '../home/home_income.php';
        </script>
      <?php
    } else {
      ?>
        <script>
          // alert('Employee Income failed to be added.');
          // window.location.href = '../home/home_income.php';
        </script>
      <?php
    }
  }
}
?>