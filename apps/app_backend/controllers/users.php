<?php

class users extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

            $this -> view -> data['events'] = $this -> model -> getAllEvents(sessions::get("userid"));

            $this -> view -> data['username'] = sessions::get('uname');

            $this -> view -> render("users/index", $this -> view -> data);


    }

    public function edit($event_id){

            $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
            $url = explode("/", $url);


            if(isset($url[4])){

                if($url[4] == "edit_user"){

                    if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {

                        if(isset($_POST['f-saveeventuser'])){

                            $user_id = $url[5];


                            $user_data = array(
                                'firstname' => $_POST['f-firstname'],
                                'lastname' => $_POST['f-lastname'],
                                'sex' => $_POST['f-sex'],
                                'professionaltitle' => $_POST['f-proftitle'],
                                'enterprise' => $_POST['f-enterprise'],
                                'birthday' => $_POST['f-birthday'],
                                'email' => $_POST['f-email'],
                                'fulladress' => $_POST['f-fulladress'],
                                'street' => $_POST['f-street'],
                                'housenumber' => $_POST['f-housenumber'],
                                'city' => $_POST['f-city'],
                                'postal' => $_POST['f-postal'],
                                'salutation' => $_POST['f-salutation'],
                                'trailingtitle' => $_POST['f-trailingtitle'],
                                'function' => $_POST['f-function'],
                                'department' => $_POST['f-department']
                            );

                            if($user_field_ids = $this -> model -> checkForUserFields($event_id)){
                                $ids = explode("::", $user_field_ids['user_field_ids']);
                                $form_id = $user_field_ids['id'];
                                $userfields = array();



                                foreach ($ids as &$id) {

                                    $id = str_replace(":", "", $id);

                                    $user_field = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));
                                    $name = "f-u-" . $user_field['title'];

                                    $title = $user_field['title'];

                                    $userfields[$title] = $_POST[$name];


                                }

                            }

                            if($this->model->updateUserData($event_id, $user_id, $user_data, $userfields)){
                                $location = APP_ROOT . 'backend/users/edit/' .$event_id;
                                header("Location: $location");
                            }







                        }
                    }else{



                    $user = $this -> model -> getUserData($event_id, $url[5]);


                    $form = new formbuilder("user_edit_".$url[5]);

                    $form -> addInput("text", "firstname", "Firstname", array('value' => $user['firstname']));
                    $form -> addInput("text", "lastname", "Lastname", array('value' => $user['lastname']));
                    $form -> addSelect("sex", "Sex", array('male' => 'Male', 'female' => 'Female'), array('value' => $user['sex']));
                    $form -> addInput("text", "proftitle", "Professional Title", array('value' => $user['professionaltitle']));
                    $form -> addInput("text", "enterprise", "Enterprise", array('value' => $user['enterprise']));
                    $form -> addInput("text", "birthday", "Birthday", array('value' => $user['birthday'], 'class' => 'datepicker_userspec'));
                    $form -> addInput("email", "email", "Email", array('value' => $user['email']));
                    $form -> addInput("text", "fulladress", "Full adress", array('value' => $user['fulladress']));
                    $form -> addInput("text", "street", "Street", array('value' => $user['street']));
                    $form -> addInput("text", "housenumber", "House number", array('value' => $user['housenumber']));
                    $form -> addInput("text", "city", "City", array('value' => $user['city']));
                    $form -> addInput("text", "postal", "Postal", array('value' => $user['postal']));
                    $form -> addInput("text", "salutation", "Salutation", array('value' => $user['salutation']));
                    $form -> addInput("text", "trailingtitle", "Trailing title", array('value' => $user['trailingtitle']));
                    $form -> addInput("text", "function", "Function", array('value' => $user['function']));
                    $form -> addInput("text", "department", "Department", array('value' => $user['department']));

                    // Check if event has userfields:
                    if($user_field_ids = $this -> model -> checkForUserFields($event_id)){
                        $ids = explode("::", $user_field_ids['user_field_ids']);
                        $form_id = $user_field_ids['id'];
                        foreach ($ids as &$id) {
                            $id = str_replace(":", "", $id);

                            $user_field = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));
                            $name = "u-" . $user_field['title'];

                            if($user_field['is_required'] == "true"){$required = true;}else{$required = false;};
                            switch ($user_field['type']) {
                                case "text":
                                    $form ->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']), $required);
                                    break;
                                case "time":
                                    $form ->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "timepicker_userspec"),$required);
                                    break;
                                case "date":
                                    $form ->addInput("text", $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "datepicker_userspec"),$required);
                                    break;
                                case "number":
                                    $form ->addInput($user_field['type'], $name, $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']),$required);
                                    break;
                                case "select":
                                    $user_options = explode("::",$user_field['data_values']);
                                    $options = array();

                                    foreach ($user_options as &$option){
                                        $option = str_replace(":", "", $option);
                                        array_push($options, $option);
                                    }

                                    $userfield_title = $user_field['title'];
                                    if (isset($user[$userfield_title])) {
                                        $selected = $user[$userfield_title];
                                    }else{
                                        $selected = $user_field['default_value'];
                                    }

                                    $form ->addSelect($name, $user_field['title'], $options, $selected, array('placeholder' => $user_field['placeholder']),$required);
                                    break;
                                case "radio":
                                    $user_options = explode("::",$user_field['data_values']);
                                    $options = array();

                                    foreach ($user_options as &$option){
                                        $option = str_replace(":", "", $option);
                                        array_push($options, $option);
                                    }

                                    $userfield_title = $user_field['title'];
                                    if (isset($user[$userfield_title])) {
                                        $selected = $user[$userfield_title];
                                    }else{
                                        $selected = $user_field['default_value'];
                                    }

                                    $form ->addSelect($name, $user_field['title'], $options, $selected, array('placeholder' => $user_field['placeholder']),$required);
                                    break;
                                case "checkbox":
                                    $user_options = explode("::",$user_field['data_values']);
                                    $options = array();

                                    foreach ($user_options as &$option){
                                        $option = str_replace(":", "", $option);
                                        array_push($options, $option);
                                    }

                                    $userfield_title = $user_field['title'];
                                    if (isset($user[$userfield_title])) {
                                        $selected = $user[$userfield_title];
                                    }else{
                                        $selected = $user_field['default_value'];
                                    }


                                    $form ->addSelect($name, $user_field['title'], $options, $selected, array('placeholder' => $user_field['placeholder']),$required);
                                    break;
                                case "textarea":
                                    $form -> addTextarea($user_field['id'], $user_field['title'], array('placeholder' => $user_field['placeholder']),$required);
                                    break;
                            }

                        }
                    }

                    $form -> addInput("submit", "saveeventuser", null, array('value' => 'Save', 'class' => 'spec_dashboard'));

                    $this -> view -> data['user_values'] = $form ->getForm();
                    $this -> view -> data['reset_options'] = $this -> model -> getResetOptions($event_id, sessions::get("userid"));
                    $this -> view -> data['send_options'] = $this -> model -> getSendOptions($event_id, sessions::get("userid"));

                    $this -> view -> render("users/edit_user", $this -> view ->data);
                    }

                }else if($url[4] == "new_user"){
                    if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {

                        if(isset($_POST['f-neweventuser'])){

                            foreach ($_POST as $key => &$val){
                                if(empty($val)){
                                    $val = "-";
                                }
                            }

                            $user_data = array(
                                'firstname' => $_POST['f-firstname'],
                                'lastname' => $_POST['f-lastname'],
                                'sex' => $_POST['f-sex'],
                                'professionaltitle' => $_POST['f-proftitle'],
                                'enterprise' => $_POST['f-enterprise'],
                                'birthday' => $_POST['f-birthday'],
                                'email' => $_POST['f-email'],
                                'fulladress' => $_POST['f-fulladress'],
                                'street' => $_POST['f-street'],
                                'housenumber' => $_POST['f-housenumber'],
                                'city' => $_POST['f-city'],
                                'postal' => $_POST['f-postal'],
                                'salutation' => $_POST['f-salutation'],
                                'trailingtitle' => $_POST['f-trailingtitle'],
                                'function' => $_POST['f-function'],
                                'department' => $_POST['f-department']
                            );


                            if($user_field_ids = $this -> model -> checkForUserFields($event_id)){

                                $ids = explode("::", $user_field_ids['user_field_ids']);
                                $form_id = $user_field_ids['id'];
                                $userfields = array();

                                foreach ($ids as &$id) {

                                    $id = str_replace(":", "", $id);

                                    $user_field = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));
                                    $name = "f-u-" . $user_field['title'];

                                    $title = $user_field['title'];

                                    $userfields[$title] = $_POST[$name];

                                }


                            }


                            if($this->model->insertNewUser($event_id, $user_data, $userfields)){
                                $location = APP_ROOT . 'backend/users/edit/' . $event_id;
                               header("Location: $location");
                            }







                        }
                    }else{

                        $form = new formbuilder("new_user");

                        $form -> addInput("text", "firstname", "Firstname", array('placeholder' => "The firstname of the user..."));
                        $form -> addInput("text", "lastname", "Lastname", array('placeholder' => "The lastname of the user..."));
                        $form -> addSelect("sex", "Sex", array('male' => 'Male', 'female' => 'Female'));
                        $form -> addInput("text", "proftitle", "Professional Title", array('placeholder' => "The professional title of the user..."));
                        $form -> addInput("text", "enterprise", "Enterprise", array('placeholder' => "The enterprise of the user..."));
                        $form -> addInput("text", "birthday", "Birthday", array('placeholder' => 'The birthday of the user...', 'class' => 'datepicker_userspec'));
                        $form -> addInput("email", "email", "Email", array('placeholder' => "The email of the user..."));
                        $form -> addInput("text", "fulladress", "Full adress", array('placeholder' => "The full adress of the user..."));
                        $form -> addInput("text", "street", "Street", array('placeholder' => "The street of the user..."));
                        $form -> addInput("text", "housenumber", "House number", array('placeholder' => "The house number of the user..."));
                        $form -> addInput("text", "city", "City", array('placeholder' => "The city of the user..."));
                        $form -> addInput("text", "postal", "Postal", array('placeholder' => "The postal of the user..."));
                        $form -> addInput("text", "salutation", "Salutation", array('placeholder' => "Which salutation should the user get?"));
                        $form -> addInput("text", "trailingtitle", "Trailing title", array('placeholder' => "The trailing title of the user..."));
                        $form -> addInput("text", "function", "Function", array('placeholder' => "The function of the user..."));
                        $form -> addInput("text", "department", "Department", array('placeholder' => "The department of the user..."));

                        // Check if event has userfields:
                        if($user_field_ids = $this -> model -> checkForUserFields($event_id)){
                            $ids = explode("::", $user_field_ids['user_field_ids']);
                            $form_id = $user_field_ids['id'];


                            foreach ($ids as &$id) {
                                $id = str_replace(":", "", $id);

                                $user_field = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));
                                var_dump($user_field);


                                $name = "u-" . $user_field['title'];

                                if($user_field['is_required'] == "true"){$required = true;}else{$required = false;};
                                switch ($user_field['type']) {
                                    case "text":
                                        $form ->addInput($user_field['type'], $name, $user_field['title'], array('placeholder' => $user_field['placeholder']), $required);
                                        break;
                                    case "time":
                                        $form ->addInput($user_field['type'], $name, $user_field['title'], array('placeholder' => $user_field['placeholder'], "class" => "timepicker_userspec"),$required);
                                        break;
                                    case "date":
                                        $form ->addInput("text", $name, $user_field['title'], array('placeholder' => $user_field['placeholder'], "class" => "datepicker_userspec"),$required);
                                        break;
                                    case "number":
                                        $form ->addInput($user_field['type'], $name, $user_field['title'], array('placeholder' => $user_field['placeholder']),$required);
                                        break;
                                    case "select":
                                        $user_options = explode("::",$user_field['data_values']);
                                        $options = array();

                                        foreach ($user_options as &$option){
                                            $option = str_replace(":", "", $option);
                                            array_push($options, $option);
                                        }


                                        $form ->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']),$required);
                                        break;
                                    case "radio":
                                        $user_options = explode("::",$user_field['data_values']);
                                        $options = array();

                                        foreach ($user_options as &$option){
                                            $option = str_replace(":", "", $option);
                                            array_push($options, $option);
                                        }


                                        $form ->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']),$required);
                                        break;
                                    case "checkbox":
                                        $user_options = explode("::",$user_field['data_values']);
                                        $options = array();

                                        foreach ($user_options as &$option){
                                            $option = str_replace(":", "", $option);
                                            array_push($options, $option);
                                        }


                                        $form ->addSelect($name, $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']),$required);
                                        break;
                                    case "textarea":
                                        $form -> addTextarea($user_field['id'], $user_field['title'], array('placeholder' => $user_field['placeholder']),$required);
                                        break;
                                }

                            }
                        }

                        $form -> addInput("submit", "neweventuser", null, array('value' => 'Save', 'class' => 'spec_dashboard'));

                        $this -> view -> data['user_values'] = $form ->getForm();


                        $this -> view -> render("users/new_user", $this -> view ->data);
                    }
                }
            }else{
                $this -> view -> data['event_name'] = $this -> model -> getEventName($event_id);
                $this -> view -> data["users"] = $this -> model -> getAllUsers($event_id);
                $this -> view -> data["event_id"] = $event_id;

                $this -> view -> render("users/edit", $this -> view -> data);
            }



        }

    public function resetStats(){
        $event_id = $_POST['event_id'];
        $user_id = $_POST['user_id'];
        $type = $_POST['type'];

        if($type == "all"){
            if($this -> model -> resetAllStats($event_id, $user_id)){
                return "resetted";
            }else{
                return "error";
            }
        }else{
            if($this -> model -> resetTypeStats($event_id, $user_id)){
                return "resetted";
            }else{
                return "error";
            }
        }

    }
}