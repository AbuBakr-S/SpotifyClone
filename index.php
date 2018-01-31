<?php
include("includes/config.php");   //Calls session_start() code. session_destroy() to end

//Check to see if Session var is set
if(isset($_SESSION['userLoggedIn'])){
  $userLoggedIn = $_SESSION['userLoggedIn'];    //Username
} else {
  header("Location: register.php");   //Redirects users to register / sign in first
}

?>

<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Salaam!
  </body>
</html>
