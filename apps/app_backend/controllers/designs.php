<?php

class designs extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/index", $this -> view -> data);
    }

    public function newDesign(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['createDesign'])){

                $title = $_POST['mailtitle'];
                $enterprise = $_POST['enterprisename'];
                $type = $_POST['mailtype'];

                if(empty($title)){
                    // Bitte TItle ausfüllen
                }elseif (empty($enterprise)){
                    // Bitte Enterprise ausfüllen
                }elseif ($this -> model -> createNewDesign($title, sessions::get("userid"), $type, $enterprise)){
                    
                    if($formular_id){
                        header("Location: edit/$formular_id");
                    }

                }
            }


        }else{
            $this -> view -> data['events'] = $this -> model -> getUserEvents(sessions::get("userid"));
        }

       $this -> view -> render("designs/new", $this -> view -> data);
    }

    public function checkMailTypes(){
        header('Content-Type: text/json');

        $event_id = $_POST['eventid'];
        $user_id = $_POST['userid'];

        echo $this -> model -> checkMailTypesJSON($event_id, $user_id);

    }

}