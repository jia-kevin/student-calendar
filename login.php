<?php 
session_start();
include("config.php");

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM user WHERE uid='$uid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (password_verify($pwd, $row['pwd'])){
	$_SESSION['id'] = $row['id']; // gives the id of the user
}

header("Location: index.php");
exit();
?>