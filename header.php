 <?php
		include 'dbc.php';

        if (!$conn) {
          die("No mySQL Connection for the HEADER: " . mysqli_connect_error());
        }

        $sql_expo = "SELECT title, url FROM nav_expo;";
        $sql_gal = "SELECT title, url FROM nav_gal;";
        $sql_actual = "SELECT title, url FROM nav_actual;";
echo '
<header>
     <div class="headerLogo">
        <h1>Paul Vidgrain sculpteur et peintre</h1>
    </div>
        <div class="menu-btn">
          <span>
              <i id="menu_btn" class="fas fa-bars"></i>
          </span>
        </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a>
            </li>';

            $categoryAct = 'Actualités';
            $categoryExpo = 'Exposition';
            $categoryGal = 'Galeries';

											  //QUERY ACTUAL 1
        $result = mysqli_query($conn, $sql_actual);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {

				echo '<li id="li-act"><span>Actualités</span>
						<ul class="dropdown">';
            while($row = mysqli_fetch_assoc($result)) {

				echo '<li class="act"><a href="loader.php?url='.$row["url"].'&title='.$row["title"].'&category='.$categoryAct.'">';
                echo $row["title"];
				echo '</a></li>';

            }echo '		</ul>
				    </li>';
        } else {
            echo '0 results';
        }

//QUERY EXP 2
        $result = mysqli_query($conn, $sql_expo);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {

				echo '<li id="li-expo"><span>Exposition</span>
				        <ul class="dropdown">';
            while($row = mysqli_fetch_assoc($result)) {

				echo '<li class="expo"><a href="loader.php?url='.$row["url"].'&title='.$row["title"].'&category='.$categoryExpo.'">';
                echo $row["title"];
				echo '</a></li>';

            }echo '</ul></li>';
        } else {
            echo '0 results';
        }

		//QUERY gal 3
        $result = mysqli_query($conn, $sql_gal);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {

				echo '<li id="li-gal"><span>Galleries</span>
                        <ul class="dropdown">';
            while($row = mysqli_fetch_assoc($result)) {

				echo '<li class="gal"><a href="loader.php?url='.$row["url"].'&title='.$row["title"].'&category='.$categoryGal.'">';
                echo $row["title"];
				echo '</a></li>';

            }echo '</ul></li>';
        } else {
            echo '0 results';
        }
				echo'
                     <li id="li-cont"><a href="contact.php">Contact</a></li>
						</ul>
                </nav>

   </header>';

        mysqli_close($conn);


?>
