<?php
	$LOCAL = 1; //0 if testing on server 000webhost, 1 if testing on local

	$servername = "student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com";
	$username = "kevinarlen";
	$password = "studentcalendar123";
	$dbname = "Student_Calendar0";

	if ($LOCAL == 0) {
	    $servername = "localhost";
	    $username = "id198573_kevinarlen";
	    $password = "studentcalendar123";
	    $dbname = "id198573_studentcalendar";
	}

	$conn = new mysqli($servername, $username, $password, $dbname);
?>