<?php

  class Constants {

    //REGISTER ERROR MESSAGES
    //static - Does not require a new instance to be created
    public static $userNameLength = "Your Username must be between 5 - 25 characters";
    public static $firstNameLength = "Your First Name must be between 2 - 25 characters";
    public static $lastNameLength = "Your Last Name must be between 2 - 25 characters";
    public static $emailsDoNotMatch = "Your emails don't match";
    public static $emailInvalid = "Email is invalid";
    public static $emailTaken = "This Email is already in use";
    public static $passwordLength = "Your Password must be between 5 and 30 characters";
    public static $passwordNotAlphanumeric = "Your Password can only contain letters and numbers";
    public static $passwordsDoNotMatch = "Your Passwords don't match";
    public static $userNameTaken = "This Username already exists";

    //LOGIN ERROR MESSAGES
    public static $loginFailed = "Your Username or Password was incorrect";
  }

?>
