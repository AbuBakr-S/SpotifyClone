<?php
  //AJAX page makes a DB call and echos result to be accessed

  include("../../config.php");

  if(isset($_POST['nasheedID'])) {
    $nasheedID = $_POST['nasheedID'];

    // Update Plays Counter by +1
    $query = mysqli_query($con, "UPDATE tracks SET plays = plays + 1 WHERE id='$nasheedID'");

  }

?>
