<?php
//error_reporting(E_ALL);
//error_reporting(-1);

require_once 'config/apps.php';
require_once 'config/paths.php';

$url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
$url = explode("/", $url);


if( in_array($url[0], $apps) ){
    define("CURRENT_APP", array_search($url[0], $apps) . '/');
}else{
    define("CURRENT_APP", APP_DEFAULT . '/' );
}

if(isset($_POST)){
    if(array_key_exists("1", $url)){
        if($url[1] != "designs"){
            foreach($_POST as &$post){
                $post = htmlspecialchars($post, ENT_QUOTES);
            }
        }
    }else{
        foreach($_POST as &$post){
            $post = htmlspecialchars($post, ENT_QUOTES);
        }
    }

}

require_once APP_CORE . 'autoloader.php';

spl_autoload_register("autoloader::loadController");
spl_autoload_register("autoloader::loadModel");
spl_autoload_register("autoloader::loadLib");
spl_autoload_register("autoloader::loadCore");

sessions::init();

$app = new bootstrap();

