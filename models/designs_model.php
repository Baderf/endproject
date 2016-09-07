<?php

class designs_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function saveMail($user_id, $mail_id, $fulltext, $emailtext){
        $update_time = date("d/m/Y h:s a");
        $mail = "mail_" . $mail_id;
        $mailfile = $mail . ".html";
        $user_file = "usermedia_" . $user_id;

        $userfile_fulltext = $_SERVER['DOCUMENT_ROOT'] . "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . "/mails/mail_edit/" . $mailfile;
        $userfile_email = $_SERVER['DOCUMENT_ROOT'] . "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . "/mails/mail_html/" . $mailfile;

        if(file_put_contents($userfile_fulltext, $fulltext)){
            if(file_put_contents($userfile_email, $emailtext)){
                $stmt = $this -> db -> prepare("UPDATE mails SET last_update = ? WHERE id = ? AND user_id = ?");
                $stmt -> bind_param("sii", $update_time, $mail_id, $user_id);

                if($stmt->execute()){
                    $stmt -> close();
                    return true;
                }else{
                    $stmt -> close();
                    return false;
                }
            }
        };
        ;



    }

    public function createTemplate($user_id, $mail_id, $title){
        $mail = "mail_" . $mail_id;

        $sql = $this -> db -> query("SELECT * FROM mail_templates WHERE template_mail = '$mail' AND user_id = $user_id");

        if ($sql -> num_rows == 0){
            $mail = "mail_".$mail_id;
            $stmt = $this -> db -> prepare("INSERT INTO mail_templates (user_id, title, template_mail) VALUES(?,?,?)");
            $stmt -> bind_param("iss", $user_id, $title, $mail);
            if($stmt -> execute()){
                $stmt -> close();
                return true;
            }else {
                return false;
            }
        }
    }

    public function getMailInfos($mail_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM mails WHERE id = $mail_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows > 0){
            $mail = $sql -> fetch_assoc();
        }

        return $mail;
    }

    public function savemailsettings($user_id, $mail_id, $title, $sender, $sender_adress, $subject, $preview_text){
        $stmt = $this -> db -> prepare("UPDATE mails SET title = ?, sender = ?, subject = ?, sender_adress = ?, preview = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("sssssii", $title, $sender, $subject, $sender_adress, $preview_text, $mail_id, $user_id);

        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }

        $stmt -> close();
        return false;
    }

    public function getEventInfos($event_id, $user_id){
        $sql = $this -> db -> query("SELECT enterprise FROM events WHERE id = $event_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows == 1){
            $event_info = $sql -> fetch_assoc();
        }

        return $event_info;
    }

    public function getAllUserMails($user_id){
       $sql = $this -> db -> query("SELECT 
                                    mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.user_id = $user_id");
        if($sql -> num_rows > 0){
            $mails = $sql ->fetch_all(MYSQLI_ASSOC);
        }

        return $mails;

    }

    public function checkIfIsTemplate($user_id, $mail_id){
        $mail = "mail_".$mail_id;
        $sql = $this -> db -> query("SELECT * FROM mail_templates WHERE user_id = $user_id AND template_mail = '$mail' LIMIT 1");

        if($sql -> num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getUserTemplates($user_id){
        $sql = $this -> db -> query("SELECT *
                                     FROM mail_templates
                                     WHERE user_id = $user_id
        ");

        if($sql -> num_rows > 0){
            $templates = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $templates;
    }

    public function deleteUserTemplate($user_id, $mail_id){
        $mail = "mail_" . $mail_id;

        $stmt = $this -> db -> prepare("DELETE FROM mail_templates WHERE template_mail = ? AND user_id = ?");
        $stmt -> bind_param("si", $mail, $user_id);
        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }else{
            return false;
        }

    }

    public function createNewDesign($event_id, $user_id, $title, $type, $subject, $template = "default"){

        $stmt = $this -> db -> prepare("INSERT INTO mails (user_id, event_id, title, subject, mail_type) VALUES(?,?,?,?,?)");
        $stmt -> bind_param("iisss", $user_id, $event_id, $title, $subject, $type);
        if($stmt -> execute()){
            $this -> last_id = $stmt -> insert_id;

            $userfolder = $_SERVER['DOCUMENT_ROOT'] . "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/usermedia_" . $user_id;
            $usermailhtmlfolder = $userfolder . "/mails/mail_html";
            $usermaileditfolder = $userfolder . "/mails/mail_edit";
            $usermailtemplatefolder = $userfolder . "/mails/templates";

            if($template == "default"){
                $standard_template = $usermailtemplatefolder . "/standard.html";
            }else{
                $standard_template = $usermaileditfolder . "/" . $template . ".html";
            }


            $new_file_name = "mail_" . $this -> last_id . ".html";

            copy($standard_template, $usermaileditfolder . "/" . $new_file_name);
            copy($standard_template, $usermailhtmlfolder . "/" . $new_file_name);

            $stmt -> prepare("UPDATE mails SET file_edit_name = ?, file_mail_name = ? WHERE id = ?");
            $stmt -> bind_param("ssi", $new_file_name, $new_file_name, $this->last_id);
            if($stmt -> execute()){
                $stmt -> close();
                return $this -> last_id;
            }else{
                $stmt -> close();
                return "Update hat nicht funktioniert";
            }

        }else{
            return "Insert hat nicht funktioniert";
        }
    }

    public function getUserEvents($user_id){
        $sql = $this -> db -> query("SELECT title, id FROM events WHERE user_id = $user_id AND deleted = 0");

        if($sql -> num_rows > 0){
            $events = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $events;
    }


    public function checkMailTypesJSON($event_id, $user_id){
        $sql = $this -> db -> query("SELECT mail_type FROM mails WHERE event_id = $event_id AND user_id = $user_id LIMIT 6");

        if($sql -> num_rows > 0 && $sql ->num_rows < 7){
            $types = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return json_encode($types);
    }

    public function checkMailTypes($event_id, $user_id){
        $sql = $this -> db -> query("SELECT mail_type FROM mails WHERE event_id = $event_id AND user_id = $user_id LIMIT 5");

        if($sql -> num_rows > 0 && $sql ->num_rows < 6){
            $types = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $types;
    }

}