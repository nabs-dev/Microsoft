<?php
session_start();
include 'db.php';
$u = $_SESSION['user'];
$task = $_POST['task'];
mysqli_query($conn, "INSERT INTO tasks(user, task, done) VALUES('$u', '$task', 0)");
?>
