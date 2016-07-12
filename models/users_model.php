<?php

class users_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function getUsersByName( $name ){

        $res = $this -> db -> query("SELECT id, uname FROM users WHERE uname LIKE '%$name%'");

        if($res -> num_rows >= 1){

            $userList = $res -> fetch_all(MYSQLI_ASSOC);
            return json_encode($userList);
        }

        return false;
    }
}