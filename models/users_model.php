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
            return $user_fields;
        }else{
            return false;
        }


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
            $numItems = count($user_data);

            $e = 0;

            foreach( $user_data as $key => $val ){
                if(++$e === $numItems){
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

            $numItems = count($user_fields);
            $i = 0;


            foreach ( $user_fields as $key => $val ){
                if(++$i === $numItems){
                    $this -> where .= "$key";
                }else{
                    $this -> where .= "$key,";
                }
            }
        }

        $this -> where .= ") VALUES(\"$hash\",";

        if (empty($user_fields)){
            $numItems = count($user_data);
            $f = 0;

            foreach( $user_data as $key => $val ){
                if(++$f === $numItems){
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

            $numItems = count($user_fields);
            $g = 0;

            foreach ( $user_fields as $key => $val ){
                if(++$g === $numItems){
                    $this -> where .= "\"$val\"";
                }else{
                    $this -> where .= "\"$val\",";
                }
            }
        }



        $this -> where .= ")";
        var_dump($this -> where);

        if($sql = $this -> db -> query($this -> where)){



            $this -> last_id = $this -> db -> insert_id;


            if($this -> insertUserMailTable($this->last_id, $event_id)){
                return true;
            }
        }

    }

    public function getEventMails($event_id){
        $sql = $this -> db -> query("SELECT * FROM mails WHERE event_id = $event_id");

        if($sql){
            $mails = $sql -> fetch_all(MYSQLI_ASSOC);
            return $mails;
        }

        return false;


    }

    public function insertUserMailTable($user_id, $event_id){
        $tablename2 = "users_mails_".$event_id;

        if($sql = $this -> db -> query("INSERT INTO $tablename2 (user_id) VALUES('$user_id') ")){
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

        $numuserItems = count($user_data);
        $e = 0;

        foreach( $user_data as $key => $val ){
            ++$e;

            if(($e === $numuserItems) && empty($user_fields)){
                $this -> where .= "$key = \"$val\"";
            }elseif($e === $numuserItems && !empty($user_fields)){
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

    public function getSearchedEvents($user_id, $search_text){
         $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id AND title LIKE '%$search_text%'");

        if($sql){
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

    public function getEventsWithFilter($user_id, $filter){

        $actualdate = time();

        if($filter == "all"){
            $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id");
        }elseif($filter == "progress"){
            $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id AND date_to_time > $actualdate ORDER BY date_to_time DESC");

        }elseif($filter == "completed"){
            $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id AND date_to_time < $actualdate ORDER BY date_to_time DESC");

        }elseif($filter == "latest"){
            $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id ORDER BY created_at DESC");

        }else{
            $sql = $this -> db -> query("SELECT id, title, created_at FROM events WHERE user_id = $user_id");
        }

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

    public function resetTypeStats($event_id, $user_id, $mail_type){
        $tablename = "users_mails_".$event_id;

        switch ($mail_type) {
            case "invitation":
                $sql_type = "invitation_sent";
                break;
            case 'reminder':
                $sql_type = "reminder_sent";
                break;
            case "std":
                $sql_type = "std_sent";
                break;
            case "info":
                $sql_type = "info_sent";
                break;
            case "ty":
                $sql_type = "ty_sent";
                break;
        }

        $sql = $this -> db ->query("UPDATE $tablename SET $sql_type = 0 WHERE user_id = $user_id");

        if($sql){
            return true;
        }else{
            return false;
        }

    }

    public function getResetOptions($event_id, $user_id){
        $tablename = "users_mails_" . $event_id;

        $sql = $this -> db -> query("SELECT * FROM $tablename WHERE user_id = $user_id");

        if($sql){
            $reset_options = $sql -> fetch_all(MYSQLI_ASSOC);
            return $reset_options;
        }

        return false;
    }

    public function getSendOptions($event_id, $user_id){
          $sql = $this -> db -> query("SELECT * FROM mails WHERE event_id = $event_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $send_options = $sql -> fetch_all(MYSQLI_ASSOC);
            return $send_options;
        }else {
            return false;
        }
    }

    public function setUserReaction($event_id, $user_id, $reaction){


        $tablename = "users_event_".$event_id;
        if($reaction == "participate"){
            if($sql = $this -> db -> query("UPDATE $tablename SET accepted = 1, canceled = 0 WHERE id= $user_id")){
                return true;
            }else{
                return false;
            }
        }elseif($reaction == "cancel"){
            if($sql = $this -> db -> query("UPDATE $tablename SET accepted = 0, canceled = 1 WHERE id = $user_id")){
                return true;
            }else{
                return false;
            }
        }else{
            if($sql = $this -> db -> query("UPDATE $tablename SET accepted = 0, canceled = 0 WHERE id = $user_id")){
                return true;
            }else{
                return false;
            }
        }
    }

    public function resetAllStats($event_id, $user_id){
        $tablename = 'users_mails_' . $event_id;


        $sql = $this -> db -> query("UPDATE $tablename SET 
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
                                      ty_viewed = 0
                                      WHERE user_id = $user_id
                                      ");

        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function deleteUser($event_id, $user_id){
        $tablename = "users_event_".$event_id;
        $tablename2 = "users_mails_".$event_id;

        $sql = $this -> db -> query("DELETE FROM $tablename WHERE id = $user_id");

        if($sql){
            $sql2 = $this -> db -> query("DELETE FROM $tablename2 WHERE user_id = $user_id");

            if($sql2){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getSearchedUsers($search_text, $event_id){
        $tablename = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT * FROM $tablename WHERE lastname LIKE '%$search_text%'");

        if($sql -> num_rows > 0){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
            return $users;
        }else{
            return false;
        }
    }

    public function getUsersWithFilter($filter, $event_id){
        $tablename = "users_event_".$event_id;

        if($filter == "all"){
            $sql = $this -> db -> query("SELECT * FROM $tablename");
        }elseif($filter == "accepted"){
            $sql = $this -> db -> query("SELECT * FROM $tablename WHERE accepted = 1 AND canceled = 0");

        }elseif($filter == "cancelled"){
            $sql = $this -> db -> query("SELECT * FROM $tablename WHERE accepted = 0 AND canceled = 1");

        }elseif($filter == "noaction"){
            $sql = $this -> db -> query("SELECT * FROM $tablename WHERE accepted = 0 AND canceled = 0");
        }

        if($sql -> num_rows > 0){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
            return $users;
        }else{
            return false;
        }
    }
}