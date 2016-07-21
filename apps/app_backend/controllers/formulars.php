<?php

class formulars extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public $active_fields;
    public $deactive_fields;

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("formulars/index", $this -> view -> data);
    }

    public function new(){
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