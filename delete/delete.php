<?php
require('../db.php');

$id = $_GET['emp_id'];
$query = "DELETE FROM employee WHERE emp_id=$id";
$result = mysqli_query($c, $query) or die(mysqli_error());

if ($result) {
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
