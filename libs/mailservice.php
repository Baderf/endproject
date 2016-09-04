<?php

class mailservice extends model{

    public $errors = array();



    public function sendCampaign($mail_id, $user_id){

        //error_reporting(-1);


        $sql = $this -> db -> query("SELECT mail_type, event_id, subject, sender, sender_adress, preview FROM mails where id = $mail_id and user_id = $user_id");

        if($sql){
            $mail_settings = $sql -> fetch_assoc();
        }else{
            $error = "There was a problem to fetch your email settings! Please check all settings again!";
            array_push($this -> errors, $error);
            return $this -> errors;
        }

        $tablename = "users_mails_".$mail_settings['event_id'];
        $tablename2 = "users_event_".$mail_settings['event_id'];

        switch ($mail_settings['mail_type']) {
            case "invitation":
                $sql_type = "invitation_sent";
                break;
            case 'reminder':
                $sql_type = "reminder_sent";
                break;
            case "savethedate":
                $sql_type = "std_sent";
                break;
            case "info":
                $sql_type = "info_sent";
                break;
            case "thankyou":
                $sql_type = "ty_sent";
                break;
        }

        // SELECT id, hash, firstname, lastname, sex, email

        $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.$sql_type != 1");

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
        $mail->isHTML(true);

        $mail->setFrom('florian.bader.merken@gmail.com', "Mailpig");

        $mail->Subject = $mail_settings['subject'];
        //$mail->addReplyTo('@florian.bader.merken@gmail.com', 'Information');

                                         // Set email format to HTML


        // $mail -> Body = "TEST <img src=\"http://www.example.com/checkopen.php?user_id=20\" />";

        //ob_start();


        // Send Mail:

        $user_file = "usermedia_" . sessions::get("userid") . "/";
        $mail_file = "mails/mail_html/mail_" . $mail_id . ".html";

        foreach ($users as $user){
            $mail->ClearAllRecipients();
            $mail->addAddress($user['email'], $user['lastname'] . " " . $user['firstname']);     // Add a recipient

            $link_yes = "baderflorian.at/accepting/EVENT_ID/MAIL_TYPE/HASH/ID";
            $link_no = "baderflorian.at/cancel/EVENT_ID/MAIL_TYPE/HASH/ID";

            ob_start();
            $mail_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file);
            $mail -> Body = $mail_content;

            str_replace("###AUTHCODE-YES###", $link_yes, $mail->Body);
            str_replace("###AUTHCODE-NO###", $link_no, $mail->Body);

            // ###AUTHCODE-YES###

            ob_end_clean();

            if(!$mail->send()) {
                $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
                $error = "There was a problem to find your event users! Please try again later!";
                array_push($this->errors, $error);
            } else {
                // Update user
                if($this -> updateUserSent($user['id'], $mail_settings['mail_type'], $mail_settings['event_id'])){
                    continue;
                }else{
                    $error = "User couldn't be updated!";
                    array_push($this ->errors, $error);
                    continue;
                }

            }


        }

        if(!isset($error)){
            return true;
        }else{
            return $this->errors;
        }



    }

    public function updateUserSent($user_id, $mail_type, $event_id){

        switch ($mail_type) {
            case "invitation":
                $sql_type = "invitation_sent";
                break;
            case 'reminder':
                $sql_type = "reminder_sent";
                break;
            case "savethedate":
                $sql_type = "std_sent";
                break;
            case "information":
                $sql_type = "info_sent";
                break;
            case "thankyou":
                $sql_type = "ty_sent";
                break;
        }

        $tablename = "users_mails_".$event_id;
        $sql = $this -> db -> query("UPDATE $tablename SET $sql_type = '1' WHERE user_id = $user_id");

        echo "\"UPDATE $tablename SET `$sql_type` = '1' WHERE user_id = $user_id\"";
        var_dump($sql);

        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function sendTestMail($mail_id, $user_id, $email){

    }

    public function sendUserMail($mail_id, $user_id, $event_user_id){

    }




}