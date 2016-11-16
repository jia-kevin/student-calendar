<?php
//https://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
$servername = "localhost";
$username = "id198573_kevinarlen";
$password = "studentcalendar123";
$dbname = "id198573_studentcalendar";

$conn = new mysqli($servername, $username, $password, $dbname);

$type = $_POST['type'];

if($type == 'new') {

  	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
  	$title = $_POST['title'];
  	$insert = mysqli_query($conn,"INSERT INTO calendar('title', 'startdate', 'enddate', 'allDay') VALUES('$title','$startdate','$startdate','false')");
  	$lastid = mysqli_insert_id($conn);
  	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'fetch') {
  	$events = array();
  	$query = mysqli_query($conn, "SELECT * FROM calendar");
  	while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	     $e = array();
	     $e['id'] = $fetch['id'];
	     $e['title'] = $fetch['title'];
	     $e['start'] = $fetch['startdate'];
	     $e['end'] = $fetch['enddate'];
	     $allday = ($fetch['allDay'] == "true") ? true : false;
	     $e['allDay'] = $allday;
	     array_push($events, $e);
  	}
  	echo json_encode($events);
}


?>
