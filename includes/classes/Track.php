<?php
	class Track {

		private $con;
		private $id;
		private $mysqliData;
		private $title;
		private $artistID;
		private $albumID;
		private $genre;
		private $duration;
		private $path;

    // Constructor Initialiser (DB connection + ID)
      // Calls Private Vars
		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

      // 1. Avoid multiple queries by selecting all data form the table 1 time.
			$query = mysqli_query($this->con, "SELECT * FROM tracks WHERE id='$this->id'");

      // 2. Pass in results into an Array
      //    Hold result of mysqliData query to be accessed later
			$this->mysqliData = mysqli_fetch_array($query);

      // 3. Store each table column in a Private Variable
			$this->title = $this->mysqliData['title'];
			$this->artistID = $this->mysqliData['artist'];
			$this->albumID = $this->mysqliData['album'];
			$this->genre = $this->mysqliData['genre'];
			$this->duration = $this->mysqliData['duration'];
			$this->path = $this->mysqliData['path'];
		}

		public function getTitle() {
			return $this->title;
		}

    // Create new Artist Object and return Artist ID from the tracks table
		public function getArtist() {
			return new Artist($this->con, $this->artistID);
		}

    // Create new Album Object and return Album ID from the tracks table
		public function getAlbum() {
			return new Album($this->con, $this->albumID);
		}

    public function getGenre() {
      return $this->genre;
    }

		public function getDuration() {
			return $this->duration;
		}

    public function getPath() {
      return $this->path;
    }

		public function getMysqliData() {
			return $this->mysqliData;
		}

	}
?>
