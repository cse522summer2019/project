<?php
  require "models/Evaluation.php";

  // start the session for the users id
  session_start();

  //get the students teammates
  $result = Evaluation::getTeammates($_SESSION['studentId']);

  // return the results
  echo json_encode($result);

 ?>
