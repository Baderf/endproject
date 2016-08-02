<?php

class designs_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createNewDesign($title, $user_id, $type, $enterprise){
        $stmt = $this -> db -> prepare("INSERT INTO mails (user_id = ?, event_id = 0)");
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