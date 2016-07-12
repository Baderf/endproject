<?php

class login_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function setLogin($uname, $pw){

        if( $this -> checkUname($uname) ){

            return $this -> checkPW($uname, $pw);

        }else{
            return false; // username nicht gefunden -> funktion bricht ab
        }
    }

    public function checkUname($uname){

        $res = $this -> db -> query("SELECT id FROM users WHERE username = '$uname' AND is_active = 1 LIMIT 1");

        return ( $res -> num_rows == 1) ? true : false;
    }

    public function checkPW($uname, $pw){

        $res = $this -> db -> query("SELECT * FROM users WHERE username = '$uname' LIMIT 1");

        if( $res -> num_rows == 1 ){

            $user = $res -> fetch_assoc();

            $pwHash = explode(":", $user['password']);

            if( $pwHash[0] == sha1($pw . $pwHash[1]) ){

                return $user;
            }else{
                return false;
            }
        }
    }
}