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
if (isset($_SESSION['id'])){
	header("Location: index.php"); // if user wants to log in
} 
if (empty($uid)){
	header("Location: register.php"); // if user wants to register
}
exit();
?>