<?php 
$room = $_POST['room'];

if(strlen($room)>20 or strlen($room)<2)
{
    $message="Please choose a name betwwen 2 to 20 characters.";
    echo "<script>";
    echo 'alert("'.$message.'");';
    echo 'window.location="welcome.php";';
    echo '</script>';
}
else if(!ctype_alnum($room))
{
    $message="Please choose an alphanumeric room name.";
    echo "<script>";
    echo 'alert("'.$message.'");';
    echo 'window.location="welcome.php";';
    echo '</script>';
}
else{
    include 'partials/_dbconnect.php';
    
    $sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result)>0){
            $message="Room already in Use. Please choose a different room name.";
            echo "<script>";
            echo 'alert("'.$message.'");';
            echo 'window.location="welcome.php";';
            echo '</script>';
        }        
        else{
            $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
            if(mysqli_query($conn, $sql)){
                $message="You room is ready and you can chat now.";
                echo "<script>";
                echo 'alert("'.$message.'");';
                echo 'window.location="rooms.php?roomname='.$room.'";';
                echo '</script>';
            }
        }
    }
}
?>