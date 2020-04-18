<?php

$nameErr = $_GET['nameErr'];
$lastNameErr = $_GET['lastNameErr'];
$emailErr = $_GET['emailErr'];
$formTextErr = $_GET['formTextErr'];
$postErr = $_GET['postErr'];
$recaptchaErr = $_GET['recaptchaErr'];
$urlErr = $_GET['urlErr'];
$mailNotSendErr = $_GET['mailNotSendErr'];
$guestBookGetErr = $_GET['guestBookGetErr'];


$name = $lastName = $email = $formText = $post = $recaptcha = $mailNotSend = $guestBookGet = '';

if ($urlErr == 'contactPage'){
  $url = 'contact';
  $title = 'Contact Page';
}elseif ($urlErr == 'commentPage') {
  $url = 'guestbookMain';
  $title = 'Comment Page';
}

if ($nameErr){
  $name = 'Name is required but only letters and spaces are allowed...';
}
if ($lastNameErr){
  $lastName = 'Last Name is required but only letters and spaces are allowed...';
}
if ($emailErr){
  $email = 'Email is required in a valid format...';
}
if ($formTextErr){
  $formText = 'Message is required';
}
if ($postErr){
  $post = 'Sorry but this is not a POST method :)';
}
if ($recaptchaErr){
  $recaptcha = 'You have to check the I am not a robot before sending le formulaire :)';
}
if ($mailNotSendErr){
  $mailNotSend = 'Sorry but the mail was not sent...';
}
if ($mailNotSendErr){
  $mailNotSend = 'Sorry but the mail was not sent...';
}
if ($guestBookGetErr){
  $guestBookGet = 'Sorry but this is not a GET method :)';
}



include 'htmlHead.php';
include 'header.php';
echo '<main><div class="page-container">';
echo '<div class="sendEmailCont">
<p>Sorry there are some Errors... </p><p>'.$name.'</p><p>'.$lastName.
'</p><p>'.$email.'</p><p>'.$formText.'</p><p>'.$post.'</p><p>'.$recaptcha.'

<br><a id="return-guestbook" href="'.$url.'.php">Return to '.$title.'</a></div>';

echo '<div class="seperator-big"></div>';
include 'footer.php';
echo '</div>
</main>
</body>
</html>';

echo '<script type="text/javascript" src="app.js"></script>';

?>
