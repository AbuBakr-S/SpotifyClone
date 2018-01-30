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
  </head>
  <body>

    <div id="inputContainer" class="">

      <!-- Login Form -->
      <form id="loginForm" class="" action="register.php" method="POST">
        <h2>Login to your account</h2>
        <p>
          <label for="loginUserName">Username:</label>
          <input id="loginUserName" type="text" name="login_User_Name" required>
        </p>
        <p>
          <label for="loginPassword">Password:</label>
          <input id="loginPassword" type="password" name="login_Password" required>
        </p>

        <button type="submit" name="loginButton">Log In</button>

      </form>

      <!-- Register Form -->
      <form id="registerForm" class="" action="register.php" method="POST">
        <h2>Create your free account</h2>
        <p>
          <?php echo $account->getError(Constants::$userNameLength);    //Check Constants for error msgs ?>
          <?php echo $account->getError(Constants::$userNameTaken); ?>
          <label for="registerUserName">Username:</label>
          <input id="registerUserName" type="text" name="register_User_Name" value="<?php getInputValue('register_User_Name'); ?>" required>
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
          <input id="email" type="email" name="email_1" value="<?php getInputValue('email_1'); ?>" required>
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
          <input id="registerPassword" type="password" name="password_1" required>
        </p>

        <p>
          <label for="confirmPassword">Confirm Password:</label>
          <input id="confirmPassword" type="password" name="password_2" required>
        </p>

        <button type="submit" name="registerButton">Sign Up</button>

      </form>

    </div>

  </body>
</html>
