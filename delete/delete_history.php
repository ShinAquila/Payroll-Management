<?php
require('../db.php');

$id = $_GET['history_id'];
$query = "DELETE FROM salary_history WHERE history_id=$id";
$result = mysqli_query($c, $query) or die(mysqli_error());

if ($result) {
    mysqli_close($c);
    ?>
    <script>
        alert('History successfully deleted.');
        window.location.href = '../home/home_history.php';
    </script>
    <?php
} else {
    mysqli_close($c);
    ?>
    <script>
        alert('Failed to delete history.');
        window.location.href = '../home/home_history.php';
    </script>
    <?php
}
?>
