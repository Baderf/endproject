<?php

class designs_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createNewDesign($event_id, $user_id, $title, $type, $subject){
        $in_progress = 1;


        $stmt = $this -> db -> prepare("INSERT INTO mails (user_id, event_id, title, subject, mail_type, in_progress) VALUES(?,?,?,?,?,?)");
        $stmt -> bind_param("iisssi", $user_id, $event_id, $title, $subject, $type, $in_progress);
        if($stmt -> execute()){
            $this -> last_id = $stmt -> insert_id;

            $userfolder = $_SERVER['DOCUMENT_ROOT'] . "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/usermedia_" . $user_id;
            $usermailhtmlfolder = $userfolder . "/mails/mail_html";
            $usermaileditfolder = $userfolder . "/mails/mail_edit";
            $usermailtemplatefolder = $userfolder . "/mails/templates";
            $standard_template = $usermailtemplatefolder . "/standard.html";
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
        $sql = $this -> db -> query("SELECT mail_type FROM mails WHERE event_id = $event_id AND user_id = $user_id LIMIT 5");

        if($sql -> num_rows > 0 && $sql ->num_rows < 6){
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