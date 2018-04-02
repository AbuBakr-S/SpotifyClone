var currentPlaylist = [];
var shufflePlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;

function formatTime(seconds) {
  var time = Math.round(seconds);
  var minutes = Math.floor(time / 60);
  var seconds = time - (minutes * 60);

  //Add Extra 00 for Hours at later stage
  //var extraZeroH = (hours < 10) ? "0" : "";
  var extraZeroM = (minutes < 10) ? "0" : "";
  var extraZeroS = (seconds < 10) ? "0" : "";

  return extraZeroM + minutes + ":" + extraZeroS + seconds;
}


// Update Duration Progress Bar
function updateTimeProgressBar(audio) {
  // 1. Start Duration Counter
  $(".progressTime.current").text(formatTime(audio.currentTime));
  // 2. Countdown Duration
  $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

  // 3. Fill Progress Bar
  var progress = audio.currentTime / audio.duration * 100;  //Calc perc. of total duration
  $(".playbackBar .progress").css("width", progress + "%");  //e.g. .progress { width: 3% }
}


// Update Volume
function updateVolumeProgressbar(audio) {
  var volume = audio.volume * 100;  //Calc perc. of total duration
  $(".volumeBar .progress").css("width", volume + "%");  //e.g. .progress { width: 3% }
}


// Create a Class
function Audio()  {

  // Property of Audio Class
  this.currentlyPlaying;    // This has no value at the moment
  this.audio = document.createElement('audio');   // Create HTML Audio Object (Built In)

  // Play Next Track when finished
  this.audio.addEventListener("ended", function() {
    nextTrack();
  });

  // 'canplay' Event Listener
  this.audio.addEventListener("canplay", function() {   //Audio Element has a canplay event
    // 'this' refers to the object that the event was called on
    var duration = formatTime(this.duration);
    $(".progressTime.remaining").text(duration);   //Duration property of Audio Object
  });


  // timeupdate Event Listener
  this.audio.addEventListener("timeupdate", function() {
  if(this.duration) {   //If there is a duration...
    updateTimeProgressBar(this);
    }
  });


  //volumeChange Event Listener
  this.audio.addEventListener("volumechange", function() {
    updateVolumeProgressbar(this);    //'this' is the Audio Element
  });


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

  // Set current time to no. seconds passed in when progress bar is dragged along
  this.setTime = function(seconds) {
    this.audio.currentTime = seconds;
  }

}
