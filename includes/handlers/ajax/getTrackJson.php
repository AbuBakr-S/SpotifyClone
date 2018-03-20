<?php
  //AJAX page makes a DB call and echos result to be accessed

  include("../../config.php");

  if(isset($_POST['nasheedID'])) {
    $nasheedID = $_POST['nasheedID'];

    $query = mysqli_query($con, "SELECT * FROM tracks WHERE id='$nasheedID'");

    $resultArray = mysqli_fetch_array($query);

    // Must echo to return AJAX
    echo json_encode($resultArray);
  }

?>
