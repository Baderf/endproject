<?php

class myevents_model extends model{

    public $last_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function newEvent($title, $enterprise, $eventtype, $date_from, $date_to){

        $stmt = $this -> db -> prepare("INSERT INTO events (title, date_from, date_to) VALUES(?,?,?)");
        $stmt -> bind_param("sss", $title, $date_from, $date_to);

        $stmt -> execute();
        $this -> last_id = $stmt -> insert_id;

        $stmt -> close();

        return true;

    }

    public function getEventData($event_id){

        $res = $this -> db -> query("SELECT * FROM events WHERE id = $event_id LIMIT 1");

        if ($res -> num_rows == 1){
            $event = $res -> fetch_assoc();
        }

        return $event;
    }

    public function updateEventOverview($title, $eventtype, $datetime_from, $datetime_to, $event_id){
        $stmt = $this -> db -> prepare("UPDATE events SET title = ?, type = ?, date_from = ?, date_to = ? WHERE id = ?");
        $stmt -> bind_param("ssssi", $title, $eventtype, $datetime_from, $datetime_to, $event_id);

        $stmt -> execute();
        $stmt -> close();

        return true;
    }

    public function getFormularData($event_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM formulars WHERE event_id = $event_id AND user_id = $user_id");

        if($sql -> num_rows != 0){
            $formulars = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $formulars;
    }
}