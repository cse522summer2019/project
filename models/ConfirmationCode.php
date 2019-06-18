<?php

class ConfirmationCode {

  /**
   * Generates the confirmation code so that the user can access the system
   */
  public static function generateConfirmationCode($email) {

    // connect to the database
    $conn = new mysqli("tethys.cse.buffalo.edu", "aepellec", "50285732", "cse442_542_2019_summer_teamb_db");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // get rid of special characters for sql string
    $email = $conn->real_escape_string($email);

    // check if the user exists in the system
    $stmt = $conn->prepare("SELECT * FROM Logininfo WHERE emailaddress=?");

    // bind parameters
    $stmt->bind_param("s", $email);

    // execute the sql statement
    $stmt->execute();

    $result = $stmt->fetch();

    $stmt->close();

    // check if the student exists
    if ($result == false) {
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
      $stmt = $conn->prepare("UPDATE Logininfo SET confirmationcode=? WHERE emailaddress=?");

      // bind parameters
      $stmt->bind_param("ss", $encryptedCode, $email);

      // execute the sql statement
      $stmt->execute();

      $stmt->close();
      $conn->close();

      // returns the encrypted code to be emailed
      return $encryptedCode;
    }
  }

  public static function verifyValidCode($confirmCode) {
    // connect to the database
    $conn = new mysqli("tethys.cse.buffalo.edu", "aepellec", "50285732", "cse442_542_2019_summer_teamb_db");

    // get rid of special characters in sql string
    $confirmCode = $conn->real_escape_string($confirmCode);

    // check if the user exists in the system
    $stmt = $conn->prepare("SELECT studentid FROM Logininfo WHERE confirmationcode=?");

    // bind parameters
    $stmt->bind_param("s", $confirmCode);

    // execute the sql statement
    $stmt->execute();

    $stmt->bind_result($id);
    // see if there is any results
    $result = $stmt->fetch();

    if ($result == false) {
      return "Your code is not valid.";
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
        // start the session and set the student id
        session_start();
        $_SESSION['studentId'] = $id;

        return "Your code has been accepted!";
      } else {
        return "Your code has expired. Please request a new one.";
      }
    $stmt->close();
    $conn->close();
  }
}
}

 ?>
