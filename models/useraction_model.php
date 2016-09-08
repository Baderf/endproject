<?php

class useraction_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function checkIfUserExists($userhash, $event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT * FROM $tablename WHERE hash = '$userhash'");

        if($sql -> num_rows == 1){
            $user = $sql -> fetch_assoc();
            return $user;
        }

        return false;
    }

    public function setViewed($user_id, $mail_id, $event_id, $mail_type){
        $tablename = "users_mails_".$event_id;

        switch ($mail_type) {
            case "std":
                $sql_type = "std_viewed";
                $sql_id = "std_id";
                break;
            case "invitation":
                $sql_type = "invitation_viewed";
                $sql_id = "invitation_id";
                break;
            case "reminder":
                $sql_type = "reminder_viewed";
                $sql_id = "reminder_id";
                break;
            case "info":
                $sql_type = "info_viewed";
                $sql_id = "info_id";
                break;
            case "ty":
                $sql_type = "ty_viewed";
                $sql_id = "ty_id";
                break;
        }

        $sql = $this -> db -> query("UPDATE $tablename SET `$sql_type` = 1, `$sql_id` = $mail_id WHERE user_id = $user_id");

        if($sql){
            return true;
        }else{
            return false;
        }

    }

    public function getFormularID($event_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id");

        if($sql -> num_rows == 1){
            $formular = $sql -> fetch_assoc();
            return $formular;
        }else{
            return false;
        }

    }

    public function getFormularDetails($formular_id){
        $sql = $this->db->query("SELECT * FROM formulars WHERE id = $formular_id");

        if($sql -> num_rows == 1){
            $formular = $sql -> fetch_assoc();
        }

        return $formular;
    }

    public function getFormularStandardfields($formular_id){
        $sql = $this -> db -> query ("SELECT * FROM standard_formular_fields");

        if($sql -> num_rows > 0){
            $standard_fields = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $standard_fields;
    }

    public function getUserFormular($formular_id, $user_form_id){
        $sql = $this -> db -> query("SELECT * FROM user_formular_fields WHERE id = $user_form_id AND formular_id = $formular_id");

        if($sql -> num_rows > 0){
            $user_fields = $sql -> fetch_assoc();
        }

        return $user_fields;
    }

    public function getEventInformation($event_id){
        $sql = $this -> db -> query("SELECT * FROM events WHERE id = $event_id");

        if($sql -> num_rows == 1){
            $event = $sql -> fetch_assoc();
            return $event;
        }else{
            return $event;
        }
    }

    public function getUserInfos($user_id, $event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT * FROM $tablename WHERE id = $user_id");

        if($sql -> num_rows == 1){
            $user = $sql -> fetch_assoc();
            return $user;
        }
        return false;
    }

    public function checkForUserFields($event_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id");

        if($sql -> num_rows > 0){
            $form_id = $sql -> fetch_assoc();
            if($form_id["form_id"] != 0){
                $form_id = $form_id['form_id'];
                $sql = $this -> db -> query("SELECT user_field_ids, id FROM formulars WHERE id = $form_id");
                if($sql -> num_rows > 0){
                    $user_field_ids = $sql -> fetch_assoc();

                    if($user_field_ids['user_field_ids'] != "0"){
                        return $user_field_ids;
                    }else{
                        return false;
                    }

                }else{
                    return false;
                }

            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function updateUserData($event_id, $user_id, $user_data = array(), $user_fields = array()){
        $tablename = "users_event_".$event_id;

        $this -> where = "UPDATE ".$tablename . " SET ";

        $numuserItems = count($user_data);
        $e = 0;

        foreach( $user_data as $key => $val ){
            if(++$e === $numuserItems && empty($user_fields)){
                $this -> where .= "$key = \"$val\"";
            }elseif(++$e === $numuserItems && !empty($user_fields)){
                $this -> where .= "$key = \"$val\",";
            }else{
                $this -> where .= "$key = \"$val\",";
            }

        }

        if(!empty($user_fields)){

            $numItems = count($user_fields);
            $f = 0;

            foreach ( $user_fields as $key => $val ){
                if(++$f === $numItems){
                    $this -> where .= "`$key` = \"$val\"";
                }else{
                    $this -> where .= "`$key` = \"$val\",";
                }
            }
        }



        $this -> where .= " WHERE id = $user_id";

        if($sql = $this -> db -> query($this -> where)){
            return true;
        }else{
            return false;
        }



    }

    public function userParticipate($event_id, $hash){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("UPDATE $tablename SET accepted = 1, canceled = 0 WHERE hash = $hash");

        if($sql){
            return true;
        }
        return false;
    }

    public function sendConfirmation($hash, $event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT sex, lastname, email FROM `$tablename` WHERE `hash` = '$hash'");
        if($sql -> num_rows == 1){
            $user = $sql -> fetch_assoc();

            $sql = $this -> db -> query("SELECT id, user_id, subject, sender, sender_adress, preview FROM mails WHERE event_id = $event_id AND mail_type = 'confirmation'");

            if($sql -> num_rows == 1){
                $mail_infos = $sql -> fetch_assoc();

                $mail = new mailservice();

                if($mail_errors = $mail -> sendConfirmationMail($mail_infos, $user)){
                    return true;
                }else{
                    return $mail_errors;
                }



            }
            
            
        }
    }

    public function getSuccessFeedback($form_id){
        $sql = $this -> db -> query("SELECT action_target FROM formulars WHERE id = $form_id");

        if($sql -> num_rows == 1){
            $action = $sql -> fetch_assoc();
            return $action;
        }

        return false;
    }

    public function cancelUser($hash, $event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("UPDATE $tablename SET canceled = 1, accepted = 0 WHERE hash = '$hash'");
        if($sql){
            return true;
        }else{
            return false;
        }
    }

}