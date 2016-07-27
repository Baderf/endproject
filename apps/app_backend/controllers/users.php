<?php

class users extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {

            if (isset($_POST['go_to_userlist'])){
                $event_id = $_POST['event_id'];

                header("Location: users_list/show/$event_id");
            }
        }else{
            $this -> view -> data['username'] = sessions::get('uname');

            $this -> view -> render("users/index", $this -> view -> data);
        }

    }

    public function edit($user_list_id){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            // Do something
        }else{

        }
    }

}