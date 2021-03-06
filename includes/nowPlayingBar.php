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
      // newPlaylist created to make sure when the page loads,
      //..currentPlaylist doesn't have a value yet to pass comparison in setTrack func.
      $(document).ready(function(){
        var newPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        // When page loads, select first trackID, newPlaylist and stop audio
        setTrack(newPlaylist[0], newPlaylist, false);
        //Sets Volume Bar to full progress
        updateVolumeProgressbar(audioElement.audio);

        //Preventing controls from highlighting on mouse drag
        $(".nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
          e.preventDefault();    //Prevent normal behaviour
        });


      /**** Dragging along PROGRESS BAR ****/
        $(".playbackBar .progressBar").mousedown(function(){
          mouseDown = true;
        });

        // When mouse moves inside progress bar
        $(".playbackBar .progressBar").mousemove(function(e){
          if(mouseDown){
            //Set time of song, depending on position of mouse
            timeFromOffset(e, this);    //event and object
          }
        });

        $(".playbackBar .progressBar").mouseup(function(e){
            //Set time of song, depending on position of mouse
            timeFromOffset(e, this);    //event and object
        });
      /**** END ****/

      /**** Dragging along VOLUME BAR ****/
        $(".volumeBar .progressBar").mousedown(function(){
          mouseDown = true;
        });

        // When mouse moves inside progress bar
        $(".volumeBar .progressBar").mousemove(function(e){
          if(mouseDown){

            var percentage = e.offsetX / $(this).width();   //Decimal Perc

            // Check that volume isn't being dragged below 0 or above 1
            if(percentage >= 0 && percentage <= 1){
              audioElement.audio.volume = percentage;
            }
          }
        });

        $(".volumeBar .progressBar").mouseup(function(e){
          var percentage = e.offsetX / $(this).width();   //Decimal Perc

          // Check that volume isn't being dragged below 0 or above 1
          if(percentage >= 0 && percentage <= 1){
            audioElement.audio.volume = percentage;
          }
        });
        /**** END ****/

        // Reset mouseDown if mouse release on any part of the page
        $(document).mouseup(function(){
          mouseDown = false;
        });

      });

      // Get time of the track, from how far along the mouse is along the progress bar
      function timeFromOffset(mouse, progressBar){
        //mouse.offsetX is how far along on x axis the progress bar is
        var percentage = mouse.offsetX / $(progressBar).width() * 100;   //same as $(".plabackBar .progressBar")
        // if percentage = 50, set number of seconds to be 50% of total duration
        var seconds = audioElement.audio.duration * (percentage / 100);   //percentage divide by 100 so less than zero
        audioElement.setTime(seconds);
      }


      function prevTrack() {
        //If 3 sec or more into current track, OR first track in the Playlist
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
          audioElement.setTime(0);    //Back to start of current Track
        } else {
          currentIndex--;   //Previous track in Playlist
          setTrack(currentPlaylist[currentIndex], currentPlaylist, true); //Set currentPlaylist to previous track
        }
      }

      //Got to Next Track in Current Playlist, random 10 selected on load
      function nextTrack() {

        //Check if Repeat is selected. TRUE -> restart track
        if(repeat == true) {
          audioElement.setTime(0);
          playTrack();
          return;
        }

        //If currentIndex is at last element of the Array...e.g End of playlist
        if(currentIndex == currentPlaylist.length - 1){   //-1 as Zero based
          currentIndex = 0;//Reset
        } else {
          currentIndex++;
        }

        //Play indexed track
        //Which track to play?
        //If shuffle is ON, play shufflePlaylist[currentIndex], otherwise, play currentPlaylist[currentIndex]
        var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
      }

      function setRepeat() {
        if(repeat == true){
          repeat = false;
          $(".controlButton .fa-redo-alt").css("color", "#a0a0a0");
        } else {
          repeat = true;
          $(".controlButton .fa-redo-alt").css("color", "#07d159");
        }
      }

      function setMute() {
        if(audioElement.audio.muted  == true){
          audioElement.audio.muted = false;
          //If Volume Up
          $(".volumeBar .controlButton i").toggleClass("fa-volume-up fa-volume-off");
        } else {
          //If Volume Muted
          audioElement.audio.muted = true;   //Toggle set value
          $(".volumeBar .controlButton i").toggleClass("fa-volume-off fa-volume-up");
        }
      }


      function setShuffle() {
        if(shuffle == true){
          shuffle = false;
          $(".controlButton .fa-random").css("color", "#a0a0a0");
        } else {
          shuffle = true;
          $(".controlButton .fa-random").css("color", "#07d159");
        }

        //**********PRINT PLAYLISTS TO CONSOLE *********//
        console.log(currentPlaylist);
        console.log(shufflePlaylist);

        if(shuffle == true) {
          //Randomise Shuffle (Duplicate Playlist, but shuffle)
          shuffleArray(shufflePlaylist);
          //Prevent same song from playing again when pressed NEXT.
          //shufflePlaylist is randomised each time
          //This tracks the id of the currently playing song in any shuffled order
          currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        } else {
          //Shuffle Deactivated
          //Go back to regular playlist
          currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
      }


      // Shuffle Array Function
        // Pass in an Array and it will be Shuffled
      function shuffleArray(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
    }


      // Create a SetTrack Function (Outside Public Settrack Function)
      // newPlaylist will be created when new a track is selected from a different
      //.. album while the old track is still playing. They will then switch and the
      //.. new album will become the new playlist
      // Play will be true or false

      function setTrack(trackID, newPlaylist, play) {

        // 1. Will make two Playlists: i) Linear ii) Shuffled
        // 2. i) currentPlaylist ii) shufflePlaylist
        // 3. When setTrack, if playlist is different i.e. changed Album, currentPlaylist = newPlaylist
        // 4. shufflePlaylist is also that same playlist, but is a copy, which is then shuffled
        // 5. This allows us to go back to the non-shuffled playlist at anytime
        if(newPlaylist != currentPlaylist){
          currentPlaylist = newPlaylist;    //Independent
          shufflePlaylist = currentPlaylist.slice();    //Independent
          shuffleArray(shufflePlaylist);
        }

        //PHP loads before javascript
        //An AJAX call will allow us to execute PHP without the page having to reload
        // 1. URL of the AJAX Page to execute
        // 2. Data to send { name: value }
        // 3. Function Result

        // ### TRACK ###
        if(shuffle == true){
            currentIndex = shufflePlaylist.indexOf(trackID);    //Find Array index of current track
        } else {
          currentIndex = currentPlaylist.indexOf(trackID);    //Find Array index of current track
        }

        pauseTrack();   //Before change, pause

        //AJAX:
        $.post("includes/handlers/ajax/getTrackJson.php", { nasheedID: trackID }, function(data){
          //Access whatever is "echo" on URL

          var track = JSON.parse(data);
          // trackName attribute
          $(".trackName span").text(track.title);

              // ### ARTIST ###
              $.post("includes/handlers/ajax/getArtistJson.php", { artistID: track.artist }, function(data){
                var artist = JSON.parse(data);
                // artistName attribute
                $(".artistName span").text(artist.name);
                });

          // ### ALBUM ###
          $.post("includes/handlers/ajax/getAlbumJson.php", { albumID: track.album }, function(data){
            var album = JSON.parse(data);
            // album attribute
            // Add attribute to src, pass in artwork path
            $(".albumLink img").attr("src", album.artworkPath);
            });

          audioElement.setTrack(track);   //Accepts parsed JSON data
          playTrack();
        });

        if(play){
          audioElement.play();
        }
      }









// These functions can be called inside html buttons below
function playTrack() {

  // Update Play Count if the Audio Element's currentTime property is 0, to confirm new song playing
  if(audioElement.audio.currentTime == 0) {
    $.post("includes/handlers/ajax/updatePlays.php", { nasheedID: audioElement.currentlyPlaying.id });    //'id' can be replaced with any column in tracks table
  }


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
              <img class="albumArtwork" src="" alt="">
            </span>

            <div class="trackInfo">
              <span class="trackName">
                <span></span>
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
                <button class="controlButton shuffle" title="Shuffle Button" type="button" name="button" onclick="setShuffle()">
                  <!-- Shuffle Icon -->
                  <i class="fas fa-random"></i>
                </button>

                <button class="controlButton previous" title="Previous Button" type="button" name="previous" onclick="prevTrack()">
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

                <button class="controlButton next" title="Next Button" type="button" name="next" onclick="nextTrack()">
                  <!-- Next Icon -->
                  <i class="fas fa-step-forward"></i>
                </button>

                <button class="controlButton repeat" title="Repeat Button" type="button" name="repeat" onclick="setRepeat()">
                  <!-- Repeat Icon -->
                  <i class="fas fa-redo-alt"></i>
                </button>
            </div>

            <!-- Player Progress Bar -->
            <div class="playbackBar">
              <span class="progressTime current">00.00</span>
                <div class="progressBar">
                  <div class="progressBarBg">
                    <!-- The Actual Progress of the Track -->
                    <div class="progress"></div>
                  </div>
                </div>
              <span class="progressTime remaining">00.00</span>
            </div>


          </div>

        </div>

        <div class="nowPlayingRight">
          <div class="volumeBar">

            <button class="controlButton volume" title="Volume button" type="button" name="volume" onclick="setMute()">
              <i class="fas fa-volume-up"></i>
            </button>

            <div class="progressBar">
              <div class="progressBarBg">
                <!-- The Actual Progress of the Volume Level -->
                <div class="progress"></div>
            </div>
          </div>

        </div>
      </div>

  </div>
</div>
