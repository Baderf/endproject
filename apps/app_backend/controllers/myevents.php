<?php

class myevents extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("myevents/index", $this -> view -> data);
    }

    public function newEvent(){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){

            $title = $_POST['eventtitle'];
            $eventtype = $_POST['eventtype'];
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $user_id = sessions::get("userid");

            $this -> createEvent($title, $eventtype, $date_from, $date_to, $user_id);
        }

        $this -> view -> render('myevents/new');

    }

    public function edit($event_id){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){

           $event_details = $this->model->getEventData($event_id);

            if (isset($_POST['edit_overview'])){
                $title = $_POST['eventtitle'];
                $eventtype = $_POST['eventtype'];
                $date_from = $_POST['eventdate_from'];
                $time_from = $_POST['eventtime_from'];
                $date_to = $_POST['eventdate_to'];
                $time_to = $_POST['eventtime_to'];
                $datetime_from = $date_from . ' ' . $time_from;
                $datetime_to = $date_to . ' ' . $time_to;

                if($this -> model -> updateEventOverview($title, $eventtype, $datetime_from, $datetime_to, $event_id)){
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
            }elseif (isset($_POST['edit_links'])){

            }


        }

            $this->view->data['event_edit'] = $this->model->getEventData($event_id);
            $this->view->data['event_formulars'] = $this->model->getFormularData($event_id, sessions::get("userid"));
            $this->view->data['event_details'] = $this->model->getEventDetailsData($event_id);
            $this->view->render('myevents/edit', $this->view->data);

    }











    public function createEvent($title, $eventtype,$date_from, $date_to, $user_id) {
        if($this -> model -> newEvent($title, $eventtype,$date_from, $date_to, $user_id)){
            $event_id = $this -> model -> event_id;
            header("Location: edit/$event_id");
        };
    }


}