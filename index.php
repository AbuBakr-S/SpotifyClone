<?php include("includes/header.php"); ?>

    <!-- Main Body Here -->
    <h1 class="pageHeadingBig">You Might Also Like...</h1>

    <!-- Display Albums -->
    <div class="gridViewContainer">

      <?php
        $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

        //Convert query results into an array
        //Through each iteration, $row will contain the next row in the DB table
        while($row = mysqli_fetch_array($albumQuery)) {

            //Create new div for each $row
            //Pass in id parameter via URL
            echo "<div class='gridViewItem'>
                    <a href='album.php?id=" . $row['id'] . "'>
                        <img src='" . $row['artworkPath'] . "'>

                        <div class='gridViewInfo'>"
                          . $row['title'] .
                        "</div>
                    </a>
                  </div>";

        }
      ?>

    </div>

<?php include("includes/footer.php"); ?>
