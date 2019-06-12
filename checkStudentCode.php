<?php
  require "models/ConfirmationCode.php";

  // get the confirmation code the user sent in
  $confirmCode = $_POST["code"];

  // verify that the code is valid and get a response
  $response = ConfirmationCode::verifyValidCode($confirmCode);

  // return the response for the user to see
  echo json_encode(array( 'error' => array( 'msg' => $response)));
 ?>
