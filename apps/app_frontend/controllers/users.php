<?php

class users extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function getusersbyname( $name = null ){

        if($name !== null){
            header('Content-Type: text/json');
            echo $this -> model -> getUsersByName( $name );
        }
    }
}