<?php
$server = "localhost";
$username = "root";
$password = "26645431R@hul";
$database = "users";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}
?>