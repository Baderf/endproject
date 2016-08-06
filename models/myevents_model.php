<?php

class myevents_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createEventUsersTable($name, $name_mail){
        $this -> db -> query("CREATE TABLE $name (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) ) SELECT * FROM users_event_template");
        $this -> db -> query("CREATE TABLE $name_mail SELECT * FROM users_mails_template");

        return true;
    }

    public function newEvent($title, $eventtype, $enterprise, $date_from, $date_to, $user_id){

        echo $enterprise;
        $created_at = date("m/d/Y g:i a");
        // Eintrag in DB 'events'
        $stmt = $this -> db -> prepare("INSERT INTO events (title, type, created_at, enterprise, date_from, date_to, user_id) VALUES(?,?,?,?,?,?,?)");
        $stmt -> bind_param("ssssssi", $title, $eventtype, $created_at, $enterprise, $date_from, $date_to, $user_id);
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

    public function updateEventOverview($title, $eventtype, $enterprise, $datetime_from, $datetime_to, $event_id){
        
        $stmt = $this -> db -> prepare("UPDATE events SET title = ?, type = ?, enterprise = ?, date_from = ?, date_to = ? WHERE id = ?");
        $stmt -> bind_param("sssssi", $title, $eventtype, $enterprise, $datetime_from, $datetime_to, $event_id);

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

    public function getAllFormulars($user_id){
        $sql = $this -> db -> query("SELECT * FROM formulars WHERE user_id = $user_id");

        if($sql -> num_rows > 0){
            $formulars = $sql -> fetch_all(MYSQLI_ASSOC);
            return $formulars;
        }else{
            return false;
        }
    }

    public function linkFormular($event_id, $formular_to_link, $user_id){

        if($this -> checkForLinkedEvents($event_id, $user_id)){
            if($this -> deleteTable($event_id, $user_id)){
                if($this -> createTable($event_id)){
                    if($this -> fillNewTable($formular_to_link, $event_id)){
                        if($this -> linkFormularToEvent($event_id, $user_id, $formular_to_link)){
                            return true;
                        } else{
                            return "linking";
                        }
                    }return "fillTable";
                }return "createTable";
            }return "deleteTable";

        }else{
            if($this -> createTable($event_id)){
                if($this -> fillNewTable($formular_to_link, $event_id)){
                    if($this -> linkFormularToEvent($event_id, $user_id, $formular_to_link)){
                        return true;
                    } else{
                        return "linking";
                    }
                } return "fillTable";
            }return "createTable";
        }

    }

    public function fillNewTable($formular_to_link, $event_id){
        $sql = $this -> db -> query("SELECT user_field_ids FROM formulars WHERE id = $formular_to_link");

        $tablename = "users_form_" . $event_id;

        if($sql -> num_rows == 1){
            $userfields = $sql ->fetch_all(MYSQLI_ASSOC);

            $active_ids = explode("::", $userfields[0]['user_field_ids']);

            foreach ($active_ids as $id) {
                $user_field_id = str_replace(":", "", $id);

                $new_sql = $this -> db -> query("SELECT title FROM user_formular_fields WHERE id = $user_field_id");

                if($new_sql -> num_rows > 0){

                    $title = $new_sql -> fetch_assoc();
                    $sql_title = strtolower($title['title']);
                    $preg_title = preg_replace("/[^0-9a-zA-Z \-\_]/", "", $sql_title);
                    $new_title = str_replace(' ','',$preg_title);

                    $new_sql = $this -> db -> query("ALTER TABLE $tablename ADD $new_title VARCHAR(300) NOT NULL");

                }

            }

            return true;
        }

    }

    public function createTable($event_id){
        $tablename = "users_form_" . $event_id;



        if($this -> db -> query("CREATE TABLE $tablename (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user_id INT(11))")){
            return true;
        }

        return false;
    }

    public function deleteTable($event_id){
        $tablename = "users_form_" . $event_id;

        if($this -> db -> query("DROP TABLE IF EXISTS $tablename")){
         return true;
        }
        return false;
    }

    public function linkFormularToEvent($event_id, $user_id, $formular_id){
        $stmt = $this -> db -> prepare("UPDATE events SET form_id = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("iii", $formular_id, $event_id, $user_id);

        if($stmt ->execute()){
            $stmt -> close();
            return true;
        }

        return false;
    }

    public function checkForLinkedEvents($event_id, $user_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id AND user_id = $user_id");

        if($sql ->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getFormularData($event_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM events WHERE id = $event_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows > 0){
            $event = $sql -> fetch_all(MYSQLI_ASSOC);
            $form_id = $event[0]['form_id'];


            $sql = $this -> db -> query("SELECT * FROM formulars WHERE id=$form_id AND user_id = $user_id");

            if($sql -> num_rows > 0){
                $formular_linked = $sql -> fetch_all(MYSQLI_ASSOC);

                return $formular_linked;
            }

        }else {
            return false;
        }
    }


    public function unlinkEventFormular($event_id, $user_id){
        $stmt = $this -> db -> prepare("UPDATE events SET form_id = ? WHERE id = ? AND user_id = ?");
        $unlink = "0";
        $stmt -> bind_param("sii", $unlink, $event_id, $user_id);

        if($stmt ->execute()){
            $stmt->close();

            if($this -> deleteTable($event_id, $user_id)){
                return true;
            }else{
                return false;
            }
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
            mkdir($user_media_root, 0777);
        }

        if (!file_exists($user_media_event)){
            mkdir($user_media_event, 0777);
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