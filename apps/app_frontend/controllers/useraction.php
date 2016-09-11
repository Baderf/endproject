<?php

class useraction extends controller
{

    public function __construct()
    {

        parent::__construct();
    }

    public function canceledsuccess($hash){
        $url = (isset($_GET['url'])) ? $_GET['url'] : null;
        $url = explode("/", $url);
        $event_id = $url[2];

        if(isset($hash) && !empty($hash)){
            $this -> view -> render("mailactions/canceled");
        }
    }

    public function canceledError($hash){
        $url = (isset($_GET['url'])) ? $_GET['url'] : null;
        $url = explode("/", $url);
        $event_id = $url[2];

        if(isset($hash) && !empty($hash)){
            $this -> view -> render("mailactions/cancelederror");
        }
    }

    public function mailconfirmation($hash){
        if(isset($hash) && !empty($hash)){
              $this -> view -> render("mailactions/mailconfirmation");
        }else{
            // Forbidden
        }
    }

    public function successfeedback($hash){
        if(isset($hash) && !empty($hash)){


            $url = (isset($_GET['url'])) ? $_GET['url'] : null;
            $url = explode("/", $url);
            $form_id = $url[3];

            $this -> view -> data['feedback'] = $this -> model -> getSuccessFeedback($form_id);
            $this -> view -> render("mailactions/successfb", $this -> view -> data);
        }else{
            // Forbidden
        }
    }

    public function success($hash){
        if(isset($hash) && !empty($hash)){
            $this -> view -> render("mailactions/success");
        }else{
            // Forbidden
        }
    }




    public function index()
    {

        $url = (isset($_GET['url'])) ? $_GET['url'] : null;
        $url = explode("/", $url);


        // Mail viewed -- www.localhost.at/endproject/useraction/viewed/userhash/mail_id/event_id/mail_type

        if (isset($url[1]) && $url[1] == "viewed" && isset($url[2]) && isset($url[3]) && isset($url[4]) && isset($url[5])) {
            $hash = $url[2];
            $mail_id = $url[3];
            $event_id = $url[4];
            $mail_type = $url[5];


            // Abfrage ob User existiert:
            if ($user = $this->model->checkIfUserExists($hash, $event_id)) {

                $user_id = $user['id'];
                // Viewed eintragen:
                if ($this->model->setViewed($user_id, $mail_id, $event_id, $mail_type)) {
                    header('Content-Type: image/jpeg');

                    $image = APP_ROOT . APPS . 'app_frontend/public/img/intro-bg.jpg';
                    return $image;
                } else {
                    return false;
                }
            } else {
                return false;
            }


        } elseif (isset($url[1]) && $url[1] == "participate" && isset($url[2]) && isset($url[3]) && isset($url[4]) && isset($url[5])) {
            // Mail accepted -- www.localhost.at/endproject/useraction/participate/userhash/mail_id/event_id/mail_type



            $hash = $url[2];
            $mail_id = $url[3];
            $event_id = $url[4];
            $mail_type = $url[5];


            if ($user = $this->model->checkIfUserExists($hash, $event_id)) {

                $user_id = $user['id'];
                $event = $this -> model -> getEventInformation($event_id);
                $this -> view -> data['event'] = $event;
                $formular = $this -> model -> getFormularDetails($event['form_id']);

                $action = $formular['action'];
                $action_target = $formular['action_target'];

                if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST)) {

                    $userfields = array();
                    $user_data = array();

                    foreach ($_POST as $post => &$postvalue){
                        if($post == "f-saveparticipation"){
                               continue;
                        }elseif(substr($post,0,4) == 'f-u-'){
                                $db_title = substr($post, 4);
                                $db_title = str_replace("_", " ", $db_title);
                                $userfields[$db_title] = $postvalue;
                              continue;
                        }elseif(substr($post,0,2) == 'f-'){
                            $db_title = substr($post, 2);
                            $user_data[$db_title] = $postvalue;
                            continue;
                        }else{
                               // ist gar nix
                            continue;
                        }
                    }

                    if($this->model->updateUserData($event_id, $user_id, $user_data, $userfields)){
                        $this -> model -> userParticipate($event_id, $hash);


                        // Check - Action:
                        if($action == "url"){
                            if(substr($action_target,0,7) == 'http://' || substr($action_target,0,8) == 'https://'){
                                header("Location: $action_target");
                            }else{
                                header("Location: http://$action_target");
                            }

                        }elseif($action == "confirmation_mail"){

                            if($this->model->sendConfirmation($hash, $event_id)){
                                $location = APP_ROOT . 'useraction/mailconfirmation/'.$hash;
                                header("Location: $location");
                            }else{
                                $location = APP_ROOT . 'useraction/success/'.$hash;
                                header("Location: $location");
                            }

                        }elseif($action == "feedback") {
                            $location = APP_ROOT . 'useraction/successfeedback/'.$hash.'/'.$event['form_id'];
                            header("Location: $location");
                        }else{
                            $location = APP_ROOT . 'useraction/success/'.$hash;
                            header("Location: $location");
                        }




                        //
                    }else{
                        $location = APP_ROOT . 'useraction/participate/'.$hash.'/'.$event_id.'/'.$mail_id.'/'.$mail_type;
                        header("Location: $location");
                    }

                }else{

                    if ($formular = $this->model->getFormularID($event_id)) {

                        $form_id = $formular['form_id'];

                        if ($form_id != "0") {
                            $user = $this -> model -> getUserInfos($user_id, $event_id);
                            $form_infos = $this->model->getFormularDetails($form_id);
                            $this->view->data['form_details'] = $form_infos;

                            // Holen der Standard-Felder
                            $standard_fields = $this->model->getFormularStandardfields($form_id);

                            //Holen der aktiven Standard-Felder
                            $active_standard_fields = $form_infos['standard_field_ids'];

                            $user_fields = $form_infos['user_field_ids'];


                            // Holen der einzelnen User-Felder


                            if (!empty($active_standard_fields)) {
                                $active_ids = explode("::", $active_standard_fields);

                                $form = new formbuilder("participation_" . $form_id);

                                foreach ($active_ids as $id) {
                                    $id = str_replace(":", "", $id);

                                    foreach ($standard_fields as $field) {
                                        if ($field['id'] == $id) {
                                            $placeholder = 'Pleace insert your ' . $field['fullname'] . ' ...';
                                            $valuename = $field['name'];
                                            if(isset($user[$valuename]) && $user[$valuename] != ""){
                                                $value = $user[$valuename];
                                            }else{
                                                $value = "";
                                            }

                                            $form->addInput($field['type'], $field['name'], $field['fullname'], array('placeholder' => $placeholder, 'value' => $value));
                                        }
                                    }


                                }
                                if (!empty($user_fields)) {

                                    $user_ids = explode("::", $user_fields);

                                    foreach ($user_ids as &$id) {
                                        $id = str_replace(":", "", $id);

                                        $user_field = $this->model->getUserFormular($form_id, $id, sessions::get("userid"));
                                        $name = "u-" . $user_field['title'];


                                        switch ($user_field['type']) {
                                            case "text":
                                                $form->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']));
                                                break;
                                            case "time":
                                                $form->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "timepicker_userspec"));
                                                break;
                                            case "date":
                                                $form->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "datepicker_userspec"));
                                                break;
                                            case "number":
                                                $form->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']));
                                                break;
                                            case "select":
                                                $user_options = explode("::", $user_field['data_values']);
                                                $options = array();

                                                foreach ($user_options as &$option) {
                                                    $option = str_replace(":", "", $option);
                                                    array_push($options, $option);
                                                }


                                                $form->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                                                break;
                                            case "radio":
                                                $user_options = explode("::", $user_field['data_values']);
                                                $options = array();

                                                foreach ($user_options as &$option) {
                                                    $option = str_replace(":", "", $option);
                                                    array_push($options, $option);
                                                }


                                                $form->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                                                break;
                                            case "checkbox":
                                                $user_options = explode("::", $user_field['data_values']);
                                                $options = array();

                                                foreach ($user_options as &$option) {
                                                    $option = str_replace(":", "", $option);
                                                    array_push($options, $option);
                                                }


                                                $form->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                                                break;
                                            case "textarea":
                                                $form->addTextarea($name, $user_field['title'], array('placeholder' => $user_field['placeholder']));
                                                break;
                                        }
                                    }
                                }


                                $form->addInput("submit", "saveparticipation", null, array('value' => 'Participate', 'class' => 'spec_dashboard'));

                                $this->view->data['form'] = $form->getForm();
                            }


                            $this->view->render("register/formular", $this->view->data);

                        } else {
                            // Fehler aufgetreten, kein Formular kann angezeigt werden!
                        }

                    } else {
                        // Fehler aufgetreten, Formular kann nicht geholt werden aus DB
                    }

                }


            } else {
                // Forbidden!!!
            }

        }elseif(isset($url[1]) && $url[1] == "canceled" && isset($url[2]) && isset($url[3])){
            $hash = $url[2];
            $event_id = $url[3];

            if($this-> model -> cancelUser($hash, $event_id)){
                $location = APP_ROOT . 'useraction/canceledsuccess/'.$hash.'/'.$event_id;
                header("Location: $location");
            }else{
                $location = APP_ROOT . 'useraction/canceledError/'.$hash.'/'.$event_id;
                header("Location: $location");
            }

        }


    }



}



