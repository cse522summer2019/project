<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require "models/ConfirmationCode.php";

  $confirmCode = $_GET["code"];

  $decryptCode = ConfirmationCode::verifyValidCode($confirmCode);
  echo $decryptCode;
  
 ?>
