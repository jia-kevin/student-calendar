<?php
//https://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
$servername = "student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com"
$username = "kevinarlen";
$password = "studentcalendar123"
$dbname = "Student_Calendar0"

$conn = new mysqli($servername, $username, $password, $dbname);

if($type == 'new') {
  	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
  	$title = $_POST['title'];
  	$insert = mysqli_query($conn,"INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
  	$lastid = mysqli_insert_id($con);
  	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}
?>