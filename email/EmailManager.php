
<?php
    /**
     * Configures the email so messages can be sent to students
     */
    require 'PHPMailerAutoload.php';

    class Email extends PHPMailer {

        /**
         * Constructor to configure the email -- all should be changed to pull from the database
         */
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
             // $this->SMTPDebug = 2; //Uncomment to show email errors
             $this->FromName = 'CSE 442/542 Evaluation Code';
         }
        /**
         * Sends an email to an array of addresses
         */
        public function sendMessage($to, $subject, $message, $altMessage = ""){

             // sets the subject and the message
             $this->Subject = $subject;
             $this->Body = $message;
             $this->AltBody = $altMessage;

             // adds the addresses
             foreach ($to as $address) {
                $this->AddAddress($address);
             }

             // clears the addresses
             if(!$this->send()) {
                $this->ClearAddresses();
                 return false;
             }

             $this->ClearAddresses();
             return true;

        }
    }
?>
