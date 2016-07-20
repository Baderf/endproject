<?php

class view{

    public $data = array();
    public $last_id = "";

    public function __construct(){

    }

    public function render($template, $data = null, $incLayout = true){

        if( $data !== null ) extract($data);

        $nav = require (sessions::get('login') == 1) ? 'config/nav_users.php' : 'config/nav_guests.php';

        if($incLayout === true){
            require APPS . CURRENT_APP . APP_VIEWS . 'header.php';
            require APPS . CURRENT_APP . APP_VIEWS . $template . '.php';
            require APPS . CURRENT_APP . APP_VIEWS . 'footer.php';
        }else{
            require APPS . CURRENT_APP . APP_VIEWS . $template . '.php';
        }
    }
}