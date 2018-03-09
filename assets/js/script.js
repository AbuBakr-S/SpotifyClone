// Create a Class
function Audio()  {

  // Property of Audio Class
  this.currentlyPlaying;    // This has no value at the moment
  this.audio = document.createElement('audio');   // Create HTML Audio Object (Built In)

  // Create a Set Track function
  this.setTrack = function(src){
    //  HTML Audio Element has accessible attributes, e.g src
    // The src of the audio file to be played = src parameter
    this.audio.src = src;
  }

}
