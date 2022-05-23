<?php 
session_start();

$room=$_POST['room'];

include 'partials/_dbconnect.php';

$sql = "SELECT msg, stime, ip FROM msgs WHERE room ='$room'";

$res = "";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        if($row['ip']== $_SESSION['username']){
            $m_left="0%";
            $row['ip']="You";
        }
        else{
            $m_left="15%";
        }
        $res = $res.'<div class="container" style="margin-left:'.$m_left.'">';
        $res = $res.$row['ip'];
        $res = $res." : <span class='time-right' style='float:right;'>".$row["stime"]."</span><p>".$row['msg'];
        $res = $res.'</p></div>';
    }
}
echo $res;
?>