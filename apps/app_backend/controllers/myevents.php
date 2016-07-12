<?php

class myevents extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("myevents/index", $this -> view -> data);
    }

}