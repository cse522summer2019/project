<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require "EmailManager.php";
  require "../models/ConfirmationCode.php";

  $sendTo = $_POST["email"];
  $sendTo = htmlentities($sendTo);

  $isValid = ConfirmationCode::checkIfValidUser($sendTo);

  if (!$isValid) {
    echo "You are not a valid user in this system";
  } else {
    // Configure email and code to sent
    $mail = new Email();
    $subject = "Confirmation Code";
    $confirmCode = ConfirmationCode::generateConfirmationCode($sendTo);

    // Set alterntive text
    $message = "Here is your confirmation code: ". $confirmCode . "\n Use this code
      to access your evaluation. If it is not used in 15 minutes you will need to request a new one.";

    // set message to send with the code
    $htmlMessage = "
      Here is your confirmation code:<br/><br/><b>" . $confirmCode . "</b><br/><br/> Use this code to access
      your evaluation. If it is not used in 15 minutes you will need to request a new one.";

    // call the code to send the message
    try {
      // send the message
      $mail->sendMessage(array($sendTo), $subject, $htmlMessage, $message);

      // return success confirmation
      echo "Your confirmation code was successfully send to your email";
    } catch (Exception $e) {
      // check if the error is due to an invalid email
      if (strpos($e, "Invalid address") != false) {
        echo "Your email address is invalid";
      } else {
        // Any other error that is not a user error
        echo "Sorry! Something went wrong. Please try again later.";
      }
    }
  }
?>
