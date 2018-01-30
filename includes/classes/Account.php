<?php

  class Account {

    private $con;
    private $errorArray;

    //Initialiser
    public function __construct($con){    //Pass in $con to access DB
        $this->con = $con;
        $this->errorArray = array();
    }

    public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2){
      //Call Validate Username fn
      $this->validateUserName($un);
      $this->validateFirstName($fn);
      $this->validateLastName($ln);
      $this->validateEmails($em1, $em2);
      $this->validatePasswords($pw1, $pw2);

      //Check if there are any errors
      if(empty($this->errorArray)){
        //Insert into DB
        return $this->insertUserDetails($un, $fn, $ln, $em1, $pw1);   //This class instance
      } else {
        return false;
      }

    }


    //Check to see if we have any errors
    public function getError($error){   //Search an error message in the error array
      if(!in_array($error, $this->errorArray)){   //If specified error is not in error Array...
          //If not, set $error to empty string
          $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }


    private function insertUserDetails($un, $fn, $ln, $em, $pw){
      $encryptedPw = md5($pw);    //Password01 will return erfr4t45fegre...
      $profilePic = "assets/images/profile-pics/bitmoji.png";
      $date = date("Y-m-d");

      //Fields must match order of DB field structure
      $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

        return $result;   //TRUE OR FALSE
    }


    private function validateUserName($un){
      //Check length and show error if too short
      if(strlen($un) > 25 || strlen($un) < 5){
          array_push($this->errorArray, Constants::$userNameLength);    //Call Constants for error msgs
          return;
      }
        //Check ALL usernames in DB and compare with chosen username to see if it already exists
        $checkUserNameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
        if(mysqli_num_rows($checkUserNameQuery) != 0){    //If there's a match
          array_push($this->errorArray, Constants::$userNameTaken);   //Add error to error Array
          return;
        }
    }

    private function validateFirstName($fn){
      if(strlen($fn) > 25 || strlen($fn) < 5){
          array_push($this->errorArray, Constants::$firstNameLength);
          return;
      }
    }

    private function validateLastName($ln){
      if(strlen($ln) > 25 || strlen($ln) < 5){
          array_push($this->errorArray, Constants::$lastNameLength);
          return;
      }
    }

    private function validateEmails($em1, $em2){
      if($em1 != $em2){
        array_push($this->errorArray, Constants::$emailsDoNotMatch);
        return;
      }

      if(!filter_var($em1, FILTER_VALIDATE_EMAIL)){
        array_push($this->errorArray, Constants::$emailInvalid);
        return;
      }

      $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em1'");
      if(mysqli_num_rows($checkEmailQuery) != 0){    //If there's a match
        array_push($this->errorArray, Constants::$emailTaken);   //Add error to error Array
        return;
      }

    }

    private function validatePasswords($pw1, $pw2){
      if($pw1 != $pw2){
        array_push($this->errorArray, Constants::$passwordsDoNotMatch);
        return;
      }

      //Alphanumeric characters only
      //If, ^ means NOT, A-Z a-z 0-9
      if(preg_match('/[^A-Za-z0-9]/', $pw1)){
        array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        return;
      }

      if(strlen($pw1) > 30 || strlen($pw1) < 5){
          array_push($this->errorArray, Constants::$passwordLength);
          return;
      }
    }
  }

?>
