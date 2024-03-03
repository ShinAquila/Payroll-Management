<?php

require("../db.php");



$query1 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 1");
while ($row = mysqli_fetch_array($query1)) {
  $id = $row['deduction_id'];
  $philhealth = $_POST['philhealth'];
}


$query3 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 3");
while ($row = mysqli_fetch_array($query3)) {
  $id = $row['deduction_id'];
  $GSIS = $_POST['gsis'];
}

$query4 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 4");
while ($row = mysqli_fetch_array($query4)) {
  $id = $row['deduction_id'];
  $PAGIBIG = $_POST['pag_ibig'];
}

$query5 = mysqli_query($conn, "SELECT * from deductions WHERE deduction_id = 5");
while ($row = mysqli_fetch_array($query5)) {
  $id = $row['deduction_id'];
  $SSS = $_POST['sss'];
}

$sql1 = mysqli_query($c, "UPDATE deductions SET deduction_amount='$philhealth' WHERE deduction_id = 1");
$sql3 = mysqli_query($c, "UPDATE deductions SET deduction_amount='$GSIS' WHERE deduction_id = 3");
$sql4 = mysqli_query($c, "UPDATE deductions SET deduction_amount='$PAGIBIG' WHERE deduction_id = 4");
$sql5 = mysqli_query($c, "UPDATE deductions SET deduction_amount='$SSS' WHERE deduction_id = 5");

if ($sql1 && $sql3 && $sql4 && $sql5) {
	?>
	<script>
		alert('Deductions successfully updated...');
		window.location.href = '../home/home_deductions.php';
	</script>
<?php
} else {
	echo "Not Successfull!";
}
?>