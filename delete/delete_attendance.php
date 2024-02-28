<?php 
	require('../db.php');
	
	$id=$_GET['attendance_id'];
	$query = "DELETE FROM attendance WHERE attendance_id=$id"; 
	$result = mysqli_query($c, $query) or die ( mysqli_error());
	header("Location: ../home/home_attendance.php"); 
 ?>