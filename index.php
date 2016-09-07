<?php
error_reporting(E_ALL);
error_reporting(-1);

require_once 'config/apps.php';
require_once 'config/paths.php';

$url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
$url = explode("/", $url);

if( in_array($url[0], $apps) ){
    define("CURRENT_APP", array_search($url[0], $apps) . '/');
}else{
    define("CURRENT_APP", APP_DEFAULT . '/' );
}

require_once APP_CORE . 'autoloader.php';

spl_autoload_register("autoloader::loadController");
spl_autoload_register("autoloader::loadModel");
spl_autoload_register("autoloader::loadLib");
spl_autoload_register("autoloader::loadCore");

sessions::init();

$app = new bootstrap();
