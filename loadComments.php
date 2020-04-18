<?php
include 'dbc.php';
$commentNewCount = $_POST['commentNewCount'];
$firstID = $_POST['firstID'];
$secondID = $_POST['secondID'];
$thirdID = $_POST['thirdID'];

$sql_guestReload = 'SELECT id, firstname, lastname, comment, commentDate
                  FROM guestbook WHERE NOT id="'.$firstID.'" AND NOT id="'.$secondID.'" AND NOT id="'.$thirdID.'"  ORDER BY id DESC LIMIT '.$commentNewCount.';';
$resultReload = mysqli_query($conn, $sql_guestReload);
$resultCheckReload = mysqli_num_rows($resultReload);

if ($resultCheckReload > 0) {
    $counter = 0;
    while($rowReload = mysqli_fetch_assoc($resultReload)) {
      $counter++;
      echo '<div class="guestbook-content"><h4>Comment by '.$rowReload["firstname"].' '
      .$rowReload["lastname"].
      '</h4><p>'.$rowReload["comment"].'</p><p id="guestbook-date">'.$rowReload["commentDate"].
          '</p>
      </div>';
    }
    }else {
      exit('0 results '. mysqli_connect_error());
  }
//WHERE NOT '.$idNew.'
?>
