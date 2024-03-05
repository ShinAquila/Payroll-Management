<?php

include("../db.php");
include("../auth.php");

// Retrieve data from POST
$id = $_POST['id'];
$date = $_POST['date'];
$status = $_POST['status'];
$overtime_hrs = $_POST['overtime_hrs'];

$sql = mysqli_query($c, "UPDATE attendance SET date='$date', status='$status', overtime_hrs='$overtime_hrs' WHERE attendance_id='$id'");

if ($sql) {
    ?>
    <script>
        alert('Attendance successfully updated.');
        window.location.href = '../home/home_attendance.php';
    </script>
    <?php
} else {
    ?>
    <script>
        alert('Attendance failed to update.');
        window.location.href = '../home/home_attendance.php';
    </script>
    <?php
}

mysqli_close($c);
