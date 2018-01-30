<?php

function sanitiseFormUsername($inputText){
  $inputText = strip_tags($inputText);    //Remove html
  $inputText = str_replace(" ", "", $inputText);    //Remove spaces in Username
  return $inputText;
}

function sanitiseFormPassword($inputText){
  $inputText = strip_tags($inputText);
  return $inputText;
}

function sanitiseFormString($inputText){
  $inputText = strip_tags($inputText);
  $inputText = str_replace(" ", "", $inputText);
  $inputText = ucfirst(strtolower($inputText));   //All lowercase, then uppercase first
  return $inputText;
}


//If register btn was pressed...SANITISE USER INPUT
if(isset($_POST['registerButton'])){
  //Sanitise input and call register fn

  $userName = sanitiseFormUsername($_POST['register_User_Name']);

  $firstName = sanitiseFormString($_POST['first_Name']);
  $lastName = sanitiseFormString($_POST['last_Name']);
  $email1 = sanitiseFormString($_POST['email_1']);
  $email2 = sanitiseFormString($_POST['email_2']);

  $password1 = sanitiseFormPassword($_POST['password_1']);
  $password2 = sanitiseFormPassword($_POST['password_2']);

  //Use arrow for instance of the class. Double colons for static
  $successful = $account->register($userName, $firstName, $lastName, $email1, $email2, $password1, $password2);   //Calls register() Public fn inside Account Class

  //If Registration was Successful:
  if($successful){
    header("Location: index.php");    //Redirect
  }

}

?>
