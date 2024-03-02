<?php

require("../db.php");

@$id = $_POST['salary_id'];
@$salary_rate = $_POST['salary_rate'];
$sql = mysqli_query($c, "UPDATE salary SET salary_rate='$salary_rate' WHERE salary_id='1'");

//fetches the percent per deduction
$query1 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
	$id = $row['deduction_id'];
	$philhealth_p = $row['deduction_percent'];
}

$query3 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
	$id = $row['deduction_id'];
	$GSIS_p = $row['deduction_percent'];
}

$query4 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
	$id = $row['deduction_id'];
	$PAGIBIG_p = $row['deduction_percent'];
}

$query5 = mysqli_query($c, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
	$id = $row['deduction_id'];
	$SSS_p = $row['deduction_percent'];
}


// Fetch the overtime rate
$overtime_query = mysqli_query($c, "SELECT rate FROM overtime WHERE ot_id='1'");
$overtime_row = mysqli_fetch_assoc($overtime_query);
$overtime_rate = $overtime_row['rate'];


// Update account_info for all rows
$account_query = mysqli_query($c, "SELECT * FROM account_info");
while ($row = mysqli_fetch_assoc($account_query)) {
	$days_full_day = $row['days_full_day'];
	$days_half_day = $row['days_half_day'];

	$total_gross_pay = ($salary_rate * $days_full_day) + (($salary_rate / 2) * $days_half_day) + $row['bonus'] + ($row['overtime_hours'] * $overtime_rate);

	$tax = 0;
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

	$philhealth = 0;
	$GSIS = 0;
	$PAGIBIG = 0;
	$SSS = 0;

	$check_query = mysqli_query($c, "SELECT * FROM account_info WHERE acc_info_id='{$row['acc_info_id']}'");
	$check_row = mysqli_fetch_assoc($check_query);
	$philhealth_check = $check_row['philhealth_check'];
	$gsis_check = $check_row['gsis_check'];
	$pagibig_check = $check_row['pagibig_check'];
	$sss_check = $check_row['sss_check'];

	$benefits_deduction = 0;
	if ($philhealth_check == 1) {
		$philhealth = ($total_gross_pay * ($philhealth_p / 100)) / 2;
		$benefits_deduction += $philhealth;
	}
	if ($gsis_check == 1) {
		$GSIS = ($total_gross_pay * ($GSIS_p / 100)) / 2;
		$benefits_deduction += $GSIS;
	}
	if ($pagibig_check == 1) {
		$PAGIBIG = ($total_gross_pay * ($PAGIBIG_p / 100)) / 2;
		$benefits_deduction += $PAGIBIG;
	}
	if ($sss_check == 1) {
		$SSS = ($total_gross_pay * ($SSS_p / 100)) / 2;
		$benefits_deduction += $SSS;
	}
	// echo "Philhealth: ",$philhealth;
	// echo "GSIS: ",$GSIS;
	// echo "PAGIBIG: ",$PAGIBIG;
	// echo "SSS: ",$SSS;

	$total_deduction = $benefits_deduction + $tax;
	$total_net_pay = $total_gross_pay - $total_deduction;


	// Update each row in account_info
	$update_query = mysqli_query($c, "UPDATE account_info SET benefits_deductions='$benefits_deduction', tax_deductions='$tax', total_deductions='$total_deduction',total_gross_pay='$total_gross_pay', total_net_pay='$total_net_pay' WHERE acc_info_id='{$row['acc_info_id']}'");
	if (!$update_query) {
		echo "Failed to update account info for ID: {$row['acc_info_id']}";
		exit;
	}
}




if ($sql) {
	?>
	<script>
		alert('Salary rate successfully changed...');
		window.location.href = '../home/home_income.php';
	</script>
	<?php
} else {
	?>
	<script>
		alert('Not successfull...');
		window.location.href = '../home/home_income.php';
	</script>
	<?php
}
?>