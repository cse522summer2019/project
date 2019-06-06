<?php

require "DatabaseConnector.php";

class ConfirmationCode extends DatabaseConnector {

  /**
   * Generates the confirmation code so that the user can access the system
   */
  public static function generateConfirmationCode($email) {
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

    // connects to the database
    $conn = self::getDB();

    // returns the encrypted code to be emailed
    return $encryptedCode;
  }

  public static function checkIfValidUser($email) {
    $conn = self::getDB();

    return true;
  }

  public static function verifyValidCode($confirmCode) {
    // connect to the database
    $conn = self::getDB();

    // initialize decryption parameters
    $cipher_method = 'aes-128-ctr';
    $enc_key = "1fd1a8bddd596a20ca1f0260aa93cf6bc158a22799c1d44a5076fb2d69caed88";
    $iv = "1234467912245611";

    // decrypt the token
    $token = openssl_decrypt($confirmCode, $cipher_method, $enc_key, 0, $iv);

    return $token;
  }
}





 ?>
