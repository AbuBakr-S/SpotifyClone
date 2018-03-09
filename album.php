<?php include("includes/header.php");

if(isset($_GET['id'])){
  $albumID = $_GET['id'];
} else {
  header("Location: index.php");
}

$album = new Album($con, $albumID);
//Get Artist Name using Artist Class
//No need to create select queries each time
$artist = $album->getArtist();

?>

<!-- Album content -->
<div class="entitiyInfo">
  <section class="leftSection">
    <!-- Display Album Artwork -->
    <img src="<?php echo $album->getArtworkPath() ?>" alt="">
  </section>

  <section class="rightSection">
    <h2><?php echo $album->getTitle(); ?></h2>
    <!-- For text, use span -->
    <p>By <?php echo $artist->getName(); ?><p>
    <p><?php echo $album->getNumberOfTracks(); ?> Tracks<p>
  </section>
</div>

<!-- Print Tracklist Names -->
<div class="tracklistContainer">
  <ul class="tracklist">
    <?php
      $trackIDArray = $album->getTrackIDs();
      $i = 1;   // Track Counter
      // trackID will be the ref. for each item after each iteration
      foreach($trackIDArray as $trackID) {

        // Create a new Track Object
        $albumTrack = new Track($con, $trackID);    //Track ID
        $albumArtist = $albumTrack->getArtist();    //Artist
        echo "<li class='tracklistRow'>
                <div class='trackCount'>
                  <i class='fas fa-play'></i>
                  <span class='trackNumber'>$i</span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>" . $albumTrack->getTitle() . "</span>
                  <span class='artistName'>" . $albumArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                  <i class='fas fa-ellipsis-h'></i>
                </div>

                <div class='trackDuration'>
                  <span class='duration'>" . $albumTrack->getDuration() . "</span>
                </div>
              </li>";
        $i++;
      }
    ?>
  </ul>
</div>
<!-- End of Tracklist Names -->

<?php include("includes/footer.php"); ?>
