<?php

require("../db.php");
$PHILHEALTH = $_POST['philhealth'];
$GSIS = $_POST['gsis'];
$PAGIBIG = $_POST['pag_ibig'];
$SSS = $_POST['sss'];

// echo "Philhealth: ",$PHILHEALTH;
// echo "GSIS: ",$GSIS;
// echo "PAGIBIG: ",$PAGIBIG;
// echo "SSS: ",$SSS;

$sql1 = mysqli_query($c, "UPDATE deductions SET deduction_percent='$PHILHEALTH' WHERE deduction_id = 1");
$sql3 = mysqli_query($c, "UPDATE deductions SET deduction_percent='$GSIS' WHERE deduction_id = 3");
$sql4 = mysqli_query($c, "UPDATE deductions SET deduction_percent='$PAGIBIG' WHERE deduction_id = 4");
$sql5 = mysqli_query($c, "UPDATE deductions SET deduction_percent='$SSS' WHERE deduction_id = 5");

if ($sql1 && $sql3 && $sql4 && $sql5) {
	?>
	<script>
		alert('Deductions successfully updated...');
		window.location.href = '../home/home_deductions.php';
	</script>
	<?php
} else {
	?>
	<script>
		alert('Deductions failed to update...');
		window.location.href = '../home/home_deductions.php';
	</script>
	<?php
}
?>