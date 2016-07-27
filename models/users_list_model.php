<?php

class users_list_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function getUserDataEvent($event_id){
        $table_name = "users_event_".$event_id;

        $sql = $this -> db -> query ("SELECT firstname, lastname, email FROM $table_name");

        if($sql -> num_rows > 0){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $users;
    }

    public function createNewEventUser($event_id, $firstname, $lastname, $sex, $proftitle, $enterprise, $birthday, $email, $fulladress, $street, $housenumber, $city, $postal, $salutation, $trailingtitle, $function, $department){
        $table_name = "users_event_" . $event_id;

        $stmt = $this -> db -> prepare("INSERT INTO $table_name (firstname, lastname, sex, professionaltitle, enterprise, birthday, email, fulladress, street, housenumber, city, postal, salutation, trailingtitle, function, department) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt -> bind_param("ssssssssssssssss", $firstname, $lastname, $sex, $proftitle, $enterprise, $birthday, $email, $fulladress, $street, $housenumber, $city, $postal, $salutation, $trailingtitle, $function, $department);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function getUserFields($event_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id");

        $res = $sql -> fetch_assoc();
        if ( $res[0] == 0){
            return false;
        }else{
            $form_id = $res[0];
            $sql -> query("SELECT user_field_ids FROM formulars WHERE id = $form_id");

            if($sql -> num_rows > 0){
                $res = $sql -> fetch_assoc();

                return $res;
            }

            return false;

        }



    }


}