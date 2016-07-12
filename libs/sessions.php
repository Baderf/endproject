<?php

class sessions{

    static public function init(){

        session_start();
    }

    static public function set($key, $val){

        $_SESSION[$key] = $val;
    }

    static public function get($key){

        return (!isset($_SESSION[$key])) ? false : $_SESSION[$key];
    }

    static public function del($key){

        if( isset($_SESSION[$key]) ) unset($_SESSION[$key]);
    }

    static public function delAll(){

        session_destroy();
    }
}