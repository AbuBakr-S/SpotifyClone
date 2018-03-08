<?php

  class Artist {

    private $con;
    private $id;


    //Initialiser
    public function __construct($con, $id){    //ID of the Artist we want to create
        $this->con = $con;
        $this->id = $id;    //Calls private variables
    }

    public function getName(){
      $artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
      $artist = mysqli_fetch_array($artistQuery);
      return $artist['name'];

    }

}

?>
