<?php 
	require('../db.php');
	
	$id=$_GET['acc_info_id'];
	$query1 = "DELETE FROM account_info WHERE acc_info_id=$id"; 
	$result1 = mysqli_query($c, $query1) or die ( mysqli_error($c));

	if ($result1) {
		mysqli_close($c);
	?>
		<script>
			alert('Employee Income successfully deleted.');
			window.location.href = '../home/home_income.php';
		</script>
	<?php
	} else {
		mysqli_close($c);
	?>
		<script>
			alert('Failed to delete employee income.');
			window.location.href = '../home/home_income.php';
		</script>
	<?php
	}
 ?>