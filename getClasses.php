<?php
    // require the confirmation code class
    require "models/ConfirmationCode.php";

    // get the course list
    $courseList = ConfirmationCode::getClasses();

    // format and return the course list
    echo json_encode(array("courses" => $courseList));
 ?>
