<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || !isset($_SESSION['username'])){
    header("location: index.php");
    exit;
}

if(isset($_POST['room2'])){ //checks if it is a post reques to the page and whether room2 has been set
    $room2 = $_POST['room2'];

    include 'partials/_dbconnect.php';

    $sql="SELECT * FROM `rooms` WHERE roomname='$room2'";
    $result = mysqli_query($conn, $sql);

    if($result){
        if(mysqli_num_rows($result)==1){
            echo "<script>";
            echo 'window.location="rooms.php?roomname='.$room2.'";';
            echo '</script>';
        }
        else{
            $message="Room Does Not Exist";
            echo "<script>";
            echo 'alert("'.$message.'");';
            echo '</script>';
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="theme-color" content="#7952b3">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
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
        
        .maintxt{
            zoom:0.7;
        }
    </style>
    <title>Welcome - <?php echo $_SESSION['username']?></title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
  </head>

  <body style="background-color:#e2e2e5; overflow:hidden;">
   <div class="maintxt">
    <?php require 'partials/_nav.php' ?>    

    <main style="zoom:1.25 !important;">
        <div class="position-relative overflow-hidden p-0 p-md-5 text-center bg-light">
            <div class="col-md-8 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">Welcome - <?php echo $_SESSION['username']?></h1>
            <p class="lead fw-normal">Here you can create a Chatroom and share its ID. <br> Or join an existing Chatroom by pasting its ID.
            <br>
            <form action="claim.php" method="post" style="text-align:right;margin-right:6%;">
                    letschat.social/rooms.php?roomname= <input type="text" name="room" placeholder="Room's ID">
                    <button class="btn btn-outline-secondary" href="#">Claim a Room</button>
                    <br>                
            </form>
            <form action="welcome.php" method="post" class="mt-2">
            letschat.social/rooms.php?roomname=<input type="text" name="room2" placeholder="Existing Room's ID">
                    <button class="btn btn-outline-secondary" href="#">Join a Room</button>
            </form>
            <hr> </p> <br> <br>
            <p class="mb-0">                
                <i> Whenever you need to, be sure to 
                    <a href="#" data-toggle="modal" data-target="#LogoutModal" type="button"> logout.</a>
                </i>
            </p>
            </div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>            
        </div>
    </main>

    <?php require 'components/Modals.html'?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </div>
  </body>
</html>
