<?php

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

      // create an array to store the team members
      $teamArray = array();

      // prepare the query to get the students team members
      $stmt = $conn->prepare("SELECT Logininfo.studentid, studentname FROM StudentTeams LEFT JOIN Logininfo ON Logininfo.studentid = StudentTeams.studentid where teamid=?");

      // bind the team number to the query
      $stmt->bind_param("i", $team);

      // execute the statement
      $stmt->execute();

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

    }
  }






 ?>
