<?php

class Evaluation {

  /**
   * Class to perform database operations for the evaluation page
   */
  public static function getLastEvaluation($id) {

    // connect to the database
    $pdo = new PDO('mysql:host=tethys.cse.buffalo.edu;dbname=cse442_542_2019_summer_teamb_db', 'aepellec', '50285732');

    // get the evaluation that is associated with the students email
    $statement = $pdo->query("SELECT * FROM Evaluationdata WHERE studentid='" . $id . "'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // check if the student has already submitted an evaluation
    if ($row == NULL) {
      // return a flag that states the student has not submitted an evaluation
      return "noeval";
    } else {
      // return the evalutation
      return array("role" => $row['role'], "leadership" => $row['leadership'], 'participation' => $row['participation'], 'professionalism' => $row['professionalism'], 'quality' => $row['quality']);
    }
  }
}


?>
