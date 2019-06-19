<?php
/*
  start of saving evaluation to the database
  */

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
   }


   echo "Your reviews have sucessfully submitted";
   $_SESSION = array();
   session_destroy();

   // redirect to thank you for submission page here
 }
 ?>
