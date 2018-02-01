<?php
  include("includes/config.php");
  include("includes/classes/account.php");
  include("includes/classes/Constants.php");

  //Pass in $con to Account Class to access DB
  $account = new Account($con);   //Create a new Instance

  include("includes/handlers/register-handler.php");
  include("includes/handlers/login-handler.php");

  function getInputValue($inputName){
    if(isset($_POST[$inputName])){
      echo $_POST[$inputName];
    }
  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Spotify Clone</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/register.css">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS -->
    <script src="assets/js/register.js"></script>
  </head>
  <body>

    <?php

    //Use PHP to determine which form to Show...

    //If Register btn was pressed, show Register Form - Fix any errors
    //Else, show the Log in form and hide the Register Form
    //Once page is ready and dependancies have loaded
    if(isset($_POST['registerButton'])) {
      echo '<script>
              $(document).ready(function(){
                $("#loginForm").hide();
                $("#registerForm").show();
              });
            </script>';
    } else {
      echo '<script>
              $(document).ready(function(){
                $("#loginForm").show();
                $("#registerForm").hide();
              });
            </script>';
    }

    ?>

    <!-- Background Image -->
    <div class="background">
      <div class="loginContainer">
        <div class="inputContainer">

          <!-- Login Form -->
          <form id="loginForm" action="register.php" method="POST">
          <h2>Login to your account</h2>
          <p>
            <?php echo $account->getError(Constants::$loginFailed); ?>
            <label for="loginUserName">Username:</label>
            <input id="loginUserName" type="text" name="login_User_Name" required>
          </p>
          <p>
            <label for="loginPassword">Password:</label>
            <input id="loginPassword" type="password" name="login_Password" required>
          </p>

          <button type="submit" name="loginButton">Log In</button>

          <div class="accountPrompt">
              <span id="hideLogin">Don't have an account yet? Sign up here.</span>
          </div>

          </form>

          <!-- Register Form -->
          <form id="registerForm" action="register.php" method="POST">
            <h2>Create your free account</h2>
            <p>
              <?php echo $account->getError(Constants::$userNameLength);    //Check Constants for error msgs ?>
              <?php echo $account->getError(Constants::$userNameTaken); ?>
              <label for="registerUserName">Username:</label>
              <input id="registerUserName" type="text" name="register_User_Name" placeholder="Get creative" value="<?php getInputValue('register_User_Name'); ?>" required>
            </p>

            <p>
              <?php echo $account->getError(Constants::$firstNameLength); ?>
              <label for="firstName">First name:</label>
              <input id="firstName" type="text" name="first_Name" value="<?php getInputValue('first_Name'); ?>" required>
            </p>

            <p>
              <?php echo $account->getError(Constants::$lastNameLength); ?>
              <label for="lastName">Last name:</label>
              <input id="lastName" type="text" name="last_Name" value="<?php getInputValue('last_Name'); ?>" required>
            </p>

            <p>
              <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
              <?php echo $account->getError(Constants::$emailInvalid); ?>
              <?php echo $account->getError(Constants::$emailTaken); ?>
              <label for="email">Email:</label>
              <input id="email" type="email" name="email_1" placeholder="example@email.com" value="<?php getInputValue('email_1'); ?>" required>
            </p>

            <p>

              <label for="confirmEmail">Confirm Email:</label>
              <input id="confirmEmail" type="email" name="email_2" value="<?php getInputValue('email_2'); ?>" required>
            </p>

            <p>
              <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
              <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
              <?php echo $account->getError(Constants::$passwordLength); ?>
              <label for="registerPassword">Password:</label>
              <input id="registerPassword" type="password" name="password_1" placeholder="Must be Alphanumeric" required>
            </p>

            <p>
              <label for="confirmPassword">Confirm Password:</label>
              <input id="confirmPassword" type="password" name="password_2" placeholder="Re-type carefully" required>
            </p>

            <button type="submit" name="registerButton">Sign Up</button>

            <div class="accountPrompt">
                <span id="hideRegister">Already have an account? Log in here.</span>
            </div>

          </form>
        </div>
      </div>
    </div>

  </body>
</html>
