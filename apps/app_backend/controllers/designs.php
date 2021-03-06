<?php

class designs extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
        $url = explode("/", $url);

        if(isset($_POST['search_event'])){
            $this -> view -> data['link_active'] = "all";
            $search_text = $_POST['search'];

            if($this -> view-> data['mails'] = $this -> model -> getSearchedDesigns($search_text, sessions::get("userid"))){
                $this -> view -> data['username'] = sessions::get('uname');
                $this -> view -> render("designs/index", $this -> view -> data);
            }else{
                $this -> view -> data['link_active'] = "all";
                $this -> view->data['mails'] = "none";
                $this -> view -> render("designs/index", $this -> view -> data);
            }

        }else{
            if(!isset($url[2])){
                $filter = "all";
            }else{
                $filter = $url[2];
            }

            if(isset($filter)){
                $this -> view -> data['link_active'] = $filter;
                if(!$this -> view -> data['mails'] = $this -> model -> getAllUserMails(sessions::get("userid"), $filter)){
                    $this -> view -> data['mails'] = "none";
                }
            }else{
                $this -> view -> data['link_active'] = $filter;
                if(!$this -> view -> data['mails'] = $this -> model -> getAllUserMails(sessions::get("userid"), $action = "all")){
                    $this -> view -> data['mails'] = "none";
                }
            }

            $this -> view -> data['username'] = sessions::get('uname');
            $this -> view -> render("designs/index", $this -> view -> data);
        }


    }

    public function saveMail(){
        $user_id = $_POST['user_id'];
        $mail_id = $_POST['mail_id'];
        $fulltext = $_POST['fulltext'];
        $emailtext = $_POST['emailtext'];

        if(!empty($user_id) && !empty($mail_id) && !empty($fulltext) && !empty($emailtext)){
            if($this -> model -> saveMail($user_id, $mail_id, $fulltext, $emailtext)){
                echo "saved";
            }else{
                echo "error";
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

    public function saveMailSettings($mail_id){
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $sender = $_POST['sender'];
        $sender_adress = $_POST['sender_adress'];
        $subject = $_POST['subject'];
        $preview_text = $_POST['preview_text'];

        if($this -> model -> savemailsettings($user_id, $mail_id, $title, $sender, $sender_adress, $subject, $preview_text)){
            echo "saved";
        }
    }

    public function edit($mail_id){

        $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
        $url = explode("/", $url);

        if($url[3] == "ckeditor"){
            header("Location: http://www.baderflorian.at/apps/app_backend/public/ckeditor/plugins/imageuploader/imgbrowser.php?CKEditor=editor2&CKEditorFuncNum=905&langCode=en");
        }


        $this -> view -> data['mail_id'] = $mail_id;
        if($this -> model -> checkIfIsTemplate(sessions::get("userid"), $mail_id)){
            $this -> view -> data['is_template'] = "1";
        }else{
            $this -> view -> data['is_template'] = "0";
        }

        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));$this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
        $event_id = $this -> view -> data['mail_infos']['event_id'];
        $this -> view -> data['event_info'] = $this -> model -> getEventInfos($event_id, sessions::get("userid"));

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/edit", $this -> view -> data);
    }

    public function view($mail_id){
        $this -> view -> data['mail_id'] = $mail_id;

        if($this -> model -> checkIfIsTemplate(sessions::get("userid"), $mail_id)){
            $this -> view -> data['is_template'] = "1";
        }else{
            $this -> view -> data['is_template'] = "0";
        }

        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));$this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
        $event_id = $this -> view -> data['mail_infos']['event_id'];
        $this -> view -> data['event_info'] = $this -> model -> getEventInfos($event_id, sessions::get("userid"));

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("designs/view", $this -> view -> data);
    }

    public function newDesign(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['createDesign'])){

                $title = $_POST['mailtitle'];
                $subject = $_POST['subject'];
                $type = $_POST['type_selection'];
                $event_id = intval($_POST['event_selection']);
                $template = $_POST['template_selection'];

                if(empty($title)){
                    // Bitte TItle ausfüllen
                    return false;
                }elseif (empty($subject)){
                    // Bitte Subject ausfülen
                    return false;
                }

                if($id = $this -> model -> createNewDesign($event_id, sessions::get("userid"), $title, $type, $subject, $template)){
                    header("Location: edit/$id");
                }else{
                    //var_dump($event_id, sessions::get("userid"), $title, $type, $subject, $template);
                    echo "ERROR";
                }


            }


        }else{

            $this -> view -> data['templates'] = $this -> model -> getUserTemplates(sessions::get("userid"));
            $this -> view -> data['events'] = $this -> model -> getUserEvents(sessions::get("userid"));
        }

       $this -> view -> render("designs/create", $this -> view -> data);
    }

    public function testmail(){

        $mail_id = $_POST['mail_id'];
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $event_id = "1";

        $mail = new mailservice();

        if($testmail = $mail -> sendTestMail($mail_id, $user_id, $email, $event_id)){
            echo "sent";
        }else{
            var_dump($mail -> errors);
        }

    }

    public function checkMailTypes(){
        header('Content-Type: text/json');

        $event_id = $_POST['eventid'];
        $user_id = $_POST['userid'];

        echo $this -> model -> checkMailTypesJSON($event_id, $user_id);

    }

}