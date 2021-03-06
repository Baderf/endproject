<?php

class designs_model extends model{

    public $last_id = 0;
    public $event_id = 0;

    public function __construct(){

        parent::__construct();
    }

    public function saveMail($user_id, $mail_id, $fulltext, $emailtext){
        $update_time = date("d/m/Y h:s a");
        $mail = "mail_" . $mail_id;
        $mailfile = $mail . ".html";
        $user_file = "usermedia_" . $user_id;

        $userfile_fulltext = $_SERVER['DOCUMENT_ROOT'] . "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . "/mails/mail_edit/" . $mailfile;
        $userfile_email = $_SERVER['DOCUMENT_ROOT'] . "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . "/mails/mail_html/" . $mailfile;

        $header = "<meta http-equiv=\"Content-type\" content=\"text/html;charset=UTF-8\"><table height=\"100%\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#ececec\" border=\"0\">
  <tbody>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td>
        <div>
          <table cellspacing=\"0\" cellpadding=\"0\" width=\"730\" align=\"center\" border=\"0\" style=\"font-family: verdana\">
            <tbody>
              <tr>
                <td valign=\"top\">
                <td valign=\"top\">
                  <table cellspacing=\"0\" cellpadding=\"0\" width=\"721\" align=\"center\" border=\"0\">
                    <tbody>
                      <tr>
                        <td bgcolor=\"#ffffff\">
                          <table cellspacing=\"0\" cellpadding=\"13\" width=\"721\"  border=\"0\" style=\"background-repeat: no-repeat; font-family: verdana\">
                            <tbody>
                              <div>
                              <tr valign=\"top\">
                                <td width=\"651\" height=\"50\" style=\"font-size: 12px\">";

        $footer = "
        </td>
        </tr>
        </div>
        
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr>
            <td valign=\"top\"><br />
            </td>
        </tr>
        </tbody>
        </table>
        </div>
        </td>
        </tr>
        <tr><td><img src='###IMGVIEW###' alt='logo' style='display:none;'></td></tr>
        </tbody>
        </table>
        ";

        $full_mail = $header . $emailtext . $footer;




        if(file_put_contents($userfile_fulltext, $fulltext)){
            if(file_put_contents($userfile_email, $full_mail)){
                $stmt = $this -> db -> prepare("UPDATE mails SET last_update = ? WHERE id = ? AND user_id = ?");
                $stmt -> bind_param("sii", $update_time, $mail_id, $user_id);

                if($stmt->execute()){
                    $stmt -> close();
                    return true;
                }else{
                    $stmt -> close();
                    return false;
                }
            }
        }

        return false;
    }

    public function createTemplate($user_id, $mail_id, $title){
        $mail = "mail_" . $mail_id;

        $sql = $this -> db -> query("SELECT * FROM mail_templates WHERE template_mail = '$mail' AND user_id = $user_id");

        if ($sql -> num_rows == 0){
            $mail = "mail_".$mail_id;
            $stmt = $this -> db -> prepare("INSERT INTO mail_templates (user_id, title, template_mail) VALUES(?,?,?)");
            $stmt -> bind_param("iss", $user_id, $title, $mail);
            if($stmt -> execute()){
                $stmt -> close();
                return true;
            }else {
                return false;
            }
        }
    }

    public function getMailInfos($mail_id, $user_id){
        $sql = $this -> db -> query("SELECT * FROM mails WHERE id = $mail_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows > 0){
            $mail = $sql -> fetch_assoc();
        }

        return $mail;
    }

    public function savemailsettings($user_id, $mail_id, $title, $sender, $sender_adress, $subject, $preview_text){
        $stmt = $this -> db -> prepare("UPDATE mails SET title = ?, sender = ?, subject = ?, sender_adress = ?, preview = ? WHERE id = ? AND user_id = ?");
        $stmt -> bind_param("sssssii", $title, $sender, $subject, $sender_adress, $preview_text, $mail_id, $user_id);

        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }

        $stmt -> close();
        return false;
    }

    public function getEventInfos($event_id, $user_id){
        $sql = $this -> db -> query("SELECT enterprise FROM events WHERE id = $event_id AND user_id = $user_id LIMIT 1");

        if($sql -> num_rows == 1){
            $event_info = $sql -> fetch_assoc();
        }

        return $event_info;
    }

    public function getAllUserMails($user_id, $action){

        switch ($action) {
            case "all":
                $query = "SELECT 
                                  mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.user_id = $user_id";
                break;
            case "progress":
                $query = "SELECT 
                                    mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.user_id = $user_id
                                    AND mails.already_sent = 0";
                break;
            case "alreadysent":
                $query = "SELECT 
                                    mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.already_sent = 1 AND mails.user_id = $user_id
                                    ";
                break;
            case "latest":
                $query = "SELECT 
                                    mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.user_id = $user_id
                                    ORDER BY id DESC";
                break;
        }

        $sql = $this -> db -> query($query);

        if($sql -> num_rows > 0){
            $mails = $sql ->fetch_all(MYSQLI_ASSOC);
            return $mails;
        }else{
            return false;
        }



    }

    public function checkIfIsTemplate($user_id, $mail_id){
        $mail = "mail_".$mail_id;
        $sql = $this -> db -> query("SELECT * FROM mail_templates WHERE user_id = $user_id AND template_mail = '$mail' LIMIT 1");

        if($sql -> num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getUserTemplates($user_id){
        $sql = $this -> db -> query("SELECT *
                                     FROM mail_templates
                                     WHERE user_id = $user_id
        ");

        if($sql -> num_rows > 0){
            $templates = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $templates;
    }

    public function deleteUserTemplate($user_id, $mail_id){
        $mail = "mail_" . $mail_id;

        $stmt = $this -> db -> prepare("DELETE FROM mail_templates WHERE template_mail = ? AND user_id = ?");
        $stmt -> bind_param("si", $mail, $user_id);
        if($stmt -> execute()){
            $stmt -> close();
            return true;
        }else{
            return false;
        }

    }

    public function createNewDesign($event_id, $user_id, $title, $type, $subject, $template = "default"){

        $stmt = $this -> db -> prepare("INSERT INTO mails (user_id, event_id, title, subject, mail_type) VALUES(?,?,?,?,?)");
        $stmt -> bind_param("iisss", $user_id, $event_id, $title, $subject, $type);
        if($stmt -> execute()){
            $this -> last_id = $stmt -> insert_id;

            $userfolder = $_SERVER['DOCUMENT_ROOT'] . "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/usermedia_" . $user_id;
            $usermailhtmlfolder = $userfolder . "/mails/mail_html";
            $usermaileditfolder = $userfolder . "/mails/mail_edit";
            $usermailtemplatefolder = $userfolder . "/mails/templates";

            if($template == "default"){
                $standard_template = $usermailtemplatefolder . "/standard.html";
            }else{
                $standard_template = $usermaileditfolder . "/" . $template . ".html";
            }


            $new_file_name = "mail_" . $this -> last_id . ".html";

            copy($standard_template, $usermaileditfolder . "/" . $new_file_name);
            copy($standard_template, $usermailhtmlfolder . "/" . $new_file_name);

            $stmt -> prepare("UPDATE mails SET file_edit_name = ?, file_mail_name = ? WHERE id = ?");
            $stmt -> bind_param("ssi", $new_file_name, $new_file_name, $this->last_id);
            if($stmt -> execute()){
                $stmt -> close();
                return $this -> last_id;
            }else{
                $stmt -> close();
                return "Update hat nicht funktioniert";
            }

        }else{
            return false;
        }
    }

    public function getUserEvents($user_id){
        $sql = $this -> db -> query("SELECT title, id FROM events WHERE user_id = $user_id AND deleted = 0");

        if($sql -> num_rows > 0){
            $events = $sql -> fetch_all(MYSQLI_ASSOC);
        }

        return $events;
    }

    public function checkMailTypesJSON($event_id, $user_id){
        $sql = $this -> db -> query("SELECT mail_type FROM mails WHERE event_id = $event_id AND user_id = $user_id LIMIT 6");

        if($sql -> num_rows > 0 && $sql ->num_rows < 7){
            $types = $sql -> fetch_all(MYSQLI_ASSOC);

            if($types == NULL){
                $types = array();
            }
        }else{
            $types = array();
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

    public function getSearchedDesigns($search_text, $user_id){
        $sql = $this -> db -> query("SELECT 
                                    mails.id, mails.already_sent, mails.event_id, mails.title, mails.mail_type, events.title as event_title, events.id as event_id 
                                    FROM mails 
                                    LEFT JOIN events
                                    ON mails.event_id = events.id
                                    WHERE mails.user_id = $user_id AND mails.title LIKE '%$search_text%'");

        if($sql -> num_rows > 0){
            $mails = $sql -> fetch_all(MYSQLI_ASSOC);
            return $mails;
        }

        return false;
    }


}