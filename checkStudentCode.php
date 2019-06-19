<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require "models/ConfirmationCode.php";

  // get the confirmation code the user sent in
  $confirmCode = $_POST["code"];
  $confirmCode = htmlspecialchars($confirmCode);

  // verify that the code is valid and get a response
  $response = ConfirmationCode::verifyValidCode($confirmCode);

  // return the response for the user to see
  echo $response;
 ?>
