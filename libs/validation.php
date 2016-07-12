<?php

class validation {

    private $filter = array(
        'text' => "/^([a-z])+$/i",
        'number' => "/^([0-9])+$/",
        'textnumber' => "/^([\w])+$/i",
        'email' => "/^([a-z0-9-\.]){2,30}@([a-z0-9-]){2,63}\.([a-z]){2,10}$/",
        'url' => "/^https?:\/\/([a-z0-9-]{2,63}\.{1}){1,2}([a-z]){2,10}$/",
        'tel' => "/^([\d])+$/",
        'pw' => "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/" // mind. 6 Stellen, 1 Großbuchstabe, 1 Kleinbuchstabe & 1 Zahl
    );

    private $errors = array();
    private $name = "";

    public function val($data = "", $name = "", $required = true, $type = "text", $min = null, $max = null){

        $this -> name = $name;

        // required abfrage
        if( $required === true && empty($data) ){

            $this -> setError("required");
            return false;
        }

        // min abfrage
        if( $min !== null && $this -> checkMin($data, $min) === false ){

            $this -> setError("min");
            return false;
        }

        // max abfrage
        if( $max !== null && $this -> checkMax($data, $max) === false){

            $this -> setError("max");
            return false;
        }

        // type abfrage
        if( array_key_exists($type, $this -> filter) ){

            if( ! preg_match($this -> filter[$type], $data) ){

                $this -> setError("type");
                return false;
            }
        }

    }

    private function checkMin($data, $min){

        return ( strlen($data) < $min ) ? false : true;
    }

    private function checkMax($data, $max){

        return ( strlen($data) > $max ) ? false : true;
    }

    public function check($data1 = array(), $data2 = array()){

        $this -> name = array($data1['name'], $data2['name']);

        if($data1['value'] != $data2['value']){

            $this -> setError("check");
        }
    }

    private function setError($error){

            switch ($error){
                case "required":
                    array_push($this -> errors, "Bitte füllen Sie den {$this -> name} aus.");
                    break;
                case "min":
                    array_push($this -> errors, "{$this -> name} hat zu wenig Zeichen.");
                    break;
                case "max":
                    array_push($this -> errors, "{$this -> name} hat zu viele Zeichen.");
                    break;
                case "type":
                    array_push($this -> errors, "{$this -> name} ist nicht valide.");
                    break;
                case "check":
                    array_push($this -> errors, "{$this -> name[0]} hat nicht den selben Wert wie {$this -> name[1]}.");
                    break;
                default:
                    array_push($this -> errors, "{$this -> name} passt nicht.");
            }

    }

    public function getErrors(){
        return (count($this -> errors) > 0) ? $this -> errors : false;
    }

}