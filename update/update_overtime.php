<?php

require("../db.php");

// $id = $_POST['ot_id'];
$overtime_rate = $_POST['rate'];
$sql = mysqli_query($c, "UPDATE overtime SET rate='$overtime_rate' WHERE ot_id='1'");


//fetches the percent per deduction
$query1 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
    $philhealth_p = $row['deduction_percent'];
}

$query3 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
    $gsis_p = $row['deduction_percent'];
}

$query4 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
    $pagibig_p = $row['deduction_percent'];
}

$query5 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
    $sss_p = $row['deduction_percent'];
}




// Update account_info for all rows
$account_query = mysqli_query($c, "SELECT * FROM account_info");
while ($row = mysqli_fetch_assoc($account_query)) {
    $days_full_day = $row['days_full_day'];
    $days_half_day = $row['days_half_day'];
    $days_absent = $row['days_absent'];
    $total_overtime_hours = $row['total_overtime_hours'];
    $worked_days = $days_full_day + $days_half_day + $days_absent;

    $salary_query = mysqli_query($c, "SELECT * FROM department JOIN employee ON department.dept_id=employee.dept WHERE employee.emp_id='{$row['employee_id']}'");
    $salary_row = mysqli_fetch_assoc($salary_query);
    $salary_rate = $salary_row['dept_salary_rate'];

    // echo "Total Overtime Hours: ",$total_overtime_hours;
    // echo "Overtime Rate: ",$overtime_rate;

    // echo "Salary Days: ",($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day);
    // echo "Bonus: ",$row['bonus'];
    // echo "Overtime pay: ",($total_overtime_hours*$overtime_rate);


    $total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $row['bonus'] + ($total_overtime_hours * $overtime_rate);

    
    $tax = 0;
    if ($worked_days > 15) {
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
    } else if ($worked_days <= 15) {
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


    $philhealth = 0;
    $GSIS = 0;
    $PAGIBIG = 0;
    $SSS = 0;


    $benefits_check_query = mysqli_query($c, "SELECT * from employee JOIN account_info ON employee.emp_id=account_info.employee_id WHERE acc_info_id='{$row['acc_info_id']}'");
    while ($row1 = mysqli_fetch_array($benefits_check_query)) {
        $has_philhealth = $row1['has_philhealth'];
        $has_gsis = $row1['has_gsis'];
        $has_pagibig = $row1['has_pagibig'];
        $has_sss = $row1['has_sss'];
    }


    $benefits_deduction = 0;
    if ($has_philhealth == 1) {
        $philhealth = ($total_gross_pay * ($philhealth_p / 100)) / 2;
        if ($worked_days <= 15) {
            $philhealth = $philhealth / 2;
        }
        $benefits_deduction += $philhealth;
    }


    if ($has_gsis == 1) {
        $GSIS = ($total_gross_pay * ($gsis_p / 100)) / 2;
        if ($worked_days <= 15) {
            $GSIS = $GSIS / 2;
        }
        $benefits_deduction += $GSIS;
    }

    if ($has_pagibig == 1) {
        $PAGIBIG = ($total_gross_pay * ($pagibig_p / 100)) / 2;
        if ($worked_days <= 15) {
            $PAGIBIG = $PAGIBIG / 2;
        }
        $benefits_deduction += $PAGIBIG;
    }

    if ($has_sss == 1) {
        $SSS = ($total_gross_pay * ($sss_p / 100)) / 2;
        if ($worked_days <= 15) {
            $SSS = $SSS / 2;
        }
        $benefits_deduction += $SSS;
    }

    $total_deduction = $benefits_deduction + $tax;
    $total_net_pay = $total_gross_pay - $total_deduction;

    // echo "Account Id: ",$row['acc_info_id'];

    // echo "Salary Days: ",($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day);
    // echo "Bonus: ",$row['bonus'];
    // echo "Overtime pay: ",($total_overtime_hours*$overtime_rate);
    // echo "Total gross: ",$total_gross_pay;


    // Update each row in account_info
    $update_query = mysqli_query($c, "UPDATE account_info SET benefits_deductions='$benefits_deduction', tax_deductions='$tax', total_deductions='$total_deduction', total_gross_pay='$total_gross_pay', total_net_pay='$total_net_pay' WHERE acc_info_id='{$row['acc_info_id']}'");
    if (!$update_query) {
        echo "Failed to update account info for ID: {$row['acc_info_id']}";
        exit;
    }
}

if ($sql) {
    ?>
    <script>
        alert('Overtime rate successfully updated.');
        window.location.href = '../home/home_income.php';
    </script>
    <?php
} else {
    ?>
    <script>
        alert('Overtime rate failed to update.');
        window.location.href = '../home/home_income.php';
    </script>
    <?php
}
?>