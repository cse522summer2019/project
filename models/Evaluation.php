<?php

class Evaluation {

  /**
   * Class to perform database operations for the evaluation page
   */
  public static function getLastEvaluation($id) {

    // connect to the database
    $conn = new mysqli("tethys.cse.buffalo.edu", "aepellec", "50285732", "cse442_542_2019_summer_teamb_db");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // escape special characters
    $conn->real_escape_string($id);

    // prepare sql statement
    $stmt = $conn->prepare("SELECT * FROM Evaluationdata WHERE studentid=?");

    // bind parameters
    $stmt->bind_param("s", $id);

    // execute the sql statement
    $stmt->execute();

    // bind the column results to varaibles
    $stmt->bind_result($id, $studentid, $role, $lead, $part, $prof, $qual);

    // get the first returned result
    $result = $stmt->fetch();

    // close the statement and connection 
    $stmt->close();
    $conn->close();

    // check if the student has already submitted an evaluation
    if ($result == NULL) {
      // return a flag that states the student has not submitted an evaluation
      return "noeval";
    } else {
      // return the evalutation
      return array("role" => $result['role'], "leadership" => $result['leadership'], 'participation' => $result['participation'], 'professionalism' => $result['professionalism'], 'quality' => $result['quality']);
    }
  }
}


?>
