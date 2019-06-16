<?php

  // get the scores that were entered by the student
  /*$role = $_POST['role'];
  $leadership = $_POST['leadership'];
  $participation = $_POST['participation'];
  $professional = $_POST['professional'];
  $quality = $_POST['quality'];
  */

  // normalize the scores for self evaluation

  // scores to use for testing
  $role = 0;
  $leadership = 1;
  $participation = 2;
  $professional = 3;
  $quality = 1;

  // total number that a student can get as his score
  $rubricTotal = 15;

  $role = $role / $rubricTotal;
  $leadership = $leadership / $rubricTotal;
  $participation = $participation / $rubricTotal;
  $professional = $professional / $rubricTotal;
  $quality = $quality / $rubricTotal;

  echo "Role " . $role . " Leader " . $leadership . " Partic " . $participation . "Prof " . $professional . " quality " . $quality;

  // add code to save scores here








 ?>
