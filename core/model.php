<?php

class model{

    public $db;

    public function __construct(){

        $dbData = include('config/db.php');
        $this -> db = new database($dbData['host'], $dbData['user'], $dbData['pass'], $dbData['name']);
    }
}