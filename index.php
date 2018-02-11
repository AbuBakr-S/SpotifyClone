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

              <div class="content">
                <span class="albumLink">
                  <!-- Temp Placeholder Img -->
                  <img class="albumArtwork" src="http://www.salafi-islam.com/wp-content/uploads/2017/01/The-Best-Islamic-Music.jpg" alt="">
                </span>

                <div class="trackInfo">
                  <span class="trackName">
                    <span>Ya Adheeman</span>
                  </span>

                  <span class="artistName">
                    <span>Ahmed Bukhatir</span>
                  </span>
                </div>

              </div>

            </div>
            <div class="nowPlayingCenter">

              <div class="content playerControls">

                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle Button" type="button" name="button">
                      <!-- Shuffle Icon -->
                      <i class="fas fa-random"></i>
                    </button>

                    <button class="controlButton previous" title="Previous Button" type="button" name="previous">
                      <!-- Previous Icon -->
                      <i class="fas fa-step-backward"></i>
                    </button>

                    <button class="controlButton play" title="Play Button" type="button" name="play">
                      <!-- Play Icon -->
                      <i class="far fa-play-circle"></i>
                    </button>

                    <button class="controlButton pause" title="Pause Button" type="button" name="pause" style="display: none;">
                      <!-- Pause Icon -->
                      <i class="far fa-pause-circle"></i>
                    </button>

                    <button class="controlButton next" title="Next Button" type="button" name="next">
                      <!-- Next Icon -->
                      <i class="fas fa-step-forward"></i>
                    </button>

                    <button class="controlButton repeat" title="Repeat Button" type="button" name="repeat">
                      <!-- Repeat Icon -->
                      <i class="fas fa-redo-alt"></i>
                    </button>
                </div>

                <!-- Player Progress Bar -->
                <div class="playbackBar">
                  <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                      <div class="progressBarBg">
                        <!-- The Actual Progress of the Track -->
                        <div class="progress"></div>
                      </div>
                    </div>
                  <span class="progressTime remaining">0.00</span>
                </div>


              </div>

            </div>

            <div class="nowPlayingRight">
              <div class="volumeBar">
                <button class="controlButton volume" title="Volume button" type="button" name="volume">
                  <i class="fas fa-volume-up"></i>
                </button>

                <div class="progressBarBg">
                  <!-- The Actual Progress of the Volume Level -->
                  <div class="progress"></div>
                </div>

              </div>
            </div>
        </div>
    </div>



  </body>
</html>
