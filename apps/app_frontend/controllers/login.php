<?php

class login extends guest_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){

            $this -> process();
        }

        $this -> view -> render('login/index', $this -> view -> data);
    }


    private function process()
    {

            $user = $this -> model -> setLogin($_POST['f-username'], $_POST['f-password']);

            if( $user === false ){
                // fehldermeldung ausgeben
                $this -> view -> data['formError'] = "The login did not work. Please check your entries.";

            }else{
                // uname & pw sind richtig

                sessions::set("login", 1);
                sessions::set("uname", $user['username']);
                sessions::set("usergroup", $user['usergroup']);
                sessions::set("email", $user['email']);
                sessions::set("userid", $user['id']);
                sessions::set("intro_on", $user['intro_on']);

                header('Location: backend/dashboard');
            }

    }
}
