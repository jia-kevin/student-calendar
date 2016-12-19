<?php 
session_start();
include("config.php");

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uid'];
//$pwd = $_POST['pwd'];
$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

$sql = "INSERT INTO user (first, last, uid, pwd) 
VALUES ('$first', '$last', '$uid', '$pwd')";
$result = mysqli_query($conn, $sql);

header("Location: index.php");
exit();
?>