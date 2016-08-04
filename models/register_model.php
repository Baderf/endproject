<?php

class register_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function setRegister($data)
    {
        // Variablen zu definieren
        $uname = $this -> xss($data['f-uname']);
        $pw = $this -> setUserPassword($data['f-pw']);
        $email = $this -> xss($data['f-email']);

        $userData = array(
            'vname' => $this -> xss($data['f-vname']),
            'nname' => $this -> xss($data['f-nname']),
            'country' => $this -> xss($data['f-country'])
        );

        $userData = json_encode($userData);
        $createdAt = time();
        $hash = $this -> createUserHash();
        $userGroup = 1;
        $isActive = 0;


        // DB Eintrag zu machen
        $stmt = $this -> db -> prepare("INSERT INTO users (username, password, email, data, created_at, hash, is_active, usergroup) VALUES (?,?,?,?,?,?,?,?)");

        $stmt -> bind_param("ssssssii", $uname, $pw, $email, $userData, $createdAt, $hash, $isActive, $userGroup);
        if($stmt -> execute()){
            $user_id = $stmt -> insert_id;

            // Create User-Dir:
            $user_root = 'usermedia_' . $user_id;

            $user_media_root = APPS . "app_backend/" . APP_PUBLIC . 'media/' . $user_root;
            $user_mails_root = APPS . "app_backend/" . APP_PUBLIC . 'media/' . $user_root . "/mails";

            $user_mails_edit = APPS . "app_backend/" . APP_PUBLIC . 'media/' . $user_root . "/mails/mail_edit";
            $user_mails_html = APPS . "app_backend/" . APP_PUBLIC . 'media/' . $user_root . "/mails/mail_html";
            $user_mails_templates = APPS . "app_backend/" . APP_PUBLIC . 'media/' . $user_root . "/mails/templates";
            $user_mail_standard_template = APPS . "app_backend/" . APP_PUBLIC . 'media/standard.html';

            if(!is_dir($user_media_root)){
                mkdir($user_media_root, 0777);
                mkdir($user_mails_root, 0777);
                mkdir($user_mails_edit, 0777);
                mkdir($user_mails_html, 0777);
                mkdir($user_mails_templates, 0777);
                mkdir($user_mails_templates, 0777);
                copy($user_mail_standard_template, $user_mails_templates . "/" . 'standard.html');
            }

        }

        $stmt -> close();

        return $hash;
    }

    public function setActivate($hash){

        $res = $this -> db -> query("SELECT id FROM users WHERE hash = '$hash' AND is_active = 0 LIMIT 1");

        if( $res -> num_rows == 1 ){

            $row = $res -> fetch_assoc();

            $upd = $this -> db -> query("UPDATE users SET is_active = 1 WHERE id = {$row['id']}");

        }else{
            return false;
        }
    }

    private function setUserPassword($pw){

        $salt = $this -> generateSalt();
        $pwHash = sha1($pw . $salt) . ':' . $salt;

        return $pwHash;
    }

    private function generateSalt(){

        return rand(1000, 9999);
    }

    private function xss($string){

        return $this -> db -> real_escape_string($string);
    }

    private function createUserHash()
    {
        return uniqid();
    }
}