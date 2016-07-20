<?php

class formulars_model extends model{

    public $last_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createNewFormular($title, $user_id){

        $sql = $this -> db -> query("SELECT standard_active_field_ids, standard_deactive_field_ids FROM settings");
        if($sql -> num_rows == 1){
            $settings = $sql -> fetch_assoc();
        }

        $stmt = $this -> db -> prepare("INSERT INTO formulars (title, user_id) VALUES(?,?)");
        $stmt -> bind_param("si", $title, $user_id);
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
            $user_fields = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $user_fields;
    }

    public function updateUserFormularDetails($formular_id, $user_id, $user_formular_ids){
        $stmt = $this -> db -> prepare("UPDATE formulars SET user_field_ids = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("sii", $user_formular_ids, $formular_id, $user_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function updateUserFormular($user_id, $formular_id, $title, $type, $default_value, $data_values, $placeholder, $is_required = "true"){
        $stmt = $this -> db -> prepare("UPDATE user_formular_fields SET title = ?, type = ?, default_value = ?, data_values = ?, placeholder = ?, is_required = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("ssssssii", $title, $type, $default_value, $data_values, $placeholder, $is_required, $formular_id, $user_id);
        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }

        return false;

    }

    public function createUserFormular($user_id, $formular_id, $title, $type, $default_value, $data_values, $placeholder, $is_required = "true"){
        $stmt = $this -> db -> prepare("INSERT INTO user_formular_fields (user_id, formular_id, title, type, default_value, data_values, placeholder, is_required) VALUES(?,?,?,?,?,?,?,?)");
        $stmt -> bind_param("iissssss", $user_id, $formular_id, $title, $type, $default_value, $data_values, $placeholder, $is_required);
        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }

        return false;

    }

    public function getLastIdFormulars(){
        $sql = $this -> db -> query("SELECT MAX(id) FROM user_formular_fields");

        if($sql -> num_rows == 1){
            $last_id = $sql -> fetch_all(MYSQLI_ASSOC);
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

    public function getFormularUserFields($formular_id, $user_id){
        $sql = $this -> db -> query ("SELECT * FROM user_formular_fields WHERE user_id = $user_id");

        if($sql -> num_rows > 0){
            $standard_fields = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $user_fields;
    }

    public function updateStandardFields($formular_id, $active_standard_fields, $deactive_standard_fields){

        $stmt = $this -> db -> prepare("UPDATE formulars SET standard_field_ids = ?, deactive_standard_fields = ?  WHERE id = ?");
        $stmt -> bind_param("ssi", $active_standard_fields, $deactive_standard_fields, $formular_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function updateFormularDetails($fomular_id, $title, $description, $action, $action_target){
        $stmt = $this -> db -> prepare("UPDATE formulars SET title = ?, description = ?, action = ?, action_target = ?  WHERE id = ?");
        $stmt -> bind_param("ssssi", $title, $description, $action, $action_target, $fomular_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }




}