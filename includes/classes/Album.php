<?php

  class Album {

    private $con;
    private $id;
    private $title;
    private $artitsID;
    private $genreID;
    private $artworkPath;


    //Initialiser
    public function __construct($con, $id){    //ID of the Artist we want to create
        $this->con = $con;
        $this->id = $id;    //Calls private variables

        //Moving query to constructor to select all data from table.
        //Avoid multiple queries
        $albumQuery = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
        $album = mysqli_fetch_array($albumQuery);

        //Assign album fields to private var
        $this->title = $album['title'];
        $this->artistID = $album['artist'];
        $this->genreID = $album['genre'];
        $this->artworkPath = $album['artworkPath'];
    }

    public function getTitle(){
      return $this->title;
    }

    public function getArtworkPath(){
      return $this->artworkPath;
    }

    //Use Artist ID and return Artist Object
    public function getArtist(){
      return new Artist($this->con, $this->artistID);
    }

    public function getGenre(){
      return $this->genreID;
    }

    //Display Number of Tracks
    public function getNumberOfTracks() {
      $query = mysqli_query($this->con, "SELECT id FROM tracks WHERE album='$this->id'");
      return mysqli_num_rows($query);
    }

    public function getTrackIDs() {
      $query = mysqli_query($this->con, "SELECT id FROM tracks WHERE album='$this->id' ORDER BY albumOrder ASC");

      // Create an Array holding all album IDs in ASC order by pushing each id in from a while loop
      $array = array();

      while($row = mysqli_fetch_array($query)) {
          // Loop through Array
          array_push($array, $row['id']);   //P1 Array, P2 Item to push to Array
      }

      return $array;

    }







}

?>
