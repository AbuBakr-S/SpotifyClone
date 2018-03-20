<?php
  //AJAX page makes a DB call and echos result to be accessed

  include("../../config.php");

  if(isset($_POST['albumID'])) {
    $albumID = $_POST['albumID'];

    $query = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumID'");

    $resultArray = mysqli_fetch_array($query);

    // Must echo to return AJAX
    echo json_encode($resultArray);
  }

?>
