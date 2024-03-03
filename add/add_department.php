<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
    die("Database Connection Failed" . mysqli_error());
}
if (isset($_POST['submit']) && !empty($_POST['dept_name']) && !empty($_POST['dept_salary_rate'])) {
    $dept_name = $_POST['dept_name'];
    $dept_salary_rate = $_POST['dept_salary_rate'];

    // Check if department with the same name already exists
    $check_query = mysqli_query($conn, "SELECT * FROM department WHERE dept_name='$dept_name'");
    if (mysqli_num_rows($check_query) > 0) {
        ?>
        <script>
            alert('Department already exists.');
            window.location.href = '../home/home_departments.php?page=emp_list';
        </script>
        <?php
        exit; // Stop further execution
    }

    // If department doesn't exist, insert the record
    $sql = mysqli_query($conn, "INSERT into department(dept_name, dept_salary_rate) VALUES('$dept_name', '$dept_salary_rate')");

    if ($sql) {
        ?>
        <script>
            alert('Department had been successfully added.');
            window.location.href = '../home/home_departments.php?page=emp_list';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Invalid.');
            window.location.href = '../index.php';
        </script>
        <?php
    }
}
?>