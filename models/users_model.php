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
}