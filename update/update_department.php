<?php

include("../db.php");
include("../auth.php");

$id = $_POST['id'];
$dept_name = $_POST['dept_name'];
$dept_salary_rate = $_POST['dept_salary_rate'];

$sql = mysqli_query($c, "UPDATE department SET dept_name='$dept_name', dept_salary_rate='$dept_salary_rate' WHERE dept_id='$id'");

if ($sql) {
    ?>
    <script>
        alert('Department successfully updated.');
        window.location.href = '../home/home_departments.php';
    </script>
    <?php
} else {
    ?>
    <script>
        alert('Invalid action.');
        window.location.href = '../home/home_departments.php';
    </script>
    <?php
}
?>