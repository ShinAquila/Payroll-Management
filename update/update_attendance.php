<?php

include("../db.php");
include("../auth.php");

// Retrieve data from POST
$id = $_POST['id'];
$date = $_POST['date'];
$status = $_POST['status'];

$sql = mysqli_query($c, "UPDATE attendance SET date='$date', status='$status' WHERE attendance_id='$id'");

if ($sql) {
    ?>
    <script>
        alert('Attendance successfully updated.');
        window.location.href = '../home/home_attendance.php';
    </script>
    <?php
} else {

}

mysqli_close($c);
