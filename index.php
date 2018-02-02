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
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  </head>
  <body>

    <div class="nowPlayingBarContainer">
        <div class="nowPlayingBar">
            <div class="nowPlayingLeft">

            </div>
            <div class="nowPlayingCenter">

              <div class="content playerControls">

                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle Button" type="button" name="button">
                      <!-- Shuffle Icon -->
                      <i class="fas fa-random"></i>
                    </button>

                    <button class="controlButton previous" title="Previous Button" type="button" name="button">
                      <!-- Previous Icon -->
                      <i class="fas fa-step-backward"></i>
                    </button>

                    <button class="controlButton play" title="Play Button" type="button" name="button">
                      <!-- Play Icon -->
                      <i class="far fa-play-circle"></i>
                    </button>

                    <button class="controlButton pause" title="Pause Button" type="button" name="button" style="display: none;">
                      <!-- Pause Icon -->
                      <i class="far fa-pause-circle"></i>
                    </button>

                    <button class="controlButton next" title="Next Button" type="button" name="button">
                      <!-- Next Icon -->
                      <i class="fas fa-step-forward"></i>
                    </button>

                    <button class="controlButton repeat" title="Repeat Button" type="button" name="button">
                      <!-- Repeat Icon -->
                      <i class="fas fa-redo-alt"></i>
                    </button>
                </div>

              </div>

            </div>

            <div class="nowPlayingRight">

            </div>
        </div>
    </div>



  </body>
</html>
