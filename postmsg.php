<?php 
include 'partials/_dbconnect.php';

session_start();

$msg=$_POST['text'];
$room=$_POST['room'];
// $ip=$_POST['ip']; //this could be used to store user's IP Address

$ip=$_SESSION['username'];

$sql="INSERT INTO `msgs` (`msg`, `room`, `ip`, `stime`) VALUES ('$msg', '$room', '$ip', current_timestamp());";

mysqli_query($conn, $sql);
mysqli_close($conn);
?>