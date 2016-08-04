<?php

class designs extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){
        $this -> view -> data['mails'] = $this -> model -> getAllUserMails(sessions::get("userid"));

        $this -> view -> render("designs/index", $this -> view -> data);
    }

    public function saveMail(){
        $user_id = $_POST['user_id'];
        $mail_id = $_POST['mail_id'];
        $fulltext = $_POST['fulltext'];
        $emailtext = $_POST['emailtext'];

        if(!empty($user_id) && !empty($mail_id) && !empty($fulltext) && !empty($emailtext)){
            if($this -> model -> saveMail($user_id, $mail_id, $fulltext, $emailtext)){
                return "saved";
            }else{
                return "error";
            }
        }
    }



    public function saveAsTemplate(){
        $user_id = $_POST['user_id'];
        $mail_id = $_POST['mail_id'];
        $title = $_POST['title'];

        if(!empty($user_id) && !empty($mail_id) && !empty($title)){
            if ($this -> model -> createTemplate($user_id, $mail_id, $title)){
                return true;
            }else {
                return false;
            }
        }
    }

    public function deleteTemplate(){
        $user_id = $_POST['user_id'];
        $mail_id = $_POST['mail_id'];
        $title = $_POST['title'];

        if(!empty($user_id) && !empty($mail_id) && !empty($title)){
            if ($this -> model -> deleteUserTemplate($user_id, $mail_id, $title)){
                return true;
            }else {
                return false;
            }
        }
    }

    public function edit($mail_id){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['savemail'])){

            }

        }

        $this -> view -> data['mail_id'] = $mail_id;
        if($this -> model -> checkIfIsTemplate(sessions::get("userid"), $mail_id)){
            $this -> view -> data['is_template'] = "1";
        }else{
            $this -> view -> data['is_template'] = "0";
        }

        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));

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
                $template = $_POST['template_selection'];

                if(empty($title)){
                    // Bitte TItle ausfüllen
                }elseif (empty($enterprise)){
                    // Bitte Enterprise ausfüllen
                }elseif ($id = $this -> model -> createNewDesign($event_id, sessions::get("userid"), $title, $type, $enterprise, $template)){
                    header("Location: edit/$id");
                }
            }


        }else{
            $this -> view -> data['templates'] = $this -> model -> getUserTemplates(sessions::get("userid"));
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