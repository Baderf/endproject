<?php

class myevents extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){
        if(!isset($_POST['action']) || empty($_POST['action'])){
            $action = "all";
        }else{
            $action = $_POST['action'];
        }

        $this -> view -> data['username'] = sessions::get('uname');
        $this -> view -> data['action'] = $action;

        if(!$this -> view -> data['events'] = $this -> model -> getAllEvents(sessions::get("userid"), $action)){
            $this -> view -> data['events'] = FALSE;
        }

        $this -> view -> render("myevents/index", $this -> view -> data);
    }

    public function sendingSuccess($mail_id){
        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
        $this -> view -> render("myevents/ss_sent", $this -> view -> data);
    }

    public function sendingErrors($mail_id){
        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
        $this -> view -> data['sending_errors'] = sessions::get("sending-errors");
        sessions::del("sending-errors");
        $this -> view -> render("myevents/er_sent", $this -> view -> data);
    }

    public function sent($result, $mail_id){

        if(is_array($result)){

            sessions::set("sending-errors", $result);
            $location = APP_ROOT . 'backend/' . 'myevents/' . 'sendingErrors/' . $mail_id;
            header("Location: $location");

        }elseif($result === TRUE){
            $location = APP_ROOT . 'backend/' . 'myevents/' . 'sendingSuccess/' . $mail_id;
            header("Location: $location");

        }else{
            $location = APP_ROOT . 'backend/' . 'myevents/' . 'send/' . $mail_id;
            sessions::set("sending-errors", "error");
            header("Location: $location");
        }
    }

    public function send($mail_id){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){
            $mail_sender = $_POST['mail_sender'];
            $mail_sender_adress = $_POST['mail_sender_adress'];
            $subject = $_POST['subject'];
            $preheader = $_POST['preheader'];
            $empty = FALSE;

            $email_options = [$mail_sender, $mail_sender_adress, $subject, $preheader];

            foreach ($email_options as $option){
                if($option === ""){
                    $empty = TRUE;
                }
            }

            if ($empty === TRUE){
                $this -> view -> data['errors'] = "Please fill in all settings-fields! Otherwise the mail can't be send!";
                $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
                $this -> view -> render('myevents/send', $this -> view ->data);
            }else{
                $email = $_POST["mail_sender_adress"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $empty = TRUE;
                }

                if ($empty === TRUE){
                    $this -> view -> data['errors'] = "You typed in an invalid email-adress!";
                    $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
                    $this -> view -> render('myevents/send', $this -> view ->data);
                }else{
                    if($this -> model -> updateMailSettings($mail_id, sessions::get("userid"),$mail_sender, $mail_sender_adress, $subject, $preheader)){

                        $result = $this -> model -> sendMail($mail_id, sessions::get("userid"));

                        if($result === TRUE) {
                            $this -> sent($result, $mail_id);
                        }elseif(is_array($result)){
                            $this -> sent($result, $mail_id);
                        }
                    }else{
                        $this -> view -> data['errors'] = "There has been an error by updating your settings. Please try again later!";
                        $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));
                        $this -> view -> render('myevents/send', $this -> view ->data);
                    }
                }
            }


        }else{

            if(sessions::get("sending-errors") === "error"){
                $this -> view -> data['sending-errors'] = "error";
                sessions::del("sending-erros");
            }

            $this -> view -> data['mail_infos'] = $this -> model -> getMailInfos($mail_id, sessions::get("userid"));

            $this -> view -> render('myevents/send', $this -> view ->data);
        }



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
            if($this -> model -> unlinkEventFormular($event_id, $user_id)){
                echo "unlinked";
            }else{
                echo "error";
            }
        }else{
            if($this -> model -> unlinkEventFormular($event_id, $user_id)){
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

        if($this -> model -> linkFormular($event_id, $formular_to_link, $user_id)){
            echo "linked";
        }else{
            echo "error";
        }


    }

    public function delete($event_id){


       if($this -> model -> deleteEvent($event_id, sessions::get("userid"))){
           echo "deleted";
       }else{
           echo "error";
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

    // SEND FUNCTIONS:

    public function countuser(){

        $event_id = $_POST['event_id'];
        $mail_type = $_POST['mail_type'];

        if($count = $this -> model -> countUser($event_id, $mail_type)){
            echo $count;
        }else{
            echo "Error";
        }
    }

    public function checkuseremails(){
        header('Content-type: application/json');

        $event_id = $_POST['event_id'];
        $mail_type = $_POST['mail_type'];

        if($check = $this -> model -> checkUserEmails($event_id, $mail_type)){

            echo json_encode($check);
        }
    }

    public function checkmailsettings(){
        $event_id = $_POST['event_id'];
        $mail_id = $_POST['mail_id'];
        $user_id = $_POST['user_id'];

        $check = $this -> model -> checkMailSettings($event_id, $mail_id, $user_id);

        if($check === TRUE){
            echo "true";
        }else{
            echo json_encode($check);
        }

    }

    public function checkforduplicates(){
        $event_id = $_POST['event_id'];
        $mail_type = $_POST['mail_type'];

        $check = $this -> model -> checkForDuplicates($event_id, $mail_type);

        if($check === TRUE){
            echo "true";
        }else{
            echo json_encode($check);
        }



    }

    public function updatemailsettings_manual(){
        $event_id = $_POST['event_id'];
        $user_id = $_POST['user_id'];
        $mail_id = $_POST['mail_id'];

        $mail_sender = $_POST['mail_sender'];
        $mail_sender_adress = $_POST['mail_sender_adress'];
        $subject = $_POST['subject'];
        $preheader = $_POST['preheader'];

        $update = $this -> model -> UpdateMailSettingsMan($event_id, $user_id, $mail_id, $mail_sender, $mail_sender_adress, $subject, $preheader);

        if($update){
            echo "success";
        }else{
            echo "error";
        }


    }


}