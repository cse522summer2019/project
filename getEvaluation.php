<?php
  require "models/Evaluation.php";

  // get the students id
  $studentId = $_POST['studentId'];
  $studentId = htmlspecialchars($studentId);

  //get the students teammates
  $result = Evaluation::getTeammates($studentId);

  // return the results
  echo json_encode($result);

 ?>
