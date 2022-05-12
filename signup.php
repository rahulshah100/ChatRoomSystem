<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);

    if($numExistRows>0){
        $exists=true;     
        $showError = "Account with a same name exists. Please choose a different account name";   
    }
    else{
        $exists=false;
    
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
}}    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
    <style>
        @import url('https://rsms.me/inter/inter-ui.css');
        ::selection {
        /* background: #2D2F36; */
        }
        ::-webkit-selection {
        background: #2D2F36;
        }
        ::-moz-selection {
        background: #2D2F36;
        }
        body {
        background: white;
        font-family: 'Inter UI', sans-serif;
        margin: 0;
        }
        .page {
        background: #e2e2e5;
        display: flex;
        flex-direction: column;
        height: calc(100% - 40px);
        position: absolute;
        place-content: center;
        width: 100%;
        }
        @media (max-width: 767px) {
        .page {
            height: auto;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        }
        .container {
        display: flex;
        height: 320px;
        margin: 0 auto;
        width: 640px;
        }
        @media (max-width: 767px) {
        .container {
            flex-direction: column;
            height: 630px;
            width: 320px;
        }
        }
        .left {
        background: white;
        height: calc(100% - 40px);
        top: 20px;
        position: relative;
        width: 50%;
        }
        @media (max-width: 767px) {
        .left {
            height: 100%;
            left: 20px;
            width: calc(100% - 40px);
            max-height: 270px;
        }
        }
        .login {
        font-size: 50px;
        font-weight: 900;
        margin: 50px 40px 40px;
        }
        .eula {
        color: #999;
        font-size: 14px;
        line-height: 1.5;
        margin: 40px;
        }
        .right {
        background: #474A59;
        box-shadow: 0px 0px 40px 16px rgba(0,0,0,0.22);
        color: #F1F1F2;
        position: relative;
        width: 50%;
        }
        @media (max-width: 767px) {
        .right {
            flex-shrink: 0;
            height: 100%;
            width: 100%;
            max-height: 350px;
        }
        }
        svg {
        position: absolute;
        width: 320px;
        }
        path {
        fill: none;
        stroke: url(#linearGradient);;
        stroke-width: 4;
        stroke-dasharray: 240 1386;
        }
        .form {
            background: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            width: 50%;
            box-shadow: 10px 5px 5px grey;
            border-radius:15px;
            padding: 27px;
        }
        label {
        /* color:  #c2c2c5; */
        display: block;
        font-size: 14px;
        height: 16px;
        margin-top: 20px;
        margin-bottom: 5px;
        }
        input {
        background: transparent;
        border: 0;
        color: #f2f2f2;
        font-size: 20px;
        height: 30px;
        line-height: 30px;
        outline: none !important;
        width: 100%;
        }
        input::-moz-focus-inner { 
        border: 0; 
        }
        #submit {
        color: #707075;
        margin-top: 40px;
        transition: color 300ms;
        }
        #submit:focus {
        color: #f2f2f2;
        }
        #submit:active {
        color: #d0d0d2;
        }
    </style>
  </head>
  <body style="background-color:#e2e2e5">
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can <a href="/loginsystem/login.php"> login </a> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
    
    <div class="">              
        <div class="form">
            <!-- <div class="container my-4"> -->
                <h1 class="text-center">Signup to our website</h1>
                <form action="/loginsystem/signup.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" maxlength="11">
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="21">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="21">
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">SignUp</button>
                </form>
            <!-- </div> -->
        </div>
    </div>

        <script>
                var current = null;
                document.querySelector('#email').addEventListener('focus', function(e) {
                if (current) current.pause();
                current = anime({
                    targets: 'path',
                    strokeDashoffset: {
                    value: 0,
                    duration: 700,
                    easing: 'easeOutQuart'
                    },
                    strokeDasharray: {
                    value: '240 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                    }
                });
                });
                document.querySelector('#password').addEventListener('focus', function(e) {
                if (current) current.pause();
                current = anime({
                    targets: 'path',
                    strokeDashoffset: {
                    value: -336,
                    duration: 700,
                    easing: 'easeOutQuart'
                    },
                    strokeDasharray: {
                    value: '240 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                    }
                });
                });
                document.querySelector('#submit').addEventListener('focus', function(e) {
                if (current) current.pause();
                current = anime({
                    targets: 'path',
                    strokeDashoffset: {
                    value: -730,
                    duration: 700,
                    easing: 'easeOutQuart'
                    },
                    strokeDasharray: {
                    value: '530 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                    }
                });
                });
        </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
