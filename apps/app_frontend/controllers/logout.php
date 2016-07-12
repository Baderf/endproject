<?php

class logout extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        sessions::delAll();
        header('Location:' . APP_ROOT . 'home');
        exit();
    }
}