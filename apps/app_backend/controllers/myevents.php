<?php

class myevents extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("myevents/index", $this -> view -> data);
    }

    public function send($mail_id){

        $this -> view -> render('myevents/send');
    }

    public function newEvent(){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){

            $title = $_POST['eventtitle'];
            $eventtype = $_POST['eventtype'];
            $enterprise = $_POST['enterprise'];
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $user_id = sessions::get("userid");

            $this -> createEvent($title, $eventtype, $enterprise, $date_from, $date_to, $user_id);
        }

        $this -> view -> render('myevents/new');

    }

    public function edit($event_id){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){

           $event_details = $this->model->getEventData($event_id);

            if (isset($_POST['edit_overview'])){
                $title = $_POST['eventtitle'];
                $enterprise = $_POST['enterprise'];
                $eventtype = $_POST['eventtype'];
                $date_from = $_POST['eventdate_from'];
                $time_from = $_POST['eventtime_from'];
                $date_to = $_POST['eventdate_to'];
                $time_to = $_POST['eventtime_to'];
                $datetime_from = $date_from . ' ' . $time_from;
                $datetime_to = $date_to . ' ' . $time_to;

                if($this -> model -> updateEventOverview($title, $eventtype, $enterprise, $datetime_from, $datetime_to, $event_id)){
                    // Gib Feedback!
                }else{
                    // Wirf Error
                }
            }elseif (isset($_POST['edit_settings'])){
               $participants_max = $_POST['event_limit_participates'];

                if(isset($_FILES['event_image']['tmp_name']) && !empty($_FILES['event_image']['tmp_name'])){

                    if($this -> model -> uploadEventImage($event_details['title'], sessions::get("userid"), $event_id)){

                    }else{

                    };
                }


                if($this -> model -> updateEventSettings($participants_max, $event_id)){
                    // Gib Feedback!
                }else{
                    // Wirf Error
                }
            }

        }

            if(!$this->view->data['linked_mails'] = $this -> model -> getLinkedMails($event_id, sessions::get("userid"))){
                $this -> view -> data['linked_mails'] = "no_mails";
            }
            $this->view->data['event_edit'] = $this->model->getEventData($event_id);
            $this->view->data['event_formulars'] = $this->model->getAllFormulars(sessions::get("userid"));
            $this->view->data['linked_formular'] = $this->model->getFormularData($event_id, sessions::get("userid"));
            $this->view->data['event_details'] = $this->model->getEventDetailsData($event_id);
            $this->view->render('myevents/edit', $this->view->data);

    }

    public function test(){
        $event_id = 24;
        $user_id = 1;

        $this -> model -> createUserColumns($event_id, $user_id);

    }

    public function unlinkFormular(){
        $event_id = $_POST['event_id'];
        $user_id = $_POST['user_id'];

        // delete tables
        if($this -> model -> deleteUserColumns($event_id, sessions::get("userid"))){
            $unlink = $this -> model -> unlinkEventFormular($event_id, $user_id);

            if($unlink){
                echo "unlinked";
            }else{
                echo "error";
            }
        }
    }

    public function linkFormularToEvent(){
        $formular_to_link = $_POST['formular_id'];
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];

        $linked = $this -> model -> linkFormular($event_id, $formular_to_link, $user_id);

        if($this -> model -> createUserColumns($event_id, sessions::get("userid"))){
            if($linked === TRUE){
                echo "linked";
            }else{
                echo "error";
            }
        }

    }











    public function createEvent($title, $eventtype, $enterprise,$date_from, $date_to, $user_id) {
        if($this -> model -> newEvent($title, $eventtype, $enterprise, $date_from, $date_to, $user_id)){
            $event_id = $this -> model -> event_id;
            $new_table_name = "users_event_" . $event_id;
            $name_mail = "users_mails_" . $event_id;

            if($this -> model -> createEventUsersTable($new_table_name, $name_mail)){
                header("Location: edit/$event_id");
            };

        };
    }


}