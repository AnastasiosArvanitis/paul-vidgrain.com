<?php

include 'htmlHead.php';
include 'header.php';
include 'dbc.php';


        if (!$conn) {
            die("Connection failed HERE LOADER: " . mysqli_connect_error());
        }

			$title = $_GET['title'];
			$url = $_GET['url'];
      $category = $_GET['category'];
			//========================================================EDOOOOOOOOOOOOOOO
			//INSERT INTO images (name, subcat, cat) VALUES ('paul_vidgrain_11.jpg', 'peinturesetlavis', 'gal');
        $sql = "SELECT name, info, subcat FROM images WHERE subcat = '".$url."';";

	if (!empty($title)){

    echo '<div class="page-container">';

		   $result = mysqli_query($conn, $sql);
       $resultCheck = mysqli_num_rows($result);
       $counter = 0;

       $smallGrid = "container-grid-small";
       $bigGrid = "container-grid";
       $smallGridImg = "gridImages-small";
       $bigGridImg = "gridImages";

        if ($resultCheck > 0 && $resultCheck <= 3) {

          echo '<div class="'.$smallGrid.'">';
          echo '<div class="pageTitle"><h2>Accueil | '.$category.' | '.$title.'.</h2></div>';
				while($row = mysqli_fetch_assoc($result)) {
             $counter++;
				echo '<div class="'.$smallGridImg.'"><img id="img'.$counter.'" class="content-image" src="images/cat/'
        .$row["subcat"].'/'
				.$row["name"].'" alt="'.'Paul Vidgrain  sculpteur et peintre"><p>Numero '.$counter.$row["info"].'</p></div>';
      }
              echo '</div>';
              include 'guestbook.php';
              echo '<div class="seperator-big"></div>';
              include 'footer.php';
              echo '<div id="popUp"><i id="popUpClose" class="far fa-times-circle"></i></div>
                </div></body>
            </html><script type="text/javascript" src="app.js"></script>';
    }elseif ($resultCheck > 3) {
        echo '<div class="'.$bigGrid.'">';
        echo '<div class="pageTitle"><h2>Accueil | '.$category.' | '.$title.'.</h2></div>';
      while($row = mysqli_fetch_assoc($result)) {
           $counter++;
      echo '<div class="'.$bigGridImg.'"><img id="img'.$counter.'" class="content-image" src="images/cat/'
      .$row["subcat"].'/'
      .$row["name"].'" alt="'.'test"><p>Numero '.$counter.$row["info"].'</p></div>';
      }

            echo '</div>';
            include 'guestbook.php';
            echo '<div class="seperator-big"></div>';
            include 'footer.php';
            echo '<div id="popUp"><i id="popUpClose" class="far fa-times-circle"></i></div>
            </div></body>
        </html><script type="text/javascript" src="app.js"></script>';

		}else{
			echo 'The database does not answer...';
		}
	}else{
		header("Location: index.php");
	}

//include 'footer.php';

?>
