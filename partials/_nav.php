<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#" style="cursor:default">Anonymous ChatRoom</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a  data-toggle="modal" data-target="#AboutModal" type="button" class="nav-link" style="text-decoration: none;" href="#">About</a>
      </li>';

      if(!$loggedin){
      echo '<li class="nav-item">
        <a class="nav-link" href="/loginsystem/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/loginsystem/signup.php">Signup</a>
      </li>';
      }
      if($loggedin){
      echo '<li class="nav-item">
        <a href="#" data-toggle="modal" data-target="#LogoutModal" type="button" class="nav-link" style="text-decoration: none;"> Logout </a>
      </li>';
    }       
      
    echo '</ul>
    </form>
  </div>
</nav>';
?>