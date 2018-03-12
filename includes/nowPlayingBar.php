<?php

  //  Select a Playlist of 10 random songs using the ID
  $trackQuery = mysqli_query($con, "SELECT id FROM tracks ORDER BY RAND() LIMIT 10");

  // Declare Array
  $resultArray = array();

  // Convery $trackQuery result into an Array to be Looped over
  while($row = mysqli_fetch_array($trackQuery)) {
    // Push the ID of the current row into the named Array. 10 Track IDs
    array_push($resultArray, $row['id']);
  }

  // Convert Array to JSON to store data in a Universal Language
  $jsonArray = json_encode($resultArray);   //Converts any PHP var to JSON

?>

<!-- Javascript -->
<script>
      // currentPlaylist defined in script.js
      $(document).ready(function(){
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        // When page loads, select first trackID, newPlaylist and stop audio
        setTrack(currentPlaylist[0], currentPlaylist, false);
      });

      // Create a SetTrack Function (Outside Public Settrack Function)
      // newPlaylist will be created when new a track is selected from a different
      //.. album while the old track is still playing. They will then switch and the
      //.. new album will become the new playlist
      // Play will be true or false
      function setTrack(trackID, newPlaylist, play) {

        audioElement.setTrack("assets/tracks/Saud_Al-Shuraim/Al-Fatiha.mp3");
        if(play){
          audioElement.play();
        }
      }

// These functions can be called inside html buttons below
function playTrack() {
  // No space as same class at same level
  $(".controlButton.play").hide();
  $(".controlButton.pause").show();
  audioElement.play();
}

function pauseTrack() {
  $(".controlButton.pause").hide();
  $(".controlButton.play").show();
  audioElement.pause();
}

</script>


<div class="nowPlayingBarContainer">
    <div class="nowPlayingBar">
        <div class="nowPlayingLeft">

          <div class="content">
            <span class="albumLink">
              <!-- Temp Placeholder Img -->
              <img class="albumArtwork" src="http://alqalam.co.za/wp-content/uploads/2017/11/The-Best-Islamic-Music.jpg" alt="">
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

                <button class="controlButton play" title="Play Button" type="button" name="play" onclick="playTrack()">
                  <!-- Play Icon -->
                  <i class="far fa-play-circle"></i>
                </button>

                <button class="controlButton pause" title="Pause Button" type="button" name="pause" style="display: none;" onclick="pauseTrack()">
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
              <span class="progressTime current">00.00.00</span>
                <div class="progressBar">
                  <div class="progressBarBg">
                    <!-- The Actual Progress of the Track -->
                    <div class="progress"></div>
                  </div>
                </div>
              <span class="progressTime remaining">00.00.00</span>
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
