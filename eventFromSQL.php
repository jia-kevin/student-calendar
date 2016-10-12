//each event will have a start time, end time, and title
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("student-calendar0.c6nyhmv3ij8y.us-west-2.rds.amazonaws.com", "kevinarlen ", "studentcalendar123", "Student_Calendar0", 3306);

$result = $conn->query("SELECT ID, Title, Start, End FROM Customers");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["ID"] . '",';
    $outp .= '"Title":"'   . $rs["Title"]        . '",';
    $outp .= '"Start":"'. $rs["Start"]     . '"}'; 
    $outp .= '"End":"'. $rs["End"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>