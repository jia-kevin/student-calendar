//each event will have a start time, end time, title and description
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com"
$username = "kevinarlen";
$password = "studentcalendar123"
$dbname = "Student_Calendar0"

//$conn = new mysqli("student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com", "kevinarlen ", "studentcalendar123", "Student_Calendar0", 3306);
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT ID, Title, Start, End FROM Customers";
$result = $conn->query($sql);

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    //$outp .= '{"ID":"'  . $rs["ID"] . '",'; //don't need, mysql should have autoincrement
    $outp .= '"Title":"'   . $rs["Title"]        . '",'; //varchar(255)
    $outp .= '"Start":"'. $rs["Start"]     . '"}'; 
    $outp .= '"End":"'. $rs["End"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>
