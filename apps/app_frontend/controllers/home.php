<?php

class home extends controller {

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $text = $this -> model -> getText();

        $data = array(
            'headline' => $text,
            'text' => "Danke dass du unsere Seite besuchst!"
        );

        $this -> view -> render("home/index", $data);
    }

    public function show( $val = null ){

        $this -> view -> render("home/show");
    }

}