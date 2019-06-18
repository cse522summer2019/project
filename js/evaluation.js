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
  var role = `Evaluation on  Role : <br>
      <select class="form-control" name="role_"` + index + `" required>
      <option></option>
      <option value=0><strong>0 Point</strong>  -UNSATISFACTORY - <strong> DOES NOT </strong> willingly assume team roles, <strong>RARELY </strong> completes assigned work</option>
      <option value=1><strong> 1 Point</strong>  -DEVELOPING - <strong>USUALLY </strong> accepts assigned team roles, <strong>OCCASIONALLY </strong> completes assigned work</option>
      <option value=2><strong> 2 Points</strong> -SATISFACTORY - <strong>ACCEPTS  </strong>assigned team roles, <strong>MOSTLY  </strong>completes assigned work</option>
      <option value=3><strong> 3 Points</strong> -EXEMPLARY - <strong>ACCEPTS  </strong>all assigned team roles, <strong>ALWAYS </strong> completes assigned work</option>
    </select>
  </div><br>`

  // add role to the page for the teammate
  $("#evaluation").append(role);

  // create the leadership element
  var leadership = `Evaluation on Leadership :
    <select class="form-control" name=leadership_"` + index + `" required>
      <option></option>
      <option value=0> <strong>0 Point</strong>  -UNSATISFACTORY - <strong>RARELY </strong>takes leaderhip role; DOES not collaborate;<strong> SOMETIMES</strong> willing to assist teammates</option>
      <option value=1><strong>1 Point</strong>  -DEVELOPING - <strong>OCCASIONALLY</strong> shows leaderhip role, MOSTLY collaborate; <strong>GENERALLY</strong> willing to assist teammates</option>
      <option value=2><strong>2 Point</strong>  -SATISFACTORY - Shows an ability to lead when neccessary; Willing to collaborate; Willing to assist teammates</option>
      <option value=3><strong>3 Point</strong>  -EXEMPLARY - Takes leaderhip role; Is a good collaborator;<strong> ALWAYS </strong> willing to assist teammates</option>
    </select>
  </div>
<br>`;

// add leadership to the page for the teammate
$("#evaluation").append(leadership);

// create the participation element
var participation = `Evaluation on Participation :
  <select class="form-control" name=participation_"` + index + `" required>
    <option></option>
    <option value=0> <strong>0 Point</strong>  -UNSATISFACTORY - <strong>OFTEN</strong> misses meetings;Routinely unprepared for meetings, <strong>RARELY</strong> participates in meetings and does not share ideas.</option>
    <option value=1> <strong>1 Point</strong>  -DEVELOPING -<strong> OCCASIONALLY</strong> misses or does not participate in meetings;<strong>SOMEWHAT</strong> prepared for meetings; Offers UNCLEAR or UNHELPFUL ideas in meetings.</option>
    <option value=2> <strong>2 Points</strong> -SATISFACTORY -<strong> ATTENDS </strong>and PARTICIPATES in most meetings; <strong>PREPARED</strong> for meetings; Offers USEFUL ideas in meetings.</option>
    <option value=3> <strong>3 Points</strong> -EXEMPLARY - <strong>ATTENDS</strong> and PARTICIPATES in most meetings; <strong>PREPARED</strong> for meetings; Clearly expresses well-developed ideas in meetings.</option>
  </ul>
</div>
<br>`;

// add the participation element to the page
$("#evaluation").append(participation);

// create the professionalism element for the teammate
var professionalism = `Evaluation on Professionalism :
  <select class="form-control" name=professionalism_"` + index + `" required>
    <option></option>
    <option value=0><strong>0 Point</strong>  -UNSATISFACTORY -  <strong>OFTEN</strong> discourteous and/or openly critical of teammates;  <strong> DOES NOT</strong> want to listen to any alternative perspective.</option>
    <option value=1><strong> 1 Point</strong>  -DEVELOPING -  <strong>NOT ALWAYS</strong> considerate or courteous towards teammates;  <strong>USUALLY</strong> appreciates teammates prespectives but often unwilling to consider them.</option>
    <option value=2><strong> 2 Points</strong> -SATISFACTORY - <strong> MOSTLY</strong> courteous to teammates;  <strong>VALUES </strong>teammates prespectives but often willing to consider them.</option>
    <option value=3><strong>3 Points</strong> -EXEMPLARY -  <strong>ALWAYS </strong>courteous to teammates;  <strong>VALUES</strong> teammates prespectives, knowledge and experiences and willing to consider them.</option>
  </ul>
</div>
<br>`;

// add professionalism element to the page
$("#evaluation").append(professionalism);

// create the quality element for the teammate
var quality = `Evaluation on Quality :
  <select class="form-control" name=quality_"` + index + `" required>
    <option></option>
    <option value=0>0 Point  -UNSATISFACTORY -  <strong>RARELY</strong> commits to shared documents; Others  <strong>OFTEN </strong> required to revise, debug or fix their work.</option>
    <option value=1> 1 Point  -DEVELOPING -  <strong>OCCASIONALLY</strong> commits to shared documents; Others  <strong> SOMETIMES </strong>required to revise, debug or fix their work.</option>
    <option value=2> 2 Points -SATISFACTORY -  <strong>OFTEN</strong> commits to shared documents; Others  <strong>OCCASIONALLY</strong> needed to revise, debug or fix their work.</option>
    <option value=3> 3 Points -EXEMPLARY - <strong> FREQUENTLY</strong> commits to shared documents; Others  <strong>RARELY</strong> needed to revise, debug or fix their work.</option>
  </ul>
</div>
<br>
<br>`;

// append the quality element to the page
$("#evaluation").append(quality);

// associate an index with a student id
var studentId = `<input type="hidden" id="student_` + index + `" name="student_` + index + `"></input>`;
$("#evaluation").append(studentId);

// set the student id
document.getElementById("student_" + index).value = student.studentId;

}

  function openLeadership() {
    $(document).ready(function () {
        $("#roleEval").click();
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
