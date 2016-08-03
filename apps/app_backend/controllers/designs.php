<?php

class designs extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/index", $this -> view -> data);
    }

    public function edit($mail_id){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/edit", $this -> view -> data);
    }

    public function newDesign(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['createDesign'])){

                $title = $_POST['mailtitle'];
                $enterprise = $_POST['enterprisename'];
                $type = $_POST['type_selection'];
                $event_id = intval($_POST['event_selection']);


                if(empty($title)){
                    // Bitte TItle ausfüllen
                }elseif (empty($enterprise)){
                    // Bitte Enterprise ausfüllen
                }elseif ($id = $this -> model -> createNewDesign($event_id, sessions::get("userid"), $title, $type, $enterprise)){
                    header("Location: edit/$id");
                }
            }


        }else{
            $this -> view -> data['events'] = $this -> model -> getUserEvents(sessions::get("userid"));
        }

       $this -> view -> render("designs/create", $this -> view -> data);
    }

    public function checkMailTypes(){
        header('Content-Type: text/json');

        $event_id = $_POST['eventid'];
        $user_id = $_POST['userid'];

        echo $this -> model -> checkMailTypesJSON($event_id, $user_id);

    }

}