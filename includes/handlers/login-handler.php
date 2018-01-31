<?php

//If login btn was pressed...
if(isset($_POST['loginButton'])){

  $userName = $_POST['login_User_Name'];
  $password = $_POST['login_Password'];

  //Login function
  $result = $account->login($userName, $password);

  if($result == true){    //Not necessary, but visually helpful
    $_SESSION['userLoggedIn'] = $userName;    //Session Variable userLoggedIn set to username
    header("Location: index.php");
  }
}

?>
