<?php
include 'db.php';
$id = $_POST['id'];
mysqli_query($conn, "UPDATE tasks SET done=1 WHERE id=$id");
?>
