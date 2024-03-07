<?php
require('../db.php');

$id = $_GET['emp_id'];
$delete_attendance_query = "DELETE FROM attendance WHERE employee_id=$id";
$delete_account_query = "DELETE FROM account_info WHERE employee_id=$id";
$delete_employee_query = "DELETE FROM employee WHERE emp_id=$id";

// Execute deletion queries
$result_attendance = mysqli_query($c, $delete_attendance_query) or die(mysqli_error($c));
$result_account = mysqli_query($c, $delete_account_query) or die(mysqli_error($c));
$result_employee = mysqli_query($c, $delete_employee_query) or die(mysqli_error($c));

// Check if all deletions were successful
if ($result_attendance && $result_account && $result_employee) {
    mysqli_close($c);
    ?>
    <script>
        alert('Employee successfully deleted.');
        window.location.href = '../home/home_employee.php';
    </script>
    <?php
} else {
    mysqli_close($c);
    ?>
    <script>
        alert('Failed to delete employee.');
        window.location.href = '../home/home_employee.php';
    </script>
    <?php
}
?>
