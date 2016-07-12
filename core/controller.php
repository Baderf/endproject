<?php

class controller{

    public $view;
    public $model;

    public function __construct(){

        $this -> view = new view();
    }

    public function loadModel( $model ){

        $modelName = $model . '_model';
        $file = APP_MODELS . $model . '_model.php';

        if( file_exists($file) ){

            $this -> model = new $modelName;
        }
    }

}
