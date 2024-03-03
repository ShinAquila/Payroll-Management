<?php 
	require('../db.php');
	
	$id=$_GET['acc_info_id'];
	$query1 = "DELETE FROM account_info WHERE acc_info_id=$id"; 
	$result1 = mysqli_query($c, $query1) or die ( mysqli_error($c));

	header("Location: ../home/home_income.php"); 
 ?>