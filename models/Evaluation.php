<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
  class Evaluation {
    public static function getTeammates($studentId) {
      // connect to the database
      $conn = new mysqli("tethys.cse.buffalo.edu", "aepellec", "50285732", "cse442_542_2019_summer_teamb_db");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      // escape special characters
      $studentId = $conn->real_escape_string($studentId);
      // prepare sql statement for getting the students team
      $stmt = $conn->prepare("SELECT teamid FROM StudentTeams WHERE studentid=?");
      // bind parameters
      $stmt->bind_param("i", $studentId);
      // execute the sql statement
      $stmt->execute();
      // bind the column results to varaibles
      $stmt->bind_result($team);
      // get result
      $result = $stmt->fetch();
      // close the statement
      $stmt->close();
      // get students and evaluations
      $stmt = $conn->prepare("SELECT Logininfo.studentid, studentname, role, leadership, participation, professionalism, quality FROM StudentTeams LEFT JOIN Logininfo ON Logininfo.studentid = StudentTeams.studentid inner join Evaluationdata on StudentTeams.studentid = Evaluationdata.studentid where teamid=? and evaluator=?");
      $stmt->bind_param("is", $team, $studentId);
      $stmt->execute();
      $stmt->store_result();
      // bind the result to these variables
      $stmt->bind_result($id, $name, $role, $lead, $part, $prof, $qual);
      // check if the student already submitted evalustion
      if ($stmt->num_rows == 0) {
        $stmt->close();
        // create an array to store the team members
        $teamArray = array();
        // prepare the query to get the students team members but not evaluation
        $stmt = $conn->prepare("SELECT Logininfo.studentid, studentname FROM StudentTeams LEFT JOIN Logininfo ON Logininfo.studentid = StudentTeams.studentid where teamid=?");
        // bind the team number to the query
        $stmt->bind_param("i", $team);
        // execute the statement
        $result = $stmt->execute();
        // bind the student id to the student variable
        $stmt->bind_result($id, $name);
        $studentName = "";
        // loop through the team members
        while($stmt->fetch()) {
          // dont add the student whose evaluation this is
          if ($id != $studentId) {
            // add the teammates
            $teamArray[] = array('studentId' => $id, 'studentName' => $name);
          } else {
            $studentName = $name;
          }
        }
        // return array in json formatting
        return array('self' => array('studentId' => intval($studentId), 'studentName' => $name), 'team' => $teamArray);
        // close the statement and connection
        $stmt->close();
        $conn->close();
      } else {
        // set up variables to store the team and the self evaluation info
        $teamArray = array();
        $studentName = "";
        $studentRole = 0;
        $studentLead = 0;
        $studentPart = 0;
        $studentProf = 0;
        $studentQual = 0;
        // loop through the team members
        while($stmt->fetch()) {
          // dont add the student whose evaluation this is
          if ($id != $studentId) {
            // add the teammates
            $teamArray[] = array('studentId' => $id, 'studentName' => $name, 'evaluation' => array('role' => $role, 'leadership' => $lead, 'participation' => $part, 'professionalism' => $prof, 'quality' => $qual));
          } else {
            $studentName = $name;
            $studentRole = $role;
            $studentLead = $lead;
            $studentPart = $part;
            $studentProf = $prof;
            $studentQual = $qual;
          }
        }
        // return array in json formatting
        return array('self' => array('studentId' => intval($studentId), 'studentName' => $name, 'evaluation' => array('role' => $studentRole, 'leadership' => $studentLead, 'participation' => $studentPart, 'professionalism' => $studentProf, 'quality' => $studentQual)), 'team' => $teamArray);
        $stmt->close();
        $conn->close();
      }
    }
    public static function insertReview($studentId, $evaluatorId, $role, $lead, $part, $prof, $quality){
      // connect to the database
      $conn = new mysqli("tethys.cse.buffalo.edu", "lingbohu", "50291087", "cse442_542_2019_summer_teamb_db");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $stmt = $conn->prepare("SELECT id FROM Evaluationdata WHERE studentid=? AND Evaluator=?");
      // bind parameters
      $stmt->bind_param("ss", $studentId, $evaluatorId);

      // execute the sql statement
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($checkId);
      echo "heree1";
        echo $stmt->num_rows;
        if ($stmt->num_rows > 0) { // if data exist update the data
          echo "here";
          $stmt->close();
          $stmt = $conn->prepare("UPDATE Evaluationdata SET role=?, leadership=?, participation=?, professionalism=?, quality=? WHERE studentid=? AND Evaluator=?");
          // bind parameters
          $stmt->bind_param("sssssii", $role, $lead, $part, $prof, $quality, $studentId, $evaluatorId);

          // execute the sql statement
          $stmt->execute();
          $stmt->close();
          echo "here";
        }
        else{
          $stmt->close();
          // insert the data if data is not exist
          $stmt = $conn->prepare("INSERT INTO Evaluationdata (studentid, Evaluator, role, leadership, participation, professionalism, quality) VALUES(?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("iisssss", $studentId, $evaluatorId, $role, $lead, $part, $prof, $quality);

          // execute the sql statement
          $stmt->execute();
          $stmt->close();
          }
      }
}
 ?>
