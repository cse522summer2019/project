<?php
  require "models/Evaluation.php";

  // start the session for the users id
  session_start();

  if (isset($_SESSION['studentId']) && isset($_SESSION['course'])) {
    //get the students teammates
    $result = Evaluation::getTeammates($_SESSION['studentId'], $_SESSION['course']);

    // return the results
    echo json_encode($result);
  } else {
    echo json_encode(array('error' =>false));
  }


 ?>
