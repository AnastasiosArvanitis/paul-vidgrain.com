<?php

require 'recaptchalib.php';
$clef_publique = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$clef_secrete = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$captchaVer = false;
$recaptchaErr = false;
$url = 'commentPage';

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

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $nameErr = $lastNameErr = $emailErr = $formTextErr = $postErr = false;
  $name = $lastName = $email = $formText = "";

//========================  INPUT CONTROL ==============================



  //----------------NAME
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
  //----------    COMMENT
  if (empty($_POST["comment"])) {
    $formTextErr = true;
  } else {
    $formText = validateInput($_POST["comment"]);
    if (!$formText) {
      $formTextErr = true;
    }
  }
  }else{
    $postErr = true;
    header('Location: errorPage.php?postErr='.$postErr);
    exit();
  }
}
//=====================================  SEND ======================================================

  if ($nameErr || $lastNameErr || $emailErr || $formTextErr){
      header('Location: errorPage.php?nameErr='.$nameErr.'&lastNameErr='.$lastNameErr.'&emailErr='
      .$emailErr.'&formTextErr='.$formTextErr.'&urlErr='.$url);
      exit();
  }else {
    require 'dbc.php';
    $sql = 'INSERT INTO guestbook (firstname, lastname, email, comment) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      exit('<div class="sendEmailCont"><p>There is not database connexion  :)</p></div>');
    }
    else{

      mysqli_stmt_bind_param($stmt, "ssss", $name, $lastName, $email, $formText);
      mysqli_stmt_execute($stmt);

      include 'htmlHead.php';
      include 'header.php';

        echo '<main><div class="page-container">';
        echo '<div class="sendEmailCont">
                <p>Merci '.$name.' '.$lastName.' de votre commentaire!</p>
                  <a id="return-guestbook" href="guestbookMain.php">Returner au Livre d\'or</a>
              </div>';

              echo '<div class="seperator-big"></div>';
             include 'footer.php';
            echo '</div>
              </main>
            </body>
        </html>';

     echo '<script type="text/javascript" src="app.js"></script>';
      }


  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
?>
