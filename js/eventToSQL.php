<?php
//https://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
$servername = "student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com";
$username = "kevinarlen";
$password = "studentcalendar123";
$dbname = "Student_Calendar0";

$conn = new mysqli($servername, $username, $password, $dbname);

$type = $_POST['type'];

if($type == 'new') {
  	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
  	$title = $_POST['title'];
  	//$insert = mysqli_query($conn,"INSERT INTO calendar('title', 'startdate', 'enddate', 'allDay') VALUES ('$title','$startdate','$startdate','false')");
    //$sql = "INSERT INTO calendar(title, startdate, enddate, allDay) VALUES ('test','test','test','false')";
    $sql = "INSERT INTO calendar(title, startdate, enddate, allday) VALUES ('$title', '$startdate', '$startdate', 'false')";
    mysqli_query($conn, $sql);
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

if($type == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM calendar WHERE id = $id";
    $retval = mysql_query( $sql, $conn );
    
    if(! $retval ) {
       die('Could not delete data: ' . mysql_error());
    }
    echo "Deleted data successfully\n";
}

?>
