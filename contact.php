<?php

require 'recaptchalib.php';
$clef_publique = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$clef_secrete = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

       include 'htmlHead.php';
       include 'header.php';

	   echo '<main><div class="page-container">';
     echo '<div class="contact-form">';
     echo '<div class="contact-text">
       <p>Vous pouvez nous envoyer un email sur contact@paul-vidgrain.com <br>
         ou vous pouvez remplir le formulaire ci-dessous.</p>
       <p id="obligatoire">Les champs avec <span>*</span> sont obligatoires.</p>
     </div>

       <form class="contactForm" action="sendEmail.php" method="post">
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
      echo '<div class="seperator-big"></div>';
       //include 'guestbook.php';
       include 'footer.php';

      echo '</div>
        </main>
      </body>
</html>';

       echo '<script type="text/javascript" src="app.js"></script>';


?>
