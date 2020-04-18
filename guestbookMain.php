<?php

   require 'recaptchalib.php';
   $clef_publique = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
   $clef_secrete = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

   $form = '<div class="comment-form">
   <div class="comment-text">
     <p>Vous pouvez commenter en remplissant le formulaire ci-dessous.</p>
     <p id="obligatoire">Les champs avec <span>*</span> sont obligatoires.</p>
   </div>

     <form class="commentForm" action="guestbookSend.php" method="post">
       <p>Prénom: <span>*</span></p>
       <input id="name" type="text" name="name" value="">
       <p>Nom: <span>*</span></p>
       <input id="lastname" type="text" name="lastName" value="">
       <p>Email: <span>*</span></p>
       <input id="email"  type="text" name="email" value="">
       <p>Votre message: <span>*</span></p>
       <textarea id="form-text"  name="comment" rows="5" cols="40"></textarea>
       <div class="g-recaptcha" data-sitekey="'.$clef_publique.'"></div>
       <button type="button" name="button">Envoyer</button>
     </form>
   </div>';

       include 'htmlHead.php';
       include 'header.php';

	   echo '<main><div class="page-container">';
     include 'dbc.php';
     echo '
     <div id="guestbookMain" class="guestbook-main">
         <h3>Bienvenue sur le Livre d\'or de Paul Vidgrain!</h3>';

         if (!$conn) {
             die('No mySQL Connection for the GUESTBOOK: '. mysqli_connect_error());
         }

         $id = $_GET['id'];

         if ($id > 0) {
           //================THE CLICKED COMMENT
           $sql_guestBookOne = 'SELECT id, firstname, lastname, comment, commentDate
                             FROM guestbook WHERE id = "'.$id.'";';
           $resultOne = mysqli_query($conn, $sql_guestBookOne);
           $resultCheckOne = mysqli_num_rows($resultOne);

            if ($resultCheckOne > 0) {
              $rowOne = mysqli_fetch_assoc($resultOne);
              echo '<div id="'.$rowOne["id"].'" class="guestbook-content"><h4>Commentaire de '.$rowOne["firstname"].' '
              .$rowOne["lastname"].
              '</h4><p>'.$rowOne["comment"].'</p><p id="guestbook-date">'.$rowOne["commentDate"].
                  '</p>
              </div>';
            }else {
              exit('0 results '. mysqli_connect_error());
          }
              //================THE REST OF THE COMMENTS
              $sql_guestBook = 'SELECT id, firstname, lastname, comment, commentDate
                                FROM guestbook WHERE NOT id = "'.$id.'" ORDER BY id DESC LIMIT 2;';
              $result = mysqli_query($conn, $sql_guestBook);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                  $counter = 0;
                  while($row = mysqli_fetch_assoc($result)) {
                    $counter++;
                    echo '<div id="'.$row["id"].'" class="guestbook-content"><h4>Commentaire de '.$row["firstname"].' '
                    .$row["lastname"].
                    '</h4><p>'.$row["comment"].'</p><p id="guestbook-date">'.$row["commentDate"].
                        '</p>
                    </div>';
                  }
                  echo '<div id="newCont"></div>';
                  echo '<div class="loadMoreComm"><span id="loadMoreComm">Lire plus...</span></div>';
                  echo $form;
                  echo '</div>
                          <div class="seperator"></div>';
                  include 'footer.php';
                   echo '</div>
                            </main>
                          </body>
                      </html><script type="text/javascript" src="app.js"></script>';

            }else {
              exit('0 results '. mysqli_connect_error());
          }
         }elseif ($id == 0){
         $sql_guestBookAll = 'SELECT id, firstname, lastname, comment, commentDate
                           FROM guestbook ORDER BY id DESC LIMIT 3;';
         $resultAll = mysqli_query($conn, $sql_guestBookAll);
         $resultCheckAll = mysqli_num_rows($resultAll);

         if ($resultCheckAll > 0) {
             $counter = 0;
             while($rowAll = mysqli_fetch_assoc($resultAll)) {
               $counter++;
               echo '<div id="'.$rowAll["id"].'" class="guestbook-content"><h4>Commentaire de '.$rowAll["firstname"].' '
               .$rowAll["lastname"].
               '</h4><p>'.$rowAll["comment"].'</p><p id="guestbook-date">'.$rowAll["commentDate"].
                   '</p>
               </div>';
             }
             }else {
               exit('0 results '. mysqli_connect_error());
           }
           echo '<div id="newCont"></div>';
           echo '<div class="loadMoreComm"><span id="loadMoreComm">Lire plus...</span></div>';
           echo $form;
           echo '</div>
                   <div class="seperator"></div>';
             include 'footer.php';
            echo '</div>
                     </main>
                   </body>
               </html><script type="text/javascript" src="app.js"></script>';
         }

mysqli_close($conn);
?>
