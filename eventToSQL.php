<?php
session_start();
include("config.php");

$type = $_POST['type'];

if($type == 'new') {
  	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
    $enddate = $_POST['enddate'].'+'.$_POST['zone'];
  	$title = $_POST['title'];
    $sql = "INSERT INTO calendar(title, startdate, enddate, allday) VALUES ('$title', '$startdate', '$enddate', 'false')";
    mysqli_query($conn, $sql);
    $lastid = mysqli_insert_id($conn);
    echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'fetch') {
  	$events = array();
  	$query = mysqli_query($conn, "SELECT * FROM calendar");
    $classes = array();
    include("userinfo.php");
    $classes = getUserInfo('classes');
  	while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	     $e = array();
	     $e['id'] = $fetch['id'];
	     $e['title'] = $fetch['title'];
	     $e['start'] = $fetch['startdate'];
	     $e['end'] = $fetch['enddate'];
	     $allday = ($fetch['allDay'] == "true") ? true : false;
	     $e['allDay'] = $allday;
       $e['class'] = $fetch['class'];
       foreach($classes as $checkClass) {
        if ($e['class'] == $checkClass){
          array_push($events, $e);
          break;
        }
       }
       unset($checkClass);
  	}
  	echo json_encode($events);
}

if($type == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM calendar WHERE id = $id";
    $retval = mysqli_query($conn, $sql);
}

?>
