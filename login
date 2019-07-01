
<!DOCTYPE html>

<html lang="en">
<head>
  <style>

  .form_bg {
      padding:20px;
      border-radius:10px;
      border:1px solid #fff;
      margin: auto;
      top: 30%;
      right: 38%;
      bottom: 30%;
      left: 38%;
      width: 320px;
      height: 280px;
  }
  .align-center {
      text-align:center;
  }

  </style>
  <title>Peer Evaluation System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

  <!-- Header -->
  <div class="jumbotron">
     <h3>Login to Evaluation System</h3>
     <p> Enter your UB Email and select the course number of the course you would like to evaluate to get a confirmation code to access your evaluation. The code must be used within 15 minutes or you must request a new one.</p>
  </div>

    <div class="row">
      <div class="form_bg">

      <!-- Email form to get a confirmation code -->
      <form>
          <h2 class="text-center">Enter UB Email:</h2>
          <br/>
          <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Email" maxlength="30" >
          </div>
          <br>
          <h2 class="text-center">Choose Class:</h2>
          <br/>
          <div class="form-group">
              <select class="form-control" id="course" placeholder="Course Number" maxlength="30" >
                <option>Choose Course</option>
              </select>
          </div>
          <div class="align-center">
              <button type="button" onclick=" event.preventDefault(); sendMessage()" class="btn btn-primary" id="login">Get Code</button>
          </div>
      </form>
    </div>

      <!-- Modal window to show the emails response -->
      <div class="modal" tabindex="-1" role="dialog" id="alertModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <p id="bodyText"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <script>
          // autopopulate the course list in the select box
          $(document).ready(function() {
            // get the courses
            $.ajax({
              type: "GET",
              url: "/CSE442-542/2019-Summer/cse-442b/getClasses.php"
            }).then(function(result) {
              // parse the json string
              result = JSON.parse(result);

              // loop through the course objects
              result.courses.map(function(course) {
                // get the select box element
                select = document.getElementById('course');

                // add another option for the class
                select.options[select.options.length] = new Option(course.courseName, course.courseId);
              });
            });
          });

         // bind enter key to send a message
          $(document).keypress(function(e){
              if (e.which == 13){

                // prevent the default action
                e.preventDefault();

                // call send the email
                sendMessage();
              }
          });

          function sendMessage() {
            // get the inputted email
            var email = $("#email").val() || "",
                course = $("#course").val() || "",
                courseName = $( "#course option:selected" ).text();

            // check if the email is null
            if (email === "" || courseName == "Choose Course" || courseName == "") {
              return;
            }

            // call the php script to send the email
            $.ajax({
              type: "POST",
              url: "/CSE442-542/2019-Summer/cse-442b/email/sendStudentEmail.php",
              data: {
                email: email,
                course: course,
                courseName: courseName
              }
            }).then(function(result) {
              // set the modal text
              if(result.indexOf("error")>-1){
                var res = JSON.parse(result);
                document.getElementById("bodyText").innerHTML = res.error.msg;

                // clear the email value
                $("#email").val("");
                $("#course").val("Choose Course");
                $("#alertModal").modal('show');
                return;
              }
              // clear the email value
              $("#email").val("");
              $("#course").val("Choose Course");

              // show the modal
              window.location.href = "/CSE442-542/2019-Summer/cse-442b/ConfirmationCodePage.html"

            });
          }
      </script>
    </div>
</div>
