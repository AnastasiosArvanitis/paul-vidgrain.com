<?php

require 'recaptchalib.php';
$clef_publique = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$clef_secrete = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$captchaVer = false;
$recaptchaErr = false;
$postErr = false;
$url = 'contactPage';

$reCaptcha = new ReCaptcha($clef_secrete);
if(isset($_POST["g-recaptcha-response"])) {
    $resp = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
        );
    if ($resp != null && $resp->success) {
      $captchaVer =  true;
      $recaptchaErr = false;
    }else {
      $captchaVer = false;
      $recaptchaErr = true;
    }
  }

        $nameErr = $lastNameErr = $emailErr = $formTextErr = false;
        $name = $lastName = $email = $comment = "";

        function validateInput($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

    if ($recaptchaErr) {
      header('Location: errorPage.php?recaptchaErr='.$recaptchaErr.'&urlErr='.$url);
      exit();
    }else{

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          //----------    name
          if (empty($_POST["name"])) {
            $nameErr = true;
          } else {
            $name = validateInput($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
              $nameErr = true;
            }
          }
          //----------    Last   name
          if (empty($_POST["lastName"])) {
            $lastNameErr = true;
          } else {
            $lastName = validateInput($_POST["lastName"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
              $lastNameErr = true;
            }
          }
          //----------    EMAIL
          if (empty($_POST["email"])) {
            $emailErr = true;
          } else {
            $email = validateInput($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = true;
            }
          }
          //----------    MES
          if (empty($_POST["comment"])) {
            $formTextErr = true;
          } else {
            $formText = validateInput($_POST["comment"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$formText)) {
              $formTextErr = true;
            }
          }
        }else{
          $postErr = true;
          header('Location: errorPage.php?postErr='.$postErr);
          exit();
        }
        //----------------SEND EMAIL IF THERE IS NO ERRORS
        if ($nameErr || $lastNameErr || $emailErr || $formTextErr){
          header('Location: errorPage.php?nameErr='.$nameErr.'&lastNameErr='.$lastNameErr.'&emailErr='
          .$emailErr.'&formTextErr='.$formTextErr.'&urlErr='.$url);
          exit();
        }else {
          $sender = 'contact@anastasios-arvanitis.fr';
          $to = 'contact@paul-vidgrain.com';
          $subject = $name.' '.$lastName.' sends you an email';
          $headers = 'From: '.$email;

          $sendMail = mail($to, $subject, $formText, $headers);

          if (!$sendMail){
            $mailNotSendErr = true;
            header('Location: errorPage.php?mailNotSendErr='.$mailNotSendErr);
            exit();
          }else {
            include 'htmlHead.php';
            include 'header.php';
     	      echo '<main><div class="page-container">';
            echo '<div class="sendEmailCont">';
            echo '<p>Merci '.$name.' '.$lastName.' de votre message!</p>';
            echo '</div>';
            echo '<div class="seperator-big"></div>';
           include 'footer.php';
          echo '</div>
            </main>
          </body>
      </html>';
           echo '<script type="text/javascript" src="app.js"></script>';
          }
        }
}



?>
