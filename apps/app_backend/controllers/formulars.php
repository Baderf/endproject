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
                echo "Hallo" ;
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

        //$this -> view -> data['formuserfields'] = $this -> model -> getFormularUserFields($form_id, sessions::get("userid"));
        $this -> view -> render("formulars/edit", $this -> view -> data);


    }

}