<?php

class user_controller extends controller{

    public function __construct(){

        parent::__construct();

        if( $this -> checkUserGroup() === false ){
            header('Location:' . APP_ROOT . 'login');
            exit();
        }
    }

    public function checkUserGroup(){

        return ( sessions::get("usergroup") < 1 ) ? false : true;
    }
}