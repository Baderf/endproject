<?php

class myevents_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function createEventUsersTable($name, $name_mail){
        $this -> db -> query("CREATE TABLE $name (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) ) SELECT * FROM users_event_template");
        $this -> db -> query("CREATE TABLE $name_mail (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) ) SELECT * FROM users_mails_template");

        return true;
    }

    public function newEvent($title, $eventtype, $enterprise, $date_from, $date_to, $user_id){

        $created_at = date("m/d/Y g:i a");
        $time = time();
        $date_to_time = strtotime($date_to, time());


        // Eintrag in DB 'events'
        $stmt = $this -> db -> prepare("INSERT INTO events (title, type, created_at, created_at_time, enterprise, date_from, date_to, date_to_time, user_id) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt -> bind_param("ssssssssi", $title, $eventtype, $created_at, $time, $enterprise, $date_from, $date_to, $date_to_time, $user_id);
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

    public function countUser($event_id, $mail_type){
        $tablename = "users_mails_" . $event_id;
        $tablename2 = "users_event_".$event_id;
        $sql = false;


        switch ($mail_type) {
            case "invitation":
                $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0");
                break;
            case 'reminder':
                $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 1 AND $tablename2.accepted = 0 AND $tablename2.canceled = 0");
                break;
            case "savethedate":
                $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0 AND $tablename.std_sent = 0 AND $tablename.reminder_sent = 0 AND $tablename.info_sent = 0 AND $tablename.ty_sent = 0");
                break;
            case "information":
                $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
            case "thankyou":
                $sql = $this -> db -> query("SELECT COUNT(*) FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
        }


        if($sql){
            $count = $sql ->fetch_row();

            return $count[0];
        }

        return false;
    }

    public function checkUserEmails($event_id, $mail_type){
        $tablename = "users_mails_".$event_id;
        $tablename2 = "users_event_".$event_id;

        switch ($mail_type) {
            case "invitation":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0");
                break;
            case 'reminder':
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 1 AND $tablename2.accepted = 0 AND $tablename2.canceled = 0");
                break;
            case "savethedate":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0 AND $tablename.std_sent = 0 AND $tablename.reminder_sent = 0 AND $tablename.info_sent = 0 AND $tablename.ty_sent = 0");
                break;
            case "information":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
            case "thankyou":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
        }

        if($sql){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
            $error_mails = array();

            foreach ($users as $user){

                $thrown = false;

                if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {

                    $thrown = true;
                }

                if(!$this -> validate_email($user['email'])){
                    $thrown = true;
                }

                if($thrown){
                    $error = array($user['email'], $user['lastname'], $user['firstname']);
                    array_push($error_mails, $error);
                }
            }

            if(!empty($error_mails)){
                return $error_mails;
            }else{
                return "success";
            }


        }


    }

    public function UpdateMailSettingsMan($event_id, $user_id, $mail_id, $mail_sender, $mail_sender_adress, $subject, $preheader){
        $stmt = $this -> db -> prepare("UPDATE mails SET subject = ?, sender = ?, sender_adress = ?, preview = ? WHERE id = ? AND user_id = ? AND event_id = ?");
        $stmt->bind_param("ssssiii", $subject, $mail_sender, $mail_sender_adress, $preheader, $mail_id, $user_id, $event_id);

        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            return false;
        }
    }

    public function checkForDuplicates($event_id, $mail_type){

        $tablename = "users_mails_".$event_id;
        $tablename2 = "users_event_".$event_id;

        switch ($mail_type) {
            case "invitation":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0");
                break;
            case 'reminder':
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 1 AND $tablename2.accepted = 0 AND $tablename2.canceled = 0");
                break;
            case "savethedate":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.invitation_sent = 0 AND $tablename.std_sent = 0 AND $tablename.reminder_sent = 0 AND $tablename.info_sent = 0 AND $tablename.ty_sent = 0");
                break;
            case "information":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
            case "thankyou":
                $sql = $this -> db -> query("SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0");
                break;
        }

        //echo "SELECT * FROM $tablename LEFT JOIN $tablename2 ON $tablename2.id = $tablename.user_id WHERE $tablename.info_sent = 0 AND $tablename2.accepted = 1 AND $tablename2.canceled = 0";

        if($sql){
            $users = $sql -> fetch_all(MYSQLI_ASSOC);
            $duplicates = array();
            $double_ids = array();
            $thrown = false;



            foreach ($users as $user){

                $email = $user['email'];

                foreach ($users as $userdup){
                    if($user['id'] === $userdup['id']){
                        continue;
                    }

                    if($email === $userdup['email']){
                        $thrown = true;

                        $error1 = ":" . $user['id'] . "::" . $userdup['id'] . ":";
                        $error2 = ":" . $userdup['id'] . "::" . $user['id'] . ":";

                        if(!in_array($error1, $double_ids) || !in_array($error2, $double_ids)){
                            $error = "User " . $user['lastname'] . ", ". $user['firstname'] . " and user " . $userdup['lastname'] . ", " .$userdup['firstname'] . " have the same email.";

                            array_push($duplicates, $error);
                            array_push($double_ids, $error1);
                            array_push($double_ids, $error2);
                        }else{
                            continue;
                        }

                    }
                }

            }



            if($thrown){
                return $duplicates;
            }else{
                return true;
            }



        }
    }

    public function checkMailSettings($event_id, $mail_id, $user_id){
        $sql = $this -> db -> query("SELECT subject, sender, sender_adress, preview FROM mails WHERE id = $mail_id AND user_id = $user_id AND event_id = $event_id LIMIT 1");

        if($sql){
            $settings = $sql -> fetch_assoc();
            $error_mails = array();
            $thrown = false;

            foreach ($settings as $setting => $value){

                if(empty($value) || $value == ""){
                    $thrown = true;
                    $error = "The " . $setting . "-option is empty!";
                    array_push($error_mails, $error);
                    continue;
                }

            }

            if(!$this->validate_email($settings['sender_adress'])){
                $thrown = true;
                $error = "Your sender adress is incorrect. Please correct it and try again.";
                array_push($error_mails, $error);
            }

            if($thrown){
                return $error_mails;
            }else{
                return true;
            }


        }else{
            return false;
        }
    }

    public function validate_email($email){

            if(!preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $email))
                return false;
            list($prefix, $domain) = explode("@",$email);
            if(function_exists("getmxrr") && getmxrr($domain, $mxhosts))
                return true;
            elseif (@fsockopen($domain, 25, $errno, $errstr, 5))
                return true;
            else
                return false;

    }

    public function getEventData($event_id){

        $res = $this -> db -> query("SELECT * FROM events WHERE id = $event_id LIMIT 1");

        if ($res -> num_rows == 1){
            $event = $res -> fetch_assoc();
        }

        return $event;
    }

    public function updateMailSettings($mail_id, $user_id, $mail_sender, $mail_sender_adress, $subject, $preheader){
       $stmt = $this -> db -> prepare("UPDATE mails SET subject = ?, sender = ?, sender_adress = ?, preview = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("ssssii", $subject, $mail_sender, $mail_sender_adress, $preheader, $mail_id, $user_id);

        if($stmt->execute()){
            $stmt -> close();

            return true;
        }else{
            return false;
        }


    }

    public function getMailInfos($mail_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM mails WHERE id = $mail_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows > 0){
            $mail = $sql -> fetch_assoc();
        }

        return $mail;
    }

    public function updateEventOverview($title, $eventtype, $enterprise, $datetime_from, $datetime_to, $event_id){

        $date_to_time = strtotime($datetime_to, time());

        $stmt = $this -> db -> prepare("UPDATE events SET title = ?, type = ?, enterprise = ?, date_from = ?, date_to = ?, date_to_time = ? WHERE id = ?");
        $stmt -> bind_param("ssssssi", $title, $eventtype, $enterprise, $datetime_from, $datetime_to, $date_to_time, $event_id);

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

    public function getLinkedMails($event_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM mails WHERE event_id = $event_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $mails = $sql -> fetch_all(MYSQLI_ASSOC);
            return $mails;
        }

        return false;
    }

    public function linkform($event_id, $user_id, $formular_id){
        $sql = $this -> db -> query("UPDATE events SET form_id = $formular_id WHERE id = $event_id AND user_id = $user_id");

        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function linkFormular($event_id, $formular_to_link, $user_id){

        if($this -> checkForLinkedEvents($event_id, $user_id)){
            if($this -> deleteUserColumns($event_id, $user_id)){
                if($this -> linkform($event_id, $user_id, $formular_to_link)){
                    if($this -> createUserColumns($event_id, $user_id)){
                        return true;
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
            if($this -> linkform($event_id, $user_id, $formular_to_link)){

                if($this -> createUserColumns($event_id, $user_id)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

    }


    public function linkFormularToEvent($event_id, $user_id, $formular_id){

        if($this -> linkFormular($event_id, $formular_id, $user_id)){
            return true;
        }

        return false;
    }

    public function checkForLinkedEvents($event_id, $user_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id AND user_id = $user_id AND form_id != 0 LIMIT 1");

        if($sql->num_rows > 0){
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
                return true;
            }else{
                return false;
            }


    }

    public function createUserColumns($event_id, $user_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $form_id = $sql -> fetch_assoc();
            if($form_id['form_id'] != "0"){
                $formular_id = $form_id['form_id'];
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
                                    $names .= "ADD " . "`" . $val['title']. "`" . " VARCHAR(200) NOT NULL" . ", " ;
                                }


                            }

                            // DROP Tables:
                            $tablename = "users_event_".$event_id;
                            $dec = "ALTER TABLE " . $tablename . " " . $names;


                            if($sql = $this -> db -> query($dec)){
                                return true;
                            }else{
                                return false;
                            }


                        }

                    }
                }

            }else{
                return false;
            }

        }
    }

    public function deleteUserColumns($event_id, $user_id){
        $sql = $this -> db -> query("SELECT form_id FROM events WHERE id = $event_id AND user_id = $user_id");

        if($sql -> num_rows > 0){
            $form_id = $sql -> fetch_assoc();
            if($form_id['form_id'] != "0"){
                $formular_id = $form_id['form_id'];
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

                            // DROP Tables:
                            $tablename = "users_event_".$event_id;
                            $dec = "ALTER TABLE " . $tablename . " " . $names;

                            if($sql = $this -> db -> query($dec)){
                                return true;
                            }else{
                                return false;
                            }


                        }

                    }
                }

            }else{
                // hat keine Verlinkung
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
            $stmt = $this -> db -> prepare("UPDATE events SET image = ? WHERE id = ?");
            $stmt -> bind_param("si", $file_name, $event_id);
            $stmt -> execute();
            $stmt -> close();
           return true;
        } else {
           return false;
        }



    }

    public function sendMail($mail_id, $user_id){
        $mailservice = new mailservice();

        $result = $mailservice -> sendCampaign($mail_id, $user_id);

        if(is_array($result)){
            return $result;
        }elseif($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function getAllEvents($user_id, $action){

        switch ($action) {
            case "all":
                $query = "SELECT * FROM events WHERE user_id = $user_id AND deleted = 0";
                break;
            case "progress":
                $actual_time = time();
                $query = "SELECT * FROM events WHERE user_id = $user_id AND deleted = 0 AND date_to_time > $actual_time";
                break;
            case "completed":
                $actual_time = time();
                $query = "SELECT * FROM events WHERE user_id = $user_id AND deleted = 0 AND date_to_time < $actual_time";
                break;
            case "latest":
                $actual_time = time();
                $query = "SELECT * FROM events WHERE user_id = $user_id AND deleted = 0 ORDER BY created_at_time DESC";
                break;
        }

        $sql = $this -> db -> query($query);

        if($sql -> num_rows > 0) {
            $events = $sql->fetch_all(MYSQLI_ASSOC);

            foreach ($events as &$event){

                $tablename = "users_event_".$event['id'];

                $sql = $this -> db -> query("
                SELECT 
                    SUM(CASE WHEN accepted = 1 THEN 1 ELSE 0 END) AS accepted,
                    COUNT(*) AS TOTAL
                    
                FROM $tablename
                
                ");

                if($sql -> num_rows > 0){
                    $extras = $sql -> fetch_assoc();

                    $event['count_users'] = $extras['TOTAL'];
                    $event['count_accepted'] = $extras['accepted'];

                }

            }



            return $events;
        }else{
            return false;
        }


    }

    public function deleteEvent($event_id, $user_id){
        $tablename = "users_mails_".$event_id;
        $tablename2 = "users_event_".$event_id;

        $sql = $this -> db -> query("SELECT id FROM mails WHERE user_id = $user_id AND event_id = $event_id");

        if($sql -> num_rows > 0){
            $mails = $sql -> fetch_all(MYSQLI_ASSOC);

            $ids = "";
            $i = 0;
            $len = count($mails);
            foreach ($mails as $mail) {
                if ($i == $len - 1) {
                    $ids .= $mail['id'];
                }else {
                    $ids .= $mail['id'] . ",";
                }

                $i++;
            }

            $sql = $this -> db -> query("DELETE from mails WHERE id IN ($ids)");

            if($sql){
                if($this -> db -> query("DROP TABLE IF EXISTS $tablename")){
                    if($this -> db -> query("DROP TABLE IF EXISTS $tablename2")){
                        if($this -> db -> query("DELETE FROM events WHERE id = $event_id AND user_id = $user_id")){
                            return true;
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
        }else{
            if($this -> db -> query("DROP TABLE IF EXISTS $tablename")){
                if($this -> db -> query("DROP TABLE IF EXISTS $tablename2")){
                    if($this -> db -> query("DELETE FROM events WHERE id = $event_id AND user_id = $user_id")){
                        return true;
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

}