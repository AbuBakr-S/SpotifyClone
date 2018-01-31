<?php

//If login btn was pressed...
if(isset($_POST['loginButton'])){

  $userName = $_POST['login_User_Name'];
  $password = $_POST['login_Password'];

  //Login function
  $result = $account->login($userName, $password);

  if($result == true){    //Not necessary, but visually helpful
    header("Location: index.php");
  }
}

?>
