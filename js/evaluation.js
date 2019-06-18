$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "getEvaluation.php"
  }).then(function(result) {
    // parse the json
    result = JSON.parse(result);
    document.getElementById("numEval").value = (result.team.length + 1);

    // add your self evaluation to the page
    addSingleEvaluation(result.self, true, 0);

    // add the teammates evaluation to the page
    result.team.map(function(obj, index) {
      addSingleEvaluation(obj, false, index + 1);
    });
  });
});

function addSingleEvaluation(student, isSelf, index) {
  var heading;

  // append the heading
  if (isSelf) {
    // heading is a self evaluation
    heading = "<h2>Self Evaluation</h2>";
  } else {
    // heading is a teammate evaluation with the team members name
    heading = `<h2>Teammate Evaluation: ` + student.studentName;
  }

  // append the heading
  $("#evaluation").append(heading);

  // create the role element
  var role = `<div class="dropdown" >
    Evaluation on  Role : <br>
    <button class="btnRole btn-primary dropdown-toggle mywidth" type="button" data-toggle="dropdown" id = "roleEval_` + index +`">
      Role
    <span class="caret"></span></button>

        <ul class="dropdown-menu role" onclick="openLeadership()">
      <li > <a href="#"> <strong>0 Point</strong>  -UNSATISFACTORY - <strong> DOES NOT </strong> willingly assume team roles, <strong>RARELY </strong> completes assigned work </a></li>
      <li><a href="#"> <strong> 1 Point</strong>  -DEVELOPING - <strong>USUALLY </strong> accepts assigned team roles, <strong>OCCASIONALLY </strong> completes assigned work</a></li>
      <li><a href="#"> <strong> 2 Points</strong> -SATISFACTORY - <strong>ACCEPTS  </strong>assigned team roles, <strong>MOSTLY  </strong>completes assigned work</a></li>
      <li><a href="#"> <strong> 3 Points</strong> -EXEMPLARY - <strong>ACCEPTS  </strong>all assigned team roles, <strong>ALWAYS </strong> completes assigned work</a></li>
    </ul>
  </div><br>`

  // add role to the page for the teammate
  $("#evaluation").append(role);

  // create the leadership element
  var leadership = `<div class="dropdown">
        Evaluation on Leadership :
    <button type="button" class="btnLeadership btn-primary dropdown-toggle mywidth"  data-toggle="dropdown" id = "leadershipEval_"` + index +` >Leadership
       <span class="caret"></span></button>
    <ul class="dropdown-menu leaderhip"  onclick="openParticipation()">
      <li> <a href="#"> <strong>0 Point</strong>  -UNSATISFACTORY - <strong>RARELY </strong>takes leaderhip role; DOES not collaborate;<strong> SOMETIMES</strong> willing to assist teammates</a></li>
      <li><a href="#">  <strong>1 Point</strong>  -DEVELOPING - <strong>OCCASIONALLY</strong> shows leaderhip role, MOSTLY collaborate; <strong>GENERALLY</strong> willing to assist teammates</a></li>
      <li><a href="#">  <strong>2 Point</strong>  -SATISFACTORY - Shows an ability to lead when neccessary; Willing to collaborate; Willing to assist teammates</a></li>
      <li><a href="#">  <strong>3 Point</strong>  -EXEMPLARY - Takes leaderhip role; Is a good collaborator;<strong> ALWAYS </strong> willing to assist teammates</a></li>
    </ul>
  </div>
<br>`;

// add leadership to the page for the teammate
$("#evaluation").append(leadership);

// create the participation element
var participation = `<div class="dropdown">
        Evaluation on Participation :
  <button type="button" class="btnParticipation btn-primary dropdown-toggle mywidth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "participationEval_`+ index + `">
     Participation<span class="caret"></span></button>
  <ul class="dropdown-menu participation" onclick="openProffesionalism()">
    <li> <a href="#"> <strong>0 Point</strong>  -UNSATISFACTORY - <strong>OFTEN</strong> misses meetings;Routinely unprepared for meetings, <strong>RARELY</strong> participates in meetings and does not share ideas.</a></li>
    <li><a href="#">  <strong>1 Point</strong>  -DEVELOPING -<strong> OCCASIONALLY</strong> misses or does not participate in meetings;<strong>SOMEWHAT</strong> prepared for meetings; Offers UNCLEAR or UNHELPFUL ideas in meetings.</a></li>
    <li><a href="#">  <strong>2 Points</strong> -SATISFACTORY -<strong> ATTENDS </strong>and PARTICIPATES in most meetings; <strong>PREPARED</strong> for meetings; Offers USEFUL ideas in meetings.</a></li>
    <li><a href="#">  <strong>3 Points</strong> -EXEMPLARY - <strong>ATTENDS</strong> and PARTICIPATES in most meetings; <strong>PREPARED</strong> for meetings; Clearly expresses well-developed ideas in meetings.</a></li>
  </ul>
</div>
<br>`;

// add the participation element to the page
$("#evaluation").append(participation);

// create the professionalism element for the teammate
var professionalism = `<div class="dropdown">
    Evaluation on Professionalism :
  <button type="button" class="btnProfessionalism btn-primary dropdown-toggle mywidth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "proffesionalEval_` + index + `">
     Professionalism<span class="caret"></span></button>

  <ul class="dropdown-menu professionalism" id="professionalism" onclick="openQuality()">
    <li> <a href="#"><strong>0 Point</strong>  -UNSATISFACTORY -  <strong>OFTEN</strong> discourteous and/or openly critical of teammates;  <strong> DOES NOT</strong> want to listen to any alternative perspective.</a></li>
    <li><a href="#"><strong> 1 Point</strong>  -DEVELOPING -  <strong>NOT ALWAYS</strong> considerate or courteous towards teammates;  <strong>USUALLY</strong> appreciates teammates prespectives but often unwilling to consider them.</a></li>
    <li><a href="#"><strong> 2 Points</strong> -SATISFACTORY - <strong> MOSTLY</strong> courteous to teammates;  <strong>VALUES </strong>teammates prespectives but often willing to consider them.</a></li>
    <li><a href="#"> <strong>3 Points</strong> -EXEMPLARY -  <strong>ALWAYS </strong>courteous to teammates;  <strong>VALUES</strong> teammates prespectives, knowledge and experiences and willing to consider them.</a></li>
  </ul>
</div>
<br>`;

// add professionalism element to the page
$("#evaluation").append(professionalism);

// create the quality element for the teammate
var quality = `<div class="dropdown">
  Evaluation on Quality :
  <button type="button" class="btnQuality btn-primary dropdown-toggle mywidth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "qualityEval_` + index + `">
     Quality<span class="caret"></span></button>

  <ul class="dropdown-menu quality">
    <li> <a href="#">0 Point  -UNSATISFACTORY -  <strong>RARELY</strong> commits to shared documents; Others  <strong>OFTEN </strong> required to revise, debug or fix their work.</a></li>
    <li><a href="#"> 1 Point  -DEVELOPING -  <strong>OCCASIONALLY</strong> commits to shared documents; Others  <strong> SOMETIMES </strong>required to revise, debug or fix their work.</a></li>
    <li><a href="#"> 2 Points -SATISFACTORY -  <strong>OFTEN</strong> commits to shared documents; Others  <strong>OCCASIONALLY</strong> needed to revise, debug or fix their work.</a></li>
    <li><a href="#"> 3 Points -EXEMPLARY - <strong> FREQUENTLY</strong> commits to shared documents; Others  <strong>RARELY</strong> needed to revise, debug or fix their work.</a></li>
  </ul>
</div>
<br>
<br>`;

// append the quality element to the page
$("#evalutation").append(quality);

// associate an index with a student id
var studentId = `<input type="hidden" id="student_` + index + `"></input>`;
$("#evaluation").append(studentId);

// set the student id 
document.getElementById("student_" + index).value = student.studentId;

}

  function openLeadership() {
    $(document).ready(function () {
        $("#leadershipEval").click();
    });
  }
  function openParticipation() {
    $(document).ready(function () {
        $("#participationEval").click();
    });
  }

  function openProffesionalism() {
    $(document).ready(function () {
        $("#proffesionalEval").click();
    });
  } openQuality
  function openQuality() {
    $(document).ready(function () {
        $("#qualityEval").click();
    });
  }
var proffesionalEval = null;
var roleEval = null;
var leadershipEval = null;
var participationEval = null;
var qualityEval = null;
  $(function(){
      $(".role li a ").click(function(){

        $(".btnRole:first-child").text($(this).text());
        roleEval = $(".btnRole:first-child").val($(this).text());

     });
  });

  $(function(){
      $(".leaderhip li a ").click(function(){

        $(".btnLeadership:first-child").text($(this).text());
        leadershipEval= $(".btnLeadership:first-child").val($(this).text());

     });
  });

  $(function(){
      $(".participation li a ").click(function(){

        $(".btnParticipation:first-child").text($(this).text());
        participationEval= $(".btnParticipation:first-child").val($(this).text());

     });
  });

   $(function(){
      $(".professionalism li a ").click(function(){

        $(".btnProfessionalism:first-child").text($(this).text());
        proffesionalEval = $(".btnProfessionalism:first-child").val($(this).text());

     });
  });
  $(function(){
      $(".quality li a ").click(function(){

        $(".btnQuality:first-child").text($(this).text());
        qualityEval= $(".btnQuality:first-child").val($(this).text());

     });
  });
  function sendEvaluation() {
  var professionalism =  proffesionalEval.val();

  //Dictionary to store all evals

  var dict = {
  RoleEval: roleEval.val(),
  professionalEval: proffesionalEval.val(),
  participationEval: participationEval.val(),
  leadershipEval: leadershipEval.val(),
  qualityEval : qualityEval.val()
};
console.log($('#qualityEval').val());
console.log(professionalism);
  $.ajax({
    type: "POST",
    url: "/old/test.php",
    data: {professionalism : professionalism}
  }).then(function(result) {
    debugger;
    window.location.href = "/old/testDropDown.html";
  });
  }
