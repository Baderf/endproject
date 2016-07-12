<?php

class home_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function getText(){

        return "Herzlich Willkommen";
    }
}