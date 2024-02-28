<?php
require('../db.php');

$id = $_GET['attendance_id'];
$query = "DELETE FROM attendance WHERE attendance_id=$id";
$result = mysqli_query($c, $query) or die(mysqli_error());

if ($result) {
	mysqli_close($c);
?>
	<script>
		alert('Attendance successfully deleted.');
		window.location.href = '../home/home_attendance.php';
	</script>
<?php
} else {
	mysqli_close($c);
?>
	<script>
		alert('Failed to delete employee.');
		window.location.href = '../home/home_attendance.php';
	</script>
<?php
}
?>