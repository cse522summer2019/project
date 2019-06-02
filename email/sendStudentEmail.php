<?php

  require "EmailManager.php";

  $sendTo = $_POST["email"];

  // Configure email and code to sent
  $mail = new Email();
  $subject = "Confirmation Code";
  $confirmCode = uniqid();

  // Set alterntive text
  $message = "Here is your confirmation code: ". $confirmCode . "\n Use this code
    to access your evaluation. If it is not used in 15 minutes you will need to request a new one.";

  // set message to send with the code
  $htmlMessage = "
    Here is your confirmation code:<br/><br/><b>" . $confirmCode . "</b><br/><br/> Use this code to access
    your evaluation. If it is not used in 15 minutes you will need to request a new one.";

  // call the code to send the message
  $mail->sendMessage(array($sendTo), $subject, $htmlMessage, $message);
?>
