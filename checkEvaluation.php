<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require "models/Evaluation.php";

  // start the session to get the students email
  session_start();

  // check if the email is set, if not the student is not logged in
  if (isset($_SESSION['email'])) {
      // get the evaluation if there is a current one
      $response = Evaluation::getLastEvaluation($_SESSION['email']);
      // return the response (noeval or the evaluation)
      echo json_encode($response);
  } else {
    // redirect to login if the user is not logged in 
    header("Location: /CSE442-542/2019-Summer/cse-442b/ConfirmationCodePage.html");
  }




 ?>
