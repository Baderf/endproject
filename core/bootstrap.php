<?php

class bootstrap{

    public function __construct(){

        if( !isset($_GET['url']) ){
            $_GET['url'] = CONTROLLER_DEFAULT;
        }

        $url = $_GET['url'];
        $url = rtrim($url, "/");
        $url = explode("/", $url);

        if( CURRENT_APP != APP_DEFAULT . "/" ){
            array_shift($url);
            if( count($url) <= 0 ) $url[0] = CONTROLLER_DEFAULT;
        }

        $file = APPS . CURRENT_APP . APP_CONTROLLERS . $url[0] . '.php';

        if (file_exists($file)) {
            $controller = new $url[0];
            $controller -> loadModel($url[0]);

            if (!empty($url[1])) {

                if (method_exists($controller, $url[1])) {

                    if (!empty($url[2])) {

                        $controller->{$url[1]}($url[2]); // $controller -> show(2)
                    } else {

                        $controller->{$url[1]}(); // $controller -> show()
                    }
                }else{
                    $controller->index();
                }
            }else{
                $controller->index();
            }
        } else {

            $controller = new error();
            $controller->index();
        }
    }
}