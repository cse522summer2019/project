
<?php
    /**
     *  Handles sending emails out in the system
     */


    require 'PHPMailerAutoload.php';

    class Email extends PHPMailer{
        //Email server details
        private const hostname = "smtp.gmail.com";
        private const port = 587;
        private const username = "noreply.evaluation.code@gmail.com";
        private const from = "noreply.evaluation.code@cse-buffalo.edu"; //Emaill to show as sending from
        private const password = "Examp1e!";

        public function __construct(){
            parent::__construct(true);

            $this->isSMTP();
            $this->Port = self::port;
            $this->Host = self::hostname;
            $this->SMTPAuth = true;
            $this->Username = self::username;
            $this->Password = self::password;
            $this->SMTPSecure = 'tls';
            $this->WordWrap = 50;
            $this->isHTML(true);
            $this->setFrom(self::from);
            $this->SMTPDebug = 2; //Uncomment to show email errors
            $this->FromName = 'CSE 442/542 Evaluation'; //Pull from database
        }

        /**
         *  Sends the email out
         * to - array - list of email addresses to send out to
         * subject - string - Subject line in the email
         * message - HTML message for the body of the email
         * altMessage - message to show when HTML is not supported
         */
        public function sendMessage($to, $subject, $message, $altMessage = ""){

             $this->Subject = $subject;
             $this->Body    = $message;
             foreach ($to as $address) {
                $this->AddAddress($address);
             }
             $this->AltBody = $altMessage;



             if(!$this->send()) {
                $this->ClearAddresses(); //Clear addresses to possibly reuse email object
                 return false;
             }

             $this->ClearAddresses();
             return true;

        }
    }
?>
