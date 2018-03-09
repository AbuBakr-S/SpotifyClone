<?php
include("includes/config.php");   //Calls session_start() code. session_destroy() to end
include("includes/classes/Artist.php");
include("includes/classes/Album.php");    //Must be after Artist
include("includes/classes/Track.php");

//  session_destroy();  LOGOUT

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
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- JS -->
    <script src="assets/js/script.js"></script>
  </head>
  <body>

    <!-- TESTING JAVASCRIPT AUDIO -->
    <script>
      //  Create a new Instance of the Audio Class
      var audioElement = new Audio();
      audioElement.setTrack("assets/tracks/Saud_Al-Shuraim/Al-Fatiha.mp3");
      audioElement.audio.play();  // References this.audio in the Audio Class
    </script>
    <!-- END -->

    <main class="mainContainer">
      <aside class="topContainer">
        <!-- Call Navigation Bar -->
        <?php include("includes/navBarContainer.php"); ?>

        <div class="mainViewContainer">
          <div class="mainConent">
