<?php

class mailservice extends model{

    public $errors = array();



    public function sendCampaign($mail_id, $user_id){


        $sql = $this -> db -> query("SELECT event_id, subject, sender, sender_adress, preview FROM mails where id = $mail_id and user_id = $user_id");

        if($sql){
            $mail_settings = $sql -> fetch_assoc();
        }else{
            $error = "There was a problem to fetch your email settings! Please try again later!";
            array_push($this -> errors, $error);
            return $this -> errors;
        }

        $tablename = "users_event_".$mail_settings['event_id'];

        $sql = $this -> db -> query("SELECT id, hash, firstname, lastname, sex, email FROM $tablename");

        if($sql){
            $users = $sql->fetch_all(MYSQLI_ASSOC);
        }else{
            $error = "There was a problem to find your event users! Please try again later!";
            array_push($this->errors, $error);
            return $this -> errors;
        }

        // Prepare Mail:

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'florian.bader.merken@gmail.com';                 // SMTP username
        $mail->Password = 'Schnappi33!';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        //$mail->SMTPDebug = 2;

        $mail->setFrom('florian.bader.merken@gmail.com', "Mailpig");

        $mail->Subject = 'TEST Here is the subject';
        //$mail->addReplyTo('@florian.bader.merken@gmail.com', 'Information');

        $mail->isHTML(true);                                  // Set email format to HTML


        // TEST:
        $mail->ClearAllRecipients();
        $mail->addAddress("florian-bader@gmx.at", "Florian Bader");     // Add a recipient

        $link_yes = "baderflorian.at/accepting/EVENT_ID/MAIL_TYPE/HASH/ID";
        $link_no = "baderflorian.at/cancel/EVENT_ID/MAIL_TYPE/HASH/ID";

        $mail -> Body = "TEST <img src=\"http://www.example.com/checkopen.php?user_id=20\" />";

        //ob_start();

        //str_replace("###AUTHCODE-YES###", $link_yes, $mail->Body);
       // str_replace("###AUTHCODE-NO###", $link_no, $mail->Body);

        // ###AUTHCODE-YES###

        //ob_end_clean();

        if(!$mail->send()) {
            echo "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
            //$error = "There was a problem to find your event users! Please try again later!";
            //array_push($this->errors, $error);
            return false;
        } else {
            return true;
        }


        // Send Mail:
        /*
        $user_file = "usermedia_" . sessions::get("userid") . "/";
        $mail_file = "mails/mail_edit/mail_" . $data['mail_id'] . ".html";

        foreach ($users as $user){
            $mail->ClearAllRecipients();
            $mail->addAddress($user['email'], $user['lastname'] . " " . $user['fistname']);     // Add a recipient

            $link_yes = "baderflorian.at/accepting/EVENT_ID/MAIL_TYPE/HASH/ID";
            $link_no = "baderflorian.at/cancel/EVENT_ID/MAIL_TYPE/HASH/ID";

            ob_start();
            $mail -> Body = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file);
            str_replace("###AUTHCODE-YES###", $link_yes, $mail->Body);
            str_replace("###AUTHCODE-NO###", $link_no, $mail->Body);

            // ###AUTHCODE-YES###

            ob_end_clean();

            if(!$mail->send()) {
                $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
                $error = "There was a problem to find your event users! Please try again later!";
                array_push($this->errors, $error);
            } else {
                continue;
            }

        }
         */

        return true;


    }

    public function sendTestMail($mail_id, $user_id, $email){

    }

    public function sendUserMail($mail_id, $user_id, $event_user_id){

    }




}