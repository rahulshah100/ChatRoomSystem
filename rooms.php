<?php
session_start();

// If user not logged in, redirect to log in page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

$roomname = $_GET['roomname'];

include 'partials/_dbconnect.php';

$sql="SELECT * FROM `rooms` WHERE roomname='$roomname'";

$result = mysqli_query($conn, $sql);
if($result){
    if(mysqli_num_rows($result)==0){
        $message="Room does not exist. Try creating a new one";
        echo "<script>";
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/loginsystem/welcome.php";';
        echo '</script>';
    }
}
else{
    echo "Error:".mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="theme-color" content="#7952b3">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">        
    
    <link rel="icon" type="image/x-icon" href="/loginsystem/images/favicon.png">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .container {
        max-width: 960px;
        }

        /*
        * Custom translucent site header
        */

        .site-header {
        background-color: rgba(0, 0, 0, .85);
        -webkit-backdrop-filter: saturate(180%) blur(20px);
        backdrop-filter: saturate(180%) blur(20px);
        }
        .site-header a {
        color: #8e8e8e;
        transition: color .15s ease-in-out;
        }
        .site-header a:hover {
        color: #fff;
        text-decoration: none;
        }

        /*
        * Dummy devices (replace them with your own or something else entirely!)
        */

        .product-device {
        position: absolute;
        right: 10%;
        bottom: -30%;
        width: 300px;
        height: 540px;
        background-color: #333;
        border-radius: 21px;
        transform: rotate(30deg);
        }

        .product-device::before {
        position: absolute;
        top: 10%;
        right: 10px;
        bottom: 10%;
        left: 10px;
        content: "";
        background-color: rgba(255, 255, 255, .1);
        border-radius: 5px;
        }

        .product-device-2 {
        top: -25%;
        right: auto;
        bottom: 0;
        left: 5%;
        background-color: #e5e5e5;
        }


        /*
        * Extra utilities
        */

        .flex-equal > * {
        flex: 1;
        }
        @media (min-width: 768px) {
            .flex-md-equal > * {
                flex: 1;
            }
        }
        body {
        margin: 0 auto;        
        background-color:rgb(192,192,192);
        }

        .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
        }

        .darker {
        border-color: #ccc;
        background-color: #ddd;
        }

        .container::after {
        content: "";
        clear: both;
        display: table;
        }

        .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
        }

        .container img.right {
        float: right;
        margin-left: 20px;
        margin-right:0;
        }

        .time-right {
        float: right;
        color: #aaa;
        }

        .time-left {
        float: left;
        color: #999;
        }

        .anyClass{
            height:350px;
            overflow-y:scroll;
        }
        
        .midsize{
            max-width:80%;
            margin-left:auto !important;
            margin-right:auto !important;
        }
    </style>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <h2 class="midsize" style="margin-top:2%; margin-bottom:3%;">Chat Room - <?php echo $roomname; ?></h2>

    <div class="container midsize" style="box-shadow: 4px 2px 28px 1px grey; color: blue;">
        <div class="anyClass"></div>
    </div>
    
    <div class="d-flex flex-row midsize">
        <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message" style="margin-right:2%;">
        <button type="button" class="btn btn-success" name="submitmsg" id="submitmsg">Send</button>
    </div>

    <?php require 'components/Modals.html'?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- including jquery cdn for using it in its below given script tag-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        // JQuery to submit a Post Request, for sending a new message into DataBase:
            // On clicking the button with id=submitmsg, a post request will be sent to postmsg.php with parameters text, room, and ip.
            $("#submitmsg").click(function(){
                // Fetching text from input tag
                var clientmsg=$("#usermsg").val();
                $.post(//shows a post request is made
                        "postmsg.php", //request sent to postmsg.php
                        {text:clientmsg, room:'<?php echo $roomname; ?>', ip:'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'}, //these params are sent in the request                
                    ); 
                $("#usermsg").val("");//empties the input box                           
            });

        // Here in input if we press enter, then text was not getting submit, but we had to compulsorily press send everytime. To overcome that below given functionality is implemented.        
            var input = document.getElementById("usermsg"); // Get the input field

            input.addEventListener("keypress", function(event) {
            // Execute a function when the user presses a key on the keyboard        
                if (event.key === "Enter") {// If the user presses the "Enter" key on the keyboard            
                    event.preventDefault();// Cancel the default action, if needed            
                    document.getElementById("submitmsg").click(); // Trigger the button element with a click
                }
            });
        
        // JQuery to submit a Post Request, for fetchgin all messages of a room.
            // Check for new messgae every 1 second:
            setInterval(runFunction, 1000);

            function runFunction(){
                $.post(
                    "htcont.php", 
                    {room:'<?php echo $roomname ?>'}, 
                    function(data, status){//if request is successfully sent then this function is automatically executed. Here we are fetching the chat from db to show it inside the chatbox.
                        document.getElementsByClassName('anyClass')[0].innerHTML=data;
                    }
                )
            }
    </script>
</body>
</html>
