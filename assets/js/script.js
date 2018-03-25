var currentPlaylist = new Array();
var audioElement;

// Create a Class
function Audio()  {

  // Property of Audio Class
  this.currentlyPlaying;    // This has no value at the moment
  this.audio = document.createElement('audio');   // Create HTML Audio Object (Built In)

  // Create a Set Track function
  // Change from src to getTrackJson data
  this.setTrack = function(track) {
    this.currentlyPlaying = track;    //Track currently playing
    this.audio.src = track.path;    //path column in DB
  }

  this.play = function() {
    this.audio.play();
  }

  this.pause = function() {
    this.audio.pause();
  }


}
