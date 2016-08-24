<?php

class users_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public $where = "";
    public $last_id;

    public function getUsersByName( $name ){

        $res = $this -> db -> query("SELECT id, uname FROM users WHERE uname LIKE '%$name%'");

        if($res -> num_rows >= 1){

            $userList = $res -> fetch_all(MYSQLI_ASSOC);
            return json_encode($userList);
        }

        return false;
    }

    public function getUserFormular($formular_id, $user_form_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM user_formular_fields WHERE id = $user_form_id AND formular_id = $formular_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $user_fields = $sql -> fetch_assoc();
        }

        return $user_fields;
    }

    public function getUserData($event_id, $user_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query ("SELECT * FROM $tablename WHERE id = $user_id");

        if($sql -> num_rows > 0 ){
            $user = $sql -> fetch_assoc();
        }

        return $user;
    }

    public function insertNewUser($event_id, $user_data = array(), $user_fields = array()){
        $tablename = "users_event_".$event_id;
        $hash = sha1($user_data['lastname'] . $user_data['birthday']);

        $this -> where = "INSERT INTO ".$tablename . " (hash,";

        if (empty($user_fields)){
            $last_key = end(array_keys($user_data));
            foreach( $user_data as $key => $val ){
                if($key == $last_key){
                    $this -> where .= "$key";
                }else{
                    $this -> where .= "$key,";
                }
            }
        }else{
            foreach( $user_data as $key => $val ){
                    $this -> where .= "$key,";
            }
        }


        if(!empty($user_fields)){

            $last_key = end(array_keys($user_fields));
            foreach ( $user_fields as $key => $val ){
                if($key == $last_key){
                    $this -> where .= "$key";
                }else{
                    $this -> where .= "$key,";
                }
            }
        }

        $this -> where .= ") VALUES(\"$hash\",";

        if (empty($user_fields)){
            $last_key = end(array_keys($user_data));
            foreach( $user_data as $key => $val ){
                if($key == $last_key){
                    $this -> where .= "\"$val\"";
                }else{
                    $this -> where .= "\"$val\",";
                }
            }
        }else{
            foreach( $user_data as $key => $val ){
                $this -> where .= "\"$val\",";
            }
        }


        if(!empty($user_fields)){

            $last_key = end(array_keys($user_fields));

            foreach ( $user_fields as $key => $val ){
                if($key == $last_key){
                    $this -> where .= "\"$val\"";
                }else{
                    $this -> where .= "\"$val\",";
                }
            }
        }



        $this -> where .= ")";
        

        if($sql = $this -> db -> query($this -> where)){
            return true;
        }

    }

    public function getAllUsers($event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT id, firstname, lastname, email FROM $tablename");

        if($sql -> num_rows > 0){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $users;
    }

    public function getEventName($event_id){
        $sql = $this -> db -> query("SELECT title FROM events WHERE id = $event_id");

        if($sql -> num_rows == 1){
            $event_name = $sql -> fetch_assoc();
        }

        return $event_name;
    }
    
    public function updateUserData($event_id, $user_id, $user_data = array(), $user_fields = array()){
        $tablename = "users_event_".$event_id;

        $this -> where = "UPDATE ".$tablename . " SET ";

        foreach( $user_data as $key => $val ){
            $this -> where .= "$key = \"$val\",";
        }

        if(!empty($user_fields)){


            $last_key = end(array_keys($user_fields));


            foreach ( $user_fields as $key => $val ){
                if($key == $last_key){
                    $this -> where .= "$key = \"$val\"";
                }else{
                    $this -> where .= "$key = \"$val\",";
                }
            }
        }



        $this -> where .= " WHERE id = $user_id";

        if($sql = $this -> db -> query($this -> where)){
           return true;
        }



    }

    public function getAllEvents($user_id){
        $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id");

        if($sql -> num_rows >0){
            $events = $sql -> fetch_all(MYSQLI_ASSOC);

            foreach ($events as &$event){
                if($count = $this -> countUsers($event['id'])){
                    $event['count'] = $count;
                }else{
                    $event['count'] = "0";
                }

            }

            return $events;
        }

        return false;
    }

    public function countUsers($event_id){

        $tablename = "users_event_" . $event_id;
        $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename");

        if($sql -> num_rows > 0){
            $count = $sql ->fetch_row();

            return $count[0];
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

    public function getResetOptions($event_id, $user_id){
        $tablename = "users_mails_" . $event_id;

        $sql = $this -> db -> query("SELECT * FROM $tablename WHERE user_id = $user_id");

        if($sql -> num_rows > 0 ){
            $reset_options = $sql -> fetch_all(MYSQLI_ASSOC);
            return $reset_options;
        }

        return false;
    }

    public function resetAllStats($event_id, $user_id){
        $tablename = 'users_mails_' . $event_id;
        $last_update = date("m/d/Y g:i a");

        $stmt = $this -> db -> query("UPDATE $tablename SET 
                                      invitation_sent = 0,
                                      invitation_open = 0,
                                      invitation_viewed = 0,
                                      reminder_sent = 0,
                                      reminder_open = 0,
                                      reminder_viewed = 0,
                                      std_sent = 0,
                                      std_open = 0,
                                      std_viewed = 0,
                                      info_sent = 0,
                                      info_open = 0,
                                      info_viewed = 0,
                                      ty_sent = 0,
                                      ty_open = 0,
                                      ty_viewed = 0,
                                      last_update = $last_update
                                      WHERE user_id = $user_id
                                      ");
    }
}