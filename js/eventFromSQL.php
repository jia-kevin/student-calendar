<?php
$servername = "localhost";
$username = "id198573_kevinarlen";
$password = "studentcalendar123";
$dbname = "id198573_studentcalendar";

//$conn = new mysqli("student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com", "kevinarlen ", "studentcalendar123", "Student_Calendar0", 3306);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, title, startdate, enddate, allDay, FROM calendar";
$result = $conn->query($sql);

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    //$outp .= '{"ID":"'  . $rs["ID"] . '",'; //don't need, mysql should have autoincrement
    $outp .= '"id":"'   . $rs["id"]        . '",';
    $outp .= '"title":"'   . $rs["title"]        . '",'; //varchar(255)
    $outp .= '"start":"'. $rs["startdate"]     . '"}'; 
    $outp .= '"end":"'. $rs["enddate"]     . '"}';
	$allday = ($rs["allDay"] == "true") ? true : false;
    $outp .= '"allday":"'. $allday     . '"}'; 

}
$outp .="]";

$conn->close();

echo($outp);
?>
