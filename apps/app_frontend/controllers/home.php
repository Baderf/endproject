<?php

class home extends controller {

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['register_start'])) {
                if(!empty($_POST['register_start'])){
                    $username = $_POST['username_home'];
                    $location = APP_ROOT . 'register/' . $username;
                    header("Location: $location");
                }
            }

        }else{
            $this -> view -> render("home/index");
        }


    }

    public function show( $val = null ){

        $this -> view -> render("home/show");
    }

    public function getSession(){
        echo sessions::get("userid");
    }

}