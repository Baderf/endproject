<?php

class formulars extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public $active_fields;
    public $deactive_fields;

    public function index(){


        if(!$this -> view -> data['formulars'] = $this -> model -> getAllFormulars(sessions::get("userid"))){
            $this -> view -> data['formulars'] = "none";
        }

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("formulars/index", $this -> view -> data);
    }

    public function preview($form_id){

        // Formular Infos:
        $form_infos = $this -> model -> getFormularDetails($form_id);
        $this -> view -> data['form_details'] = $form_infos;

        // Holen der Standard-Felder
        $standard_fields = $this -> model -> getFormularStandardfields($form_id);

        //Holen der aktiven Standard-Felder
        $active_standard_fields = $form_infos['standard_field_ids'];

        $user_fields = $form_infos['user_field_ids'];


        // Holen der einzelnen User-Felder



        if(!empty($active_standard_fields)){
            $active_ids = explode("::", $active_standard_fields);

            $form = new formbuilder("preview_".$form_id);

            foreach ($active_ids as $id) {
                $id = str_replace(":", "", $id);

                foreach ($standard_fields as $field){
                    if($field['id'] == $id){
                        $placeholder = 'Pleace insert your ' . $field['fullname'] . ' ...';
                        $form ->addInput($field['type'], $field['name'], $field['fullname'], array('placeholder' => $placeholder));
                    }
                }


            }
            if(!empty($user_fields)){

                $user_ids = explode("::", $user_fields);

                foreach ($user_ids as &$id) {
                    $id = str_replace(":", "", $id);

                    $user_field = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));


                    switch ($user_field['type']) {
                        case "text":
                            $form ->addInput($user_field['type'], $user_field['id'], $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']));
                            break;
                        case "time":
                            $form ->addInput($user_field['type'], $user_field['id'], $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "timepicker_userspec"));
                            break;
                        case "date":
                            $form ->addInput($user_field['type'], $user_field['id'], $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder'], "class" => "datepicker_userspec"));
                            break;
                        case "number":
                            $form ->addInput($user_field['type'], $user_field['id'], $user_field['title'], array('value' => $user_field['default_value'], 'placeholder' => $user_field['placeholder']));
                            break;
                        case "select":
                            $user_options = explode("::",$user_field['data_values']);
                            $options = array();

                            foreach ($user_options as &$option){
                                $option = str_replace(":", "", $option);
                                array_push($options, $option);
                            }


                            $form ->addSelect($user_field['id'], $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                            break;
                        case "radio":
                            $user_options = explode("::",$user_field['data_values']);
                            $options = array();

                            foreach ($user_options as &$option){
                                $option = str_replace(":", "", $option);
                                array_push($options, $option);
                            }


                            $form ->addSelect($user_field['id'], $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                            break;
                        case "checkbox":
                            $user_options = explode("::",$user_field['data_values']);
                            $options = array();

                            foreach ($user_options as &$option){
                                $option = str_replace(":", "", $option);
                                array_push($options, $option);
                            }


                            $form ->addSelect($user_field['id'], $user_field['title'], $options, $selected = $user_field['default_value'], array('placeholder' => $user_field['placeholder']));
                            break;
                        case "textarea":
                             $form -> addTextarea($user_field['id'], $user_field['title'], array('placeholder' => $user_field['placeholder']));
                             break;
                    }
                }
            }



            $form -> addInput("submit", "setregister", null, array('value' => 'Send', 'class' => 'spec_dashboard'));

            $this -> view -> data['form'] = $form ->getForm();
        }


        $this -> view -> render("formulars/preview", $this -> view -> data, false);

    }

    public function newFormular(){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
           $title = $_POST['formtitle'];

            if($this -> model -> createNewFormular($title, sessions::get("userid"))){
                $formular_id = $this -> model -> last_id;
                if($formular_id){
                    header("Location: edit/$formular_id");
                }

            }
        }
        $this -> view -> render("formulars/new");
    }

    public function edit($form_id){


        if($events = $this -> model -> checkForEntries($form_id, sessions::get("userid"))){
            $this -> view -> data['linked_events'] = $events;
        }

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {




            if (isset($_POST['saveStandardFieldsFormular'])) {
                $active_fields = $_POST['active_standard_fields'];
                $deactive_fields = $_POST['deactive_standard_fields'];

                if ($this->model->updateStandardFields($form_id, $active_fields, $deactive_fields)) {
                    // GUT
                } else {
                    // SCHLECHT
                }
            } elseif (isset($_POST['saveOverviewFormular'])) {
                $title = $_POST['formtitle'];
                $description = $_POST['formdescription'];
                $action = $_POST['formaction'];
                $action_target = "";
                if (isset($_POST['form_choose_url']) && !empty($_POST['form_choose_url'])) {
                    $action_target = $_POST['form_choose_url'];
                } elseif (isset($_POST['form_choose_mail']) && !empty($_POST['form_choose_mail'])) {
                    $action_target = $_POST['form_choose_mail'];
                } elseif (isset($_POST['form_choose_feedback']) && !empty($_POST['form_choose_feedback'])) {
                    $action_target = $_POST['form_choose_feedback'];
                }


                if ($this->model->updateFormularDetails($form_id, $title, $description, $action, $action_target)) {
                    // GUT
                } else {
                    // SCHLECHT
                }

            } elseif (isset($_POST['saveUserFields'])){

                if(isset($_POST['linked_events'])){
                    $ids = $_POST['linked_events'];
                    $user_id = $_POST['user_id'];

                    $this -> model -> deleteUserColumns($ids, $form_id);
                }

                $ids_all = $_POST['UserFieldIds'];
                $ids = explode("::", $_POST['UserFieldIds']);
                foreach ($ids as &$id) {
                    $id = str_replace(":", "", $id);

                    $title = $_POST['user_field_title_' . $id];
                    $type = $_POST['user_field_type_' . $id];
                    $default_value = $_POST['user_field_default_' . $id];
                    $data_values = $_POST['user_field_values_' . $id];
                    $placeholder = $_POST['user_field_placeholder_' . $id];
                    $is_required = $_POST['user_field_required_' . $id];

                    if(isset($_POST['user_field_new_' . $id])){
                        // New User Field

                       if($this -> model -> createUserFormular(sessions::get("userid"), $form_id, $title, $type, $default_value, $data_values, $placeholder, $is_required)){
                           
                           // FEEDBACK HAT GEPASST

                       }
                    }elseif(!isset($_POST['user_field_new_' . $id])){
                        // Update user field


                        if($this -> model -> updateUserFormular(sessions::get("userid"), $form_id, $id, $title, $type, $default_value, $data_values, $placeholder, $is_required)){
                            // FEEDBACK HAT GEPASST

                        };
                    }

                }



                // Update:
                if($this -> model -> updateUserFormularDetails($form_id, sessions::get("userid"), $ids_all)){
                    // FEEDBACK HAT PASST

                    if(isset($_POST['linked_events'])){
                        $ids = $_POST['linked_events'];

                        $this -> model -> createUserColumns($ids, $form_id);
                    }


                    $location = APP_ROOT . 'backend/' . 'formulars/' . 'edit/' . $form_id;


                    header("Location: $location");
                }




            }
        }

        $this -> view -> data['formdetails'] = $this -> model -> getFormularDetails($form_id);

        // Kontrolle der aktiven und der deaktiven Formular-Felder:

        $active_ids = $this -> view -> data['formdetails']['standard_field_ids'];
        $standard_forms =  $this -> model -> getFormularStandardFields($form_id);

        $active_forms = array();

        if(!empty($this -> view -> data['formdetails']['standard_field_ids'])){
            $first_ids = explode("::", $active_ids);

            foreach ($first_ids as &$first_id){
               $first_id = str_replace(":", "", $first_id);

               foreach ($standard_forms as &$form){
                   if($form['id'] == $first_id){
                       array_push($active_forms, $form);
                       $found_id = intval($form['id'])-1;
                       unset($standard_forms[$found_id]);
                   }
               }

            }
        }


        $this -> view -> data['activefields'] = $active_forms;
        $this -> view -> data['deactivefields'] = $standard_forms;

        // GET USER_SPEC_FORMS:
        $user_form_ids = $this -> view -> data['formdetails']['user_field_ids'];

        if(!empty($user_form_ids)){
            $user_ids = explode("::", $user_form_ids);

            foreach ($user_ids as &$id){
                $id = str_replace(":", "", $id);


                $this -> view -> data['user_form_' . $id] = $this -> model -> getUserFormular($form_id, $id, sessions::get("userid"));

            }

            $this -> view -> data['user_form_ids'] = $user_form_ids;
        }

        $this -> view -> data['last_user_id'] = $this -> model -> getLastIdFormulars();

        //$this -> view -> data['formuserfields'] = $this -> model -> getFormularUserFields($form_id, sessions::get("userid"));
        $this -> view -> render("formulars/edit", $this -> view -> data);


    }

}