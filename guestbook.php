<?php
include 'dbc.php';

    if (!$conn) {
        die('No mySQL Connection for the GUESTBOOK: '. mysqli_connect_error());
    }
    //mysqli_query($conn, "SET NAMES utf8;");
    $sql_guestBook = 'SELECT id, firstname, lastname, comment, commentDate
                      FROM guestbook ORDER BY id DESC LIMIT 5;';
    $result = mysqli_query($conn, $sql_guestBook);
    $resultCheck = mysqli_num_rows($result);

    echo '
    <div class="guestbook">
        <h3>Paul Vidgrain - Livre d\'or</h3>';


    if ($resultCheck > 0) {
        $counter = 0;
        while($row = mysqli_fetch_assoc($result)) {
          $counter++;
          echo '<div class="guestbook-content"><h4>Commentaire de '.$row["firstname"].' '
          .$row["lastname"].
          '</h4><p>'.$row["comment"].'<br><a href="guestbookMain.php?id='.$row["id"].'">lire plus</a></p>'.
          '<p id="guestbook-date">'.$row["commentDate"].
              '</p>
          </div>';
        }
        echo '<div class="let-comment"><a class="let-comment" href="guestbookMain.php?id=0">
                Laissez un commentaire!</a></div></div>';
      }else {
        exit('0 results '. mysqli_connect_error());
    }

mysqli_close($conn);

?>
