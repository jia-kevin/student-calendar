<?php
session_start();
include("config.php");

$type = $_POST['type'];

if ($type == 'classExists') {
    echo false;
    $class = $_POST['class'];
    $sql = "SELECT * classes WHERE name = '".$class."'";
    $result = mysqli_query($conn, $sql);
    if ($result != 0) 
        echo true;
    else
        echo false;
}

if ($type == 'newClass')  {
    $class = $_POST['class'];
    $sql = "INSERT INTO classes(name, admin) VALUES ('".$class."', ".$_SESSION['id'].")";
    mysqli_query($conn, $sql);
}

if ($type == 'inClass')  {
    $class = $_POST['class'];
    $sql = "SELECT * userClassLink WHERE user = ".$_SESSION['id']." AND class = '".$class."'";
    $result = mysqli_query($conn, $sql);
    if ($result != 0) 
        echo true;
    else
        echo false;
}

if ($type == 'joinClass') {
    $class = $_POST['class'];
    $sql = "INSERT INTO userClassLink(user, class) VALUES (".$_SESSION['id'].", '".$class."')";
    mysqli_query($conn, $sql);
}

?>