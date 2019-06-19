<?php
  require "models/Evaluation.php";
/*
  start of saving evaluation to the database
  */
  $conn = new mysqli("tethys.cse.buffalo.edu", "lingbohu", "50291087", "cse442_542_2019_summer_teamb_db");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// get the number of evaluations
 $numEval = $_POST['numEval'];
 $numEval = htmlspecialchars($numEval);

 // start the session
 session_start();

 // check if the session is set
 if (isset($_SESSION['studentId'])){

   // get the student who submitted these evaluations
   $evaluatorId = $_SESSION['studentId'];

   // loops through the evaluations for each teammate that they evaluatied
   for ($i = 0; $i < intVal($numEval); $i++) {
     // get the evaluation metrics
     $role = $_POST['role_' . $i];
     $lead = $_POST['leadership_' . $i];
     $part = $_POST['participation_' . $i];
     $prof = $_POST['professionalism_' . $i];
     $quality = $_POST['quality_' . $i];

     // get the teamates id of who you evaluated
     $teammateId = $_POST['student_' . $i];

     /*
     PUT CALL TO EVALUATION CLASS TO ENTER SINGLE EVALUATION HERE
     */

     $teammateId = Evaluation::getTeammates($studentId);

     $stmt = $conn->prepare("UPDATE Evaluationdata SET role=?, leadership=?, participation=?, professionalism=?, quality=? WHERE studentid=? AND Evaluator=?");

     // bind parameters
     $stmt->bind_param("sssssii", $role, $lead, $part, $prof, $quality, $teammateId, $studentId);

     // execute the sql statement
     $stmt->execute();

     $stmt->close();
     $conn->close();
   }
   echo "<h1>Thanks for your reviews!</h1>";
   $_SESSION = array();
   session_destroy();

   // redirect to thank you for submission page here
 }
 ?>
