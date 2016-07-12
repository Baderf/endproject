<?php

class guest_controller extends controller{

    public function __construct(){

        parent::__construct();

        if( $this -> checkUserGroup() === false ){
            header('Location:' . APP_ROOT . 'home');
        }
    }

    public function checkUserGroup(){

        return (sessions::get('usergroup') === false) ? true : false;
    }
}