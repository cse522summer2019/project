
<!DOCTYPE html>

<html lang="en">
<head>
  <style>

  .form_bg {
      padding:20px;
      border-radius:10px;
      position: absolute;
      border:1px solid #fff;
      margin: auto;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
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
  <div class="jumbotron" >
     <h3>Login to Evaluation System</h3>
     <p> Enter your UB Email to get a confirmation code to access your evaluation. The code must be used within 15 minutes or you must request a new one.</p>
  </div>


    <div class="row">
      <div class="form_bg">

      <!-- Email form to get a confirmation code -->
      <form>
           <h2 class="text-center">Enter UB Email:</h2>
          <br/>
          <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="align-center">
              <button type="button" onclick="event.preventDefault(); sendMessage()" class="btn btn-primary" id="login">Get Code</button>
          </div>
      </form>

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

          function sendMessage() {
            // get the inputted email
            var email = $("#email").val() || "";

            // check if the email is null
            if (email === "") {
              return;
            }

            // call the php script to send the email
            $.ajax({
              type: "POST",
              url: "/CSE442-542/2019-Summer/cse-442b/email/sendStudentEmail.php",
              data: {email: email}
            }).then(function(result) {
              // set the modal text
              document.getElementById("bodyText").innerHTML = result;

              // clear the email value
              $("#email").val("");

              // show the modal
              $("#alertModal").modal('show');
            });
          }
      </script>
    </div>
</div>
