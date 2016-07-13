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
            $enterprise = $_POST['enterprisename'];
            $eventtype = $_POST['eventtype'];
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];




            $this -> createEvent($title, $enterprise, $eventtype, $date_from, $date_to);
        }

        $this -> view -> render('myevents/new');
    }

    public function edit($event_id){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){
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

            }elseif (isset($_POST['edit_links'])){

            }


        }

            $this->view->data['event_edit'] = $this->model->getEventData($event_id);
            $this->view->data['event_formulars'] = $this->model->getFormularData($event_id, sessions::get("userid"));
            $this->view->render('myevents/edit', $this->view->data);

    }











    public function createEvent($title, $enterprise, $eventtype, $date_from, $date_to) {
        if($this -> model -> newEvent($title, $enterprise, $eventtype, $date_from, $date_to)){
            $last_id = $this -> model -> last_id;
            header("Location: edit/$last_id");
        };
    }


}