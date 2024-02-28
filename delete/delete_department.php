<?php
require('../db.php');

$id = $_GET['dept_id'];

// Update account_info for all rows
$employee_query = mysqli_query($c, "SELECT * FROM employee WHERE dept='$id'");
while ($row = mysqli_fetch_assoc($employee_query)) {
    
    // Update each row in account_info
    $update_query = mysqli_query($c, "UPDATE employee SET dept=0 WHERE emp_id='{$row['emp_id']}'");
    if (!$update_query) {
        echo "Failed to update account info for ID: {$row['emp_id']}";
        exit;
    }
}

$query = "DELETE FROM department WHERE dept_id=$id";
$result = mysqli_query($c, $query) or die(mysqli_error());

if ($result) {
    mysqli_close($c);
    ?>
    <script>
        alert('Department successfully deleted.');
        window.location.href = '../home/home_departments.php';
    </script>
    <?php
} else {
    mysqli_close($c);
    ?>
    <script>
        alert('Failed to delete employee.');
        window.location.href = '../home/home_departments.php';
    </script>
    <?php
}
?>
