<?php

require "DatabaseConnector.php";

class ConfirmationCode extends DatabaseConnector {

  /**
   * Generates the confirmation code so that the user can access the system
   */
  public static function generateConfirmationCode($email) {

    // connect to the database
    $pdo = new PDO('mysql:host=tethys.cse.buffalo.edu;dbname=cse442_542_2019_summer_teamb_db', 'aepellec', '50285732');

    // check if the user exists in the system
    $statement = $pdo->query("SELECT * FROM Logininfo WHERE emailaddress='" . $email . "'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row == NULL) {
      return "false";
    } else {

      // generate a unique id
      $uniqueId = uniqid();

      // get the current timestamp
      $currentTime = time();

      // create the token
      $token = strval($uniqueId) ." ". strval($currentTime);

      // initializing encryption parameters
      $cipher_method = 'aes-128-ctr';
      $enc_key = "1fd1a8bddd596a20ca1f0260aa93cf6bc158a22799c1d44a5076fb2d69caed88";
      $iv = "1234467912245611";

      // encrypts the confirmation code
      $encryptedCode = openssl_encrypt($token, $cipher_method, $enc_key, 0, $iv);

      // update the table with the confirmation code
      $statement = $pdo->query("UPDATE Logininfo SET confirmationcode='". $encryptedCode . "'" . "WHERE emailaddress='".$email."'");

      // returns the encrypted code to be emailed
      return $encryptedCode;
    }
  }

  public static function verifyValidCode($confirmCode) {
    // connect to the database
    $pdo = new PDO('mysql:host=tethys.cse.buffalo.edu;dbname=cse442_542_2019_summer_teamb_db', 'aepellec', '50285732');

    // check if the user exists in the system
    $statement = $pdo->query("SELECT * FROM Logininfo WHERE confirmationcode='" . $confirmCode . "'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row == NULL) {
      return "false";
    } else {
      // initialize decryption parameters
      $cipher_method = 'aes-128-ctr';
      $enc_key = "1fd1a8bddd596a20ca1f0260aa93cf6bc158a22799c1d44a5076fb2d69caed88";
      $iv = "1234467912245611";

      // decrypt the token
      $token = openssl_decrypt($confirmCode, $cipher_method, $enc_key, 0, $iv);

      // explode tokens to get the timestamp
      $tokenParams = explode(" ", $token);

      // get current time
      $now = time();

      // 900 sec = 15 minutes
      // check if the time elapsed was more than 15 minutes
      if (900 > ($now - $tokenParams[1])) {
        return "true";
      } else {
        return "false";
      }
    }
  }
}

 ?>
