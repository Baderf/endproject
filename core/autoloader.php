<?php

class autoloader{

    static public function loadController( $class ){
        
        $file = APPS . CURRENT_APP . APP_CONTROLLERS . $class . '.php';

        if( file_exists($file)){
            require_once $file;
        }
    }


    static public function loadModel( $class ){

        $file = APP_MODELS . $class . '.php';

        if( file_exists($file) ){
            require_once $file;
        }
    }


    static public function loadLib( $class ){

        $file = APP_LIBS . $class . '.php';

        if( file_exists($file) ){
            require_once $file;
        }
    }

    static public function loadCore( $class ){

        $file = APP_CORE . $class . '.php';

        if( file_exists($file) ){
            require_once $file;
        }
    }
}

