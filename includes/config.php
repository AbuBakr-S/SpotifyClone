<?php

  //Output Buffering - Wait until we have all the data before we send to Server
  ob_start();
  session_start();    //Enables the use of Sessions

  $timezone = date_default_timezone_set("Europe/London");

  //HOST, USERNAME, PASSWORD, DB
  $con = mysqli_connect("localhost", "root", "", "spotifyClone");

  if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
  }

?>
