
<?php
    /**
     * Configures the email so messages can be sent to students
     */
    require 'PHPMailerAutoload.php';

    class Email extends PHPMailer {

        /**
         * Constructor to configure the email -- all should be changed to pull from the database
         */
        public function __construct(){
            parent::__construct(true);

            $this->isSMTP();
            $this->Port = 587;
            $this->Host = "smtp.gmail.com";
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';
            $this->WordWrap = 50;
            $this->isHTML(true);
            $this->setFrom("noreply.evaluation.code@cse-buffalo.edu");
            $this->FromName = 'CSE 442/542 Evaluation'; //Pull from database
            $this->Username = "noreply.evaluation.code@gmail.com";
            $this->Password = "Examp1e!";
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
