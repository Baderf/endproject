<?php

class dashboard extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        if($events = $this -> model -> getEvents(sessions::get("userid"))){
            $this -> view -> data['events'] = $events;
        }else{
            $this -> view -> data['events'] = "noevents";
        }

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("dashboard/index", $this -> view -> data);
    }

    public function dontshowagain(){

        $user_id = $_POST['user_id'];

        if($this -> model -> setIntroNull($user_id)){
            sessions::set("intro_on", "0");
            echo "set";
        }else{
            sessions::set("intro_on", "0");
            echo "error";
        }

    }

}