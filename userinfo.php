<?php
session_start();
include("config.php");
if (!empty($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'firstname') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['first'];
	}

	if($type == 'lastname') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['last'];
	}

	if($type == 'uid') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['uid'];
	}

	if($type == 'classes') {
		$query = mysqli_query($conn, "SELECT * FROM userClassLink WHERE user = ", $_SESSION['id']);
		$classes = array();
		while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		     $e = $fetch['class'];
		     array_push($classes, $e);
		}
		echo json_encode($classes);
	}
}

function getUserInfo($infoType){
	include("config.php");
	if($infoType == 'firstname') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['first'];
	}

	if($infoType == 'lastname') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['last'];
	}

	if($infoType == 'uid') {
		$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '".$_SESSION['id']."'");

		$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $fetch['uid'];
	}

	if($infoType == 'classes') {
		$query = mysqli_query($conn, "SELECT * FROM userClassLink WHERE user = ", $_SESSION['id']);
		$classes = array();
		while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		     $e = $fetch['class'];
		     array_push($classes, $e);
		}
		echo json_encode($classes);
	}
}
?>