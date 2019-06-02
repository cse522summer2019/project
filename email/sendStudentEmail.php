<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "EmailManager.php";

$sendTo = "aepellec@buffalo.edu";
$mail = new Email();
$userSubject = "Confirmation Code";
$userMessage = "Test Message";
$userHTMLMessage = "
  Test Message <br/></br>
  <br/><br/>
";

$mail->sendMessage(array($sendTo), $userSubject,$userHTMLMessage,$userMessage);
?>
