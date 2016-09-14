<?php

class mailservice extends model{

    public $errors = array();



    public function sendCampaign($mail_id, $user_id){

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
                $query = ("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0");
                break;
            case 'reminder':
                $query = ("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 1 AND $tablename2.accepted = 0 AND $tablename2.canceled = 0");
                break;
            case "savethedate":
                $query = ("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0 AND $tablename.std_sent = 0 AND $tablename.reminder_sent = 0 AND $tablename.info_sent = 0 AND $tablename.ty_sent = 0");
                break;
            case "info":
                $query = ("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
            case "thankyou":
                $query = ("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
        }

        // SELECT id, hash, firstname, lastname, sex, email

        $sql = $this -> db -> query($query);

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
        $mail->addReplyTo($mail_settings['sender_adress'], $mail_settings['sender']);

                                         // Set email format to HTML


        // $mail -> Body = "TEST <img src=\"http://www.example.com/checkopen.php?user_id=20\" />";

        //ob_start();


        // Send Mail:

        $user_file = "usermedia_" . sessions::get("userid") . "/";
        $mail_file = "mails/mail_html/mail_" . $mail_id . ".html";

        $users_sent = 0;

        foreach ($users as $user){
            $mail->ClearAllRecipients();
            $mail->addAddress($user['email'], $user['lastname'] . " " . $user['firstname']);     // Add a recipient

            ob_start();
            $mail_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file);

            $pattern_yes = '/###AUTHCODE-YES###/';
            $replacement_yes = 'http://www.baderflorian.at/useraction/participate/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

            $pattern_no = '/###AUTHCODE-NO###/';
            $replacement_no = 'http://www.baderflorian.at/useraction/canceled/' . $user['hash'] . '/'.$mail_settings['event_id'];

            $pattern_view = '/###IMGVIEW###/';
            $replacement_view = 'http://www.baderflorian.at/useraction/viewed/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

            $pattern_salutation = '/###Salutation###/';
            if($user['sex'] == "Male"){
                $sex = "Mr. ";
            }elseif ($user['sex'] == "Female" ){
                $sex = "Ms. ";
            }
            $replacement_salutation = 'Dear ' . $sex . $user['lastname'];

            $text = (string)$mail_content;

            $new_content = preg_replace($pattern_yes, $replacement_yes, $mail_content, -1 );
            $new_content2 = preg_replace($pattern_no, $replacement_no, $new_content, -1 );
            $new_content3 = preg_replace($pattern_salutation, $replacement_salutation, $new_content2, -1 );
            $new_content4 = preg_replace($pattern_view, $replacement_view, $new_content3, -1 );



            $mail -> Body = $new_content4;

            ob_end_clean();

            if(!$mail->send()) {
                $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
                array_push($this->errors, $error);
            } else {
                // Update user
                if($this -> updateUserSent($user['id'], $mail_settings['mail_type'], $mail_settings['event_id'])){
                    $users_sent++;
                    if($users_sent === 1){
                        if($this -> updateSentMailEvent($mail_settings['event_id'], $mail_settings['mail_type'], $mail_id)){
                            continue;
                        }else{
                            $error = "Event couldn't be updated!";
                            array_push($this ->errors, $error);
                            continue;
                        }
                    }else{
                        continue;
                    }

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

    public function updateSentMailEvent($event_id, $mail_type, $mail_id){

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
            case "info":
                $sql_type = "info_sent";
                break;
            case "thankyou":
                $sql_type = "ty_sent";
                break;
        }


        $sql = $this -> db -> query("UPDATE events SET $sql_type = 1 WHERE id = $event_id");

        if($sql){
            $sql = $this -> db -> query("UPDATE mails SET already_sent = 1 WHERE id = $mail_id");

            if($sql){
                return true;
            }else{
                return false;
            }
        }

        return false;
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
            case "confirmation":
                return true;
        }

        $tablename = "users_mails_".$event_id;
        $sql = $this -> db -> query("UPDATE $tablename SET $sql_type = 1 WHERE user_id = $user_id");

        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function sendTestMail($mail_id, $user_id, $email, $event_id){
        $sql = $this -> db -> query("SELECT mail_type, event_id, subject, sender, sender_adress, preview FROM mails where id = $mail_id and user_id = $user_id");

        if($sql){
            $mail_settings = $sql -> fetch_assoc();
        }else{
            $error = "There was a problem to fetch your email settings! Please check all settings again!";
            array_push($this -> errors, $error);
            return $this -> errors;
        }

        if(!$this -> validate_email($email)){
            $error = "The email: " . $email . " is not valid. Plese correct it and try again!";
            array_push($this -> errors, $error);

            return $this -> errors;
        }

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

        $mail->Subject = "Testmail: " . $mail_settings['subject'];


        $user_file = "usermedia_" . sessions::get("userid") . "/";
        $mail_file = "mails/mail_html/mail_" . $mail_id . ".html";


        $mail->ClearAllRecipients();
        $mail->addAddress($email);     // Add a recipient

        ob_start();
        $mail_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file);

        $pattern_yes = '/###AUTHCODE-YES###/';
        $replacement_yes = 'http://www.baderflorian.at/useraction/participate/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

        $pattern_no = '/###AUTHCODE-NO###/';
        $replacement_no = 'http://www.baderflorian.at/useraction/canceled/' . $user['hash'] . '/'.$mail_settings['event_id'];

        $pattern_view = '/###IMGVIEW###/';
        $replacement_view = 'http://www.baderflorian.at/useraction/viewed/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

        $pattern_salutation = '/###Salutation###/';
        if($user['sex'] == "Male"){
            $sex = "Mr. ";
        }elseif ($user['sex'] == "Female" ){
            $sex = "Ms. ";
        }else{
            $sex = "Mr. ";
        }

        $replacement_salutation = 'Dear ' . $sex . "Testuser";

        $new_content = preg_replace($pattern_yes, $replacement_yes, $mail_content, -1 );
        $new_content2 = preg_replace($pattern_no, $replacement_no, $new_content, -1 );
        $new_content3 = preg_replace($pattern_salutation, $replacement_salutation, $new_content2, -1 );
        $new_content4 = preg_replace($pattern_view, $replacement_view, $new_content3, -1 );



        $mail -> Body = $new_content4;

        ob_end_clean();

        if(!$mail->send()) {
            $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
            array_push($this->errors, $error);
        } else {
            return true;
        }

        return false;

    }

    public function sendUserMail($mail_id, $user_id, $event_id){
        $sql = $this -> db -> query("SELECT mail_type, event_id, subject, sender, sender_adress, preview FROM mails WHERE id = $mail_id");

        if($sql){
            $mail_settings = $sql -> fetch_assoc();
        }else{
            $error = "There was a problem to fetch your email settings! Please check all settings again!";
            array_push($this -> errors, $error);
            return $this -> errors;
        }

        $tablename = "users_event_".$event_id;
        $sql = $this -> db -> query("SELECT id, sex, firstname, lastname, email, hash FROM $tablename WHERE id=$user_id");

        if($sql -> num_rows == 1){
            $user = $sql -> fetch_assoc();
        }else{
            $error = "There was a problem getting you user!";
            array_push($this -> errors, $error);
            return $this -> errors;
        }

        if(!$this -> validate_email($user['email'])){
            $error = "The email: " . $user['email'] . " is not valid. Plese correct it and try again!";
            array_push($this -> errors, $error);

            return $this -> errors;
        }



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


        $user_file = "usermedia_" . sessions::get("userid") . "/";
        $mail_file = "mails/mail_html/mail_" . $mail_id . ".html";

        $users_sent = 0;

        $mail->ClearAllRecipients();
        $mail->addAddress($user['email']);     // Add a recipient

        ob_start();
        $mail_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file);

        $pattern_yes = '/###AUTHCODE-YES###/';
        $replacement_yes = 'http://www.baderflorian.at/useraction/participate/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

        $pattern_no = '/###AUTHCODE-NO###/';
        $replacement_no = 'http://www.baderflorian.at/useraction/canceled/' . $user['hash'] . '/'.$mail_settings['event_id'];

        $pattern_view = '/###IMGVIEW###/';
        $replacement_view = 'http://www.baderflorian.at/useraction/viewed/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

        $pattern_salutation = '/###Salutation###/';
        if($user['sex'] == "Male"){
            $sex = "Mr. ";
        }elseif ($user['sex'] == "Female" ){
            $sex = "Ms. ";
        }
        $replacement_salutation = 'Dear ' . $sex . $user['lastname'];

        $text = (string)$mail_content;

        $new_content = preg_replace($pattern_yes, $replacement_yes, $mail_content, -1 );
        $new_content2 = preg_replace($pattern_no, $replacement_no, $new_content, -1 );
        $new_content3 = preg_replace($pattern_salutation, $replacement_salutation, $new_content2, -1 );
        $new_content4 = preg_replace($pattern_view, $replacement_view, $new_content3, -1 );



        $mail -> Body = $new_content4;

        ob_end_clean();

        if(!$mail->send()) {
            $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;

            array_push($this->errors, $error);
        } else {
            if($this -> updateUserSent($user_id, $mail_settings['mail_type'], $event_id)){
                return true;
            }

        }

        return $this->errors;
    }

    public function sendConfirmationMail($mail_infos, $user){

        if(!$this -> validate_email($user['email'])){
            $error = "The email: " . $user['email'] . " is not valid. Plese correct it and try again!";
            array_push($this -> errors, $error);

            return $this -> errors;
        }



        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'florian.bader.merken@gmail.com';                 // SMTP username
        $mail->Password = 'Schnappi33!';                                    // SMTP password
        $mail->SMTPSecure = 'tls';                                          // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        //$mail->SMTPDebug = 2;
        $mail->isHTML(true);

        $mail->setFrom('florian.bader.merken@gmail.com', "Mailpig");

        $mail->Subject = $mail_infos['subject'];


        $user_file = "usermedia_" . $mail_infos['user_id'] . "/";
        $mail_file = "mails/mail_html/mail_" . $mail_infos['id'] . ".html";


        $users_sent = 0;

        $mail->ClearAllRecipients();
        $mail->addAddress($user['email']);     // Add a recipient

        ob_start();
        $mail_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/" . APPS . 'app_backend/' . APP_PUBLIC . "media/" . $user_file . $mail_file);

        $pattern_yes = '/###AUTHCODE-YES###/';
        $replacement_yes = 'http://www.baderflorian.at/useraction/participate/' . $user['hash'] . '/'.$mail_id. '/'.$mail_settings['event_id']. '/' . $mail_settings['mail_type'];

        $pattern_no = '/###AUTHCODE-NO###/';
        $replacement_no = 'http://www.baderflorian.at/useraction/canceled/' . $user['hash'] . '/'.$mail_settings['event_id'];

        $pattern_salutation = '/###Salutation###/';
        if($user['sex'] == "Male"){
            $sex = "Mr. ";
        }elseif ($user['sex'] == "Female" ){
            $sex = "Ms. ";
        }
        $replacement_salutation = 'Dear ' . $sex . $user['lastname'];

        $text = (string)$mail_content;

        $new_content = preg_replace($pattern_yes, $replacement_yes, $mail_content, -1 );
        $new_content2 = preg_replace($pattern_no, $replacement_no, $new_content, -1 );
        $new_content3 = preg_replace($pattern_salutation, $replacement_salutation, $new_content2, -1 );



        $mail -> Body = $new_content3;

        ob_end_clean();



        if(!$mail->send()) {
            var_dump($mail->ErrorInfo);
            $error = "Mail could not be sent. Mailer Error: " . $mail->ErrorInfo;
            $error = "There was a problem to find your event users! Please try again later!";
            array_push($this->errors, $error);
        } else {
            return true;
        }

        return false;
    }
    
    public function validate_email($email){

        if(!preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $email))
            return false;
        list($prefix, $domain) = explode("@",$email);
        if(function_exists("getmxrr") && getmxrr($domain, $mxhosts))
            return true;
        elseif (@fsockopen($domain, 25, $errno, $errstr, 5))
            return true;
        else
            return false;

    }



}