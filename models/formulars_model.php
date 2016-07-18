<?php

class formulars_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function newEvent($title, $eventtype, $date_from, $date_to, $user_id){

        $created_at = date("m/d/Y g:i a");
        // Eintrag in DB 'events'
        $stmt = $this -> db -> prepare("INSERT INTO events (title, type, created_at, date_from, date_to, user_id) VALUES(?,?,?,?,?,?)");
        $stmt -> bind_param("sssssi", $title, $eventtype, $created_at, $date_from, $date_to, $user_id);
        if($stmt -> execute()){
            $this -> event_id = $stmt -> insert_id;


            // Eintrag in DB 'event_details'
            $stmt -> prepare("INSERT INTO event_details (event_id) VALUES (?)");
            $stmt -> bind_param("i", $this -> event_id);
            $stmt -> execute();
            $this -> last_id = $stmt -> insert_id;


            // Eintrag in DB 'events_link_eventdetails'
            $stmt -> prepare("INSERT INTO events_link_eventdetails (event_id, eventdetails_id) VALUES (?,?)");
            $stmt -> bind_param("ii", $this -> event_id, $this -> last_id);
            $stmt -> execute();
            $this -> last_id = $stmt -> insert_id;
            $stmt -> close();

            return true;

        }else{
            return false;
        }
    }

    public function getFormularInfos($formular_id){
        
    }

    public function updateStandardFields($formular_id, $active_standard_fields, $deactive_standard_fields){

        $stmt = $this -> db -> prepare("UPDATE formulars SET standard_field_ids = ?, deactive_standard_fields = ?  WHERE id = ?");
        $stmt -> bind_param("ssi", $active_standard_fields, $deactive_standard_fields, $formular_id);
        $stmt -> execute();
        $stmt -> close();

        return true;
    }




}