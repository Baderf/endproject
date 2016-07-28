<?php

class myevents_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createEventUsersTable($name, $name_mail){
        $this -> db -> query("CREATE TABLE $name (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) ) SELECT * FROM users_event_template ");
        $this -> db -> query("CREATE TABLE $name_mail (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) ) SELECT * FROM users_mails_template ");

        return true;
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

    public function updateEventSettings($participates_max, $event_id){
        $stmt = $this -> db -> prepare("UPDATE event_details SET participants_max = ? WHERE id = ?");
        $stmt -> bind_param("ii", $participates_max, $event_id);
        $stmt ->execute();
        $stmt -> close();

        return true;
    }

    public function getFormularData($event_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM formulars WHERE event_id = $event_id AND user_id = $user_id");

        if($sql -> num_rows != 0){
            $formulars = $sql -> fetch_all(MYSQLI_ASSOC);
            return $formulars;
        }else {
            return false;
        }


    }

    public function getEventDetailsData($event_id){
        $sql = $this -> db -> query("SELECT * FROM event_details WHERE event_id = $event_id LIMIT 1");

        if ($sql -> num_rows == 1){
            $event_detail = $sql -> fetch_assoc();
        }

        return $event_detail;
    }

    public function uploadEventImage($eventname, $user_id, $event_id){
        // Abfrage ob Verzeichnis existiert
        $user_root = 'usermedia_' . $user_id;
        $event_file = $event_id . '_' . $eventname;
        $user_media_root = APPS . CURRENT_APP . APP_PUBLIC . 'media/' . $user_root;
        $user_media_event = APPS . CURRENT_APP . APP_PUBLIC . 'media/' . $user_root . '/' . $event_file;
        $allowed_extensions = array('png', 'jpg', 'jpeg');
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        $max_size = 2000*1024; // 2 MB

        if (!file_exists($user_media_root)) {
            mkdir($user_media_root, 0700);
        }

        if (!file_exists($user_media_event)){
            mkdir($user_media_event, 0700);
        }

        $extension = strtolower(pathinfo($_FILES['event_image']['name'], PATHINFO_EXTENSION));
        $detected_type = exif_imagetype($_FILES['event_image']['tmp_name']);

        if(!in_array($extension, $allowed_extensions)) {
            return false;
        }

        if(!in_array($detected_type, $allowed_types)) {
            return false;
        }


        if($_FILES['event_image']['size'] > $max_size) {
            die("Bitte keine Dateien größer 500kb hochladen");
        }

        $temporary_name = $_FILES['event_image']['tmp_name'];
        $file_name = $user_media_event . '/' . time() . '_' .  $_FILES['event_image']['name'] ;

        if (move_uploaded_file($_FILES['event_image']['tmp_name'], $file_name)) {
            $stmt = $this -> db -> prepare("UPDATE event_details SET event_image = ? WHERE event_id = ?");
            $stmt -> bind_param("si", $file_name, $event_id);
            $stmt -> execute();
            $stmt -> close();
           return true;
        } else {
           return false;
        }



    }
}