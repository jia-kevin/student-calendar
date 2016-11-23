<?php 
session_start();
include("config.php");

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd'";
$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)) {
	echo "Your username or password is incorrect.";
} else {
	$_SESSION['id'] = $row['id']; // gives the id of the user
}

header("Location: index.php");
//https://www.youtube.com/watch?v=e8TP2FERKls 27 min mark
?>