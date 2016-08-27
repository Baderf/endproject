<?php

class formbuilder{

    private $output = "";

    public function __construct($name = "form", $method = "post", $action = "", $enctype = false){

        $this -> output = "<form id=\"form-$name\" method=\"$method\" action=\"$action\"";

        $this -> output .= ($enctype) ? " enctype=\"multipart/form-data\">" : ">";

        $token = uniqid();
        $this -> output .= "<input type=\"hidden\" name=\"form-token\" value=\"$token\">";
        sessions::set("form-token", $token);

    }

    /**
     * Fügt ein Input Feld hinzu
     *
     * @param string $type
     * @param string $name
     * @param null $label
     * @param array $attr
     * @return $this
     */
    public function addInput($type = "text", $name = "", $label = null, $attr = array(), $required = false){

        $this -> output .= "<div class=\"form-group\">";

        if($label !== null){
            if($required){
                $this -> output .= "<label for=\"f-$name\">$label</label>";
                $this -> output .= "*";
            }else{
                $this -> output .= "<label for=\"f-$name\">$label</label>";
            }
        }

        if($required == TRUE){
            $this -> output .= "<input type=\"$type\" name=\"f-$name\" id=\"f-$name\" required";
        }else{
            $this -> output .= "<input type=\"$type\" name=\"f-$name\" id=\"f-$name\"";
        }

        foreach( $attr as $key => $val ){

            if( $key == "class" ){
                $this -> output .= " class=\"$val form-control\"";
            }else{
                $this -> output .= " $key=\"$val\"";
            }
        }

        $this -> output .= (!array_key_exists("class", $attr)) ? " class=\"form-control\">" : ">";

        $this -> output .= "</div>";

        return $this;
    }


    public function addSelect($name = "", $label = null, $options = array(), $selected = null, $attr = array(), $required = false){

        $this -> output .= "<div class=\"form-group\">";

        if($label !== null){
            if($required){
                $this -> output .= "<label for=\"f-$name\">$label</label>";
                $this -> output .= "*";
            }else{
                $this -> output .= "<label for=\"f-$name\">$label</label>";
            }
        }

        if ($required == TRUE){
            $this -> output .= "<select name=\"f-$name\" id=\"f-$name\" required";
        }else{
            $this -> output .= "<select name=\"f-$name\" id=\"f-$name\"";
        }


        foreach( $attr as $key => $val ){

            if( $key == "class" ){
                $this -> output .= " class=\"$val form-control\"";
            }else{
                $this -> output .= " $key=\"$val\"";
            }
        }

        $this -> output .= (!array_key_exists("class", $attr)) ? " class=\"form-control\">" : ">";

        foreach( $options as $key => $val){

            $this -> output .= ( $val == $selected ) ? "<option value=\"$val\" selected>$val</option>" : "<option value=\"$val\">$val</option>";
        }

        $this -> output .= "</select></div>";

        return $this;
    }

    public function addTextarea($name = "", $label = null, $attr = array(), $required = false){

        $this -> output .= "<div class=\"form-group\">";

        if($label !== null){
            if($required){
                $this -> output .= "<label for=\"f-$name\">$label</label>";
                $this -> output .= "*";
            }else{
                $this -> output .= "<label for=\"f-$name\">$label</label>";
            }
        }

        if($required){
            $this -> output .= "<textarea id=\"f-$name\" name=\"f-$name\" required";
        }else{
            $this -> output .= "<textarea id=\"f-$name\" name=\"f-$name\"";
        }

        foreach( $attr as $key => $val ){

            if( $key == "value" ) continue;

            if( $key == "class" ){
                $this -> output .= " class=\"$val form-control\"";
            }else{
                $this -> output .= " $key=\"$val\"";
            }
        }

        $this -> output .= (!array_key_exists("class", $attr)) ? " class=\"form-control\">" : ">";

        if( array_key_exists("value", $attr) ) $this -> output .= $attr['value'];


        $this -> output .= "</textarea></div>";

        return $this;

    }


    public function getForm(){

        $this -> output .= "</form>";

        return $this -> output;
    }
}