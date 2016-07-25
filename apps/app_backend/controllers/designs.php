<?php

class designs extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/index", $this -> view -> data);
    }

    public function new(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/new", $this -> view -> data);
    }

}