<?php

class formulars_model extends model{

    public $last_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function checkForEntries($formular_id, $user_id){
        $sql = $this -> db -> query("SELECT id, title FROM events WHERE form_id = $formular_id AND user_id = $user_id AND campaigns_sent = '1'");

        if($sql -> num_rows > 0){
            $linked_forms = $sql -> fetch_all(MYSQLI_ASSOC);
            return $linked_forms;
        }else{
            return false;
        }

    }

    public function getAllFormulars($user_id){
        $sql = $this -> db -> query("SELECT * FROM formulars WHERE user_id = $user_id");

        if($sql -> num_rows > 0){
            $formulars = $sql -> fetch_all(MYSQLI_ASSOC);
            return $formulars;
        }else{
            return false;
        }


    }

    public function createNewFormular($title, $user_id){

        $created_at = date("d/m/Y h:s a");

        $sql = $this -> db -> query("SELECT standard_active_field_ids, standard_deactive_field_ids FROM settings");
        if($sql -> num_rows == 1){
            $settings = $sql -> fetch_assoc();
        }

        $stmt = $this -> db -> prepare("INSERT INTO formulars (title, user_id, created_at, updated_at) VALUES(?,?,?,?)");
        $stmt -> bind_param("siss", $title, $user_id, $created_at, $created_at);
        if($stmt -> execute() && isset($settings)){
            $this -> last_id = $stmt -> insert_id;

            $stmt -> prepare("UPDATE formulars SET standard_field_ids = ?, deactive_standard_fields = ?  WHERE id = ?");
            $stmt -> bind_param("ssi", $settings['standard_active_field_ids'], $settings['standard_deactive_field_ids'], $this -> last_id);
            $stmt -> execute();
        }


        $stmt -> close();

        return true;
    }

    public function getUserFormular($formular_id, $user_form_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM user_formular_fields WHERE id = $user_form_id AND formular_id = $formular_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $user_fields = $sql -> fetch_assoc();
        }

        return $user_fields;
    }

    public function updateUserFormularDetails($formular_id, $user_id, $user_formular_ids){
        $update = date("d/m/Y h:s a");
        $stmt = $this -> db -> prepare("UPDATE formulars SET user_field_ids = ?, updated_at = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("ssii", $user_formular_ids, $update,$formular_id, $user_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function updateUserFormular($user_id, $formular_id, $user_form_id, $title, $type, $default_value, $data_values, $placeholder, $is_required = "true"){
        $update = date("d/m/Y h:s a");

        $stmt = $this -> db -> prepare("UPDATE user_formular_fields SET title = ?, type = ?, default_value = ?, data_values = ?, placeholder = ?, is_required = ? WHERE id = ? AND user_id = ? AND formular_id = ?");
        $stmt -> bind_param("ssssssiii", $title, $type, $default_value, $data_values, $placeholder, $is_required, $user_form_id, $user_id, $formular_id);
        if($stmt -> execute()){
            $stmt -> prepare("UPDATE formulars SET updated_at = ? WHERE id = ? AND user_id = ?");
            $stmt -> bind_param("sii", $update, $formular_id, $user_id);

            if($stmt ->execute()){
                $stmt -> close();
                return true;
            }

            return false;
        }

        return false;

    }

    public function createUserFormular($user_id, $formular_id, $title, $type, $default_value, $data_values, $placeholder, $is_required = "true"){
        $stmt = $this -> db -> prepare("INSERT INTO user_formular_fields (user_id, formular_id, title, type, default_value, data_values, placeholder, is_required) VALUES(?,?,?,?,?,?,?,?)");
        $stmt -> bind_param("iissssss", $user_id, $formular_id, $title, $type, $default_value, $data_values, $placeholder, $is_required);
        if($stmt -> execute()){
            $stmt -> prepare("UPDATE formulars SET updated_at = ? WHERE id = ? AND user_id = ?");
            $stmt -> bind_param("sii", $update, $formular_id, $user_id);

            if($stmt ->execute()){
                $stmt -> close();
                return true;
            }

            return false;
        }

        return false;

    }

    public function createUserColumns($event_ids, $formular_id){

        $sql = $this -> db -> query("SELECT user_field_ids FROM formulars WHERE id = $formular_id");


        if($sql -> num_rows >0){
            $user_fields = $sql -> fetch_assoc();

            $ids = explode("::", $user_fields['user_field_ids']);
            $user_ids = "";

            $numItems = count($ids);
            $g = 0;

            foreach ($ids as &$id) {
                $id = str_replace(":", "", $id);

                if(++$g === $numItems){
                    $user_ids .= $id;
                }else{
                    $user_ids .= $id . ",";
                }

            }

            // Namen holen:
            $sql = $this -> db -> query("SELECT title FROM user_formular_fields WHERE id IN ($user_ids)");

            if($sql -> num_rows >0){
                $result = $sql -> fetch_all(MYSQLI_ASSOC);

                if(count($result) != 0){
                    $numItems = count($result);
                    $i = 0;

                    $names = "";

                    foreach($result as $key => $val){
                        if(++$i === $numItems){
                            $names .= "ADD " . "`" . $val['title'] . "`" . " VARCHAR(200) NOT NULL";
                        }else{
                            $names .= "ADD " . "`" . $val['title']. "`" . " VARCHAR(200) NOT NULL" . ", ";
                        }


                    }


                    if($events = explode("::", $event_ids)) {
                        foreach ($events as $event) {
                            $event = str_replace(":", "", $event);

                            $tablename = "users_event_".$event;
                            $dec = "ALTER TABLE " . $tablename . " " . $names;

                            $sql = $this -> db -> query($dec);
                        }
                    }else {
                        $event = str_replace(":", "", $event_ids);

                        $tablename = "users_event_".$event;
                        $dec = "ALTER TABLE " . $tablename . " " . $names;

                        $sql = $this -> db -> query($dec);
                    }
                }

            }
            return true;
        }else{
            return false;
        }


    }

    public function deleteUserColumns($event_ids, $formular_id){

                $sql = $this -> db -> query("SELECT user_field_ids FROM formulars WHERE id = $formular_id");


                if($sql -> num_rows >0){
                    $user_fields = $sql -> fetch_assoc();

                    $ids = explode("::", $user_fields['user_field_ids']);
                    $user_ids = "";

                    $numItems = count($ids);
                    $g = 0;

                    foreach ($ids as &$id) {
                        $id = str_replace(":", "", $id);

                        if(++$g === $numItems){
                            $user_ids .= $id;
                        }else{
                            $user_ids .= $id . ",";
                        }

                    }

                    // Namen holen:
                    $sql = $this -> db -> query("SELECT title FROM user_formular_fields WHERE id IN ($user_ids)");

                    if($sql -> num_rows >0){
                        $result = $sql -> fetch_all(MYSQLI_ASSOC);

                        if(count($result) != 0){
                            $numItems = count($result);
                            $i = 0;

                            $names = "";

                            foreach($result as $key => $val){
                                if(++$i === $numItems){
                                    $names .= "DROP COLUMN " . "`" . $val['title'] . "`";
                                }else{
                                    $names .= "DROP COLUMN " . "`" . $val['title']. "`" . ", ";
                                }


                            }


                            if($events = explode("::", $event_ids)) {
                                foreach ($events as $event) {
                                    $event = str_replace(":", "", $event);

                                    $tablename = "users_event_".$event;
                                    $dec = "ALTER TABLE " . $tablename . " " . $names;

                                    $sql = $this -> db -> query($dec);
                                }
                            }else {
                                $event = str_replace(":", "", $event_ids);

                                $tablename = "users_event_".$event;
                                $dec = "ALTER TABLE " . $tablename . " " . $names;

                                $sql = $this -> db -> query($dec);
                            }
                        }

                    }
                    return true;
                }else{
                    return false;
                }

    }

    public function getLastIdFormulars(){
        $sql = $this -> db -> query("SELECT MAX(id) FROM user_formular_fields");

        if($sql -> num_rows == 1){
            $last_id = $sql -> fetch_row();
        }

        return $last_id;
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
    
    public function getFormularStandardActiveFields($formular_id){
        $sql = $this -> db -> query ("SELECT standard_field_ids FROM formulars WHERE id = $formular_id");

        if($sql -> num_rows > 0){
            $active_fields = $sql -> fetch_row();
        }

        return $active_fields;
    }

    public function getFormularUserFields($formular_id, $user_id){
        $sql = $this -> db -> query ("SELECT * FROM user_formular_fields WHERE user_id = $user_id");

        if($sql -> num_rows > 0){
            $standard_fields = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $user_fields;
    }

    public function updateStandardFields($formular_id, $active_standard_fields, $deactive_standard_fields){
        $update = date("d/m/Y h:s a");
        $stmt = $this -> db -> prepare("UPDATE formulars SET updated_at = ?, standard_field_ids = ?, deactive_standard_fields = ?  WHERE id = ?");
        $stmt -> bind_param("sssi", $update, $active_standard_fields, $deactive_standard_fields, $formular_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function updateFormularDetails($fomular_id, $title, $description, $action, $action_target){
        $update = date("d/m/Y h:s a");
        $stmt = $this -> db -> prepare("UPDATE formulars SET updated_at = ?, title = ?, description = ?, action = ?, action_target = ?  WHERE id = ?");
        $stmt -> bind_param("sssssi", $update, $title, $description, $action, $action_target, $fomular_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }




}