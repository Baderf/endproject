<?php

class users_list extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index($event_id){
        $this -> view -> data = $this -> model -> getUserDataEvent($event_id);
        $this -> view -> render("users_list/show", $this -> view -> data);
    }

    public function newUser($event_id){
        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if(isset($_POST['createneweventuser'])){
                $firstname = $_POST['f-firstname'];
                $lastname = $_POST['f-lastname'];
                $sex = $_POST['f-sex'];
                $proftitle = $_POST['f-proftitle'];
                $enterprise = $_POST['f-enterprise'];
                $birthday = $_POST['f-birthday'];
                $email = $_POST['f-email'];
                $fulladress = $_POST['f-fulladress'];
                $street = $_POST['f-street'];
                $housenumber = $_POST['f-housenumber'];
                $city = $_POST['f-city'];
                $postal = $_POST['f-postal'];
                $salutation = $_POST['f-salutation'];
                $trailingtitle = $_POST['f-trailingtitle'];
                $function = $_POST['f-function'];
                $department = $_POST['f-department'];

                if($this -> model -> createNewEventUser(
                    $event_id,
                    $firstname,
                    $lastname,
                    $sex,
                    $proftitle,
                    $enterprise,
                    $birthday,
                    $email,
                    $fulladress,
                    $street,
                    $housenumber,
                    $city,
                    $postal,
                    $salutation,
                    $trailingtitle,
                    $function,
                    $department
                )){
                    $id = $this -> model -> last_id;
                    header("Location: user_list/edit/$id");
                }

            }


        }else{

            $form = new formbuilder();

            $form -> addInput("text", "f-firstname", "Firstname");
            $form -> addInput("text", "f-lastname", "Lastname");
            $form -> addSelect("f-sex", "Sex", array('male' => 'Male', 'female' => 'Female'));
            $form -> addInput("text", "f-proftitle", "Professional Title");
            $form -> addInput("text", "f-enterprise", "Enterprise");
            $form -> addInput("date", "f-birthday", "Birthday");
            $form -> addInput("email", "f-email", "Email");
            $form -> addInput("text", "f-fulladress", "Full adress");
            $form -> addInput("text", "f-street", "Street");
            $form -> addInput("text", "f-housenumber", "House number");
            $form -> addInput("text", "f-city", "City");
            $form -> addInput("text", "f-postal", "Postal");
            $form -> addInput("text", "f-salutation", "Salutation");
            $form -> addInput("text", "f-trailingtitle", "Trailing title");
            $form -> addInput("text", "f-function", "Function");
            $form -> addInput("text", "f-department", "Department");


            $form -> addInput("submit", "createneweventuser", null, array('value' => 'Send', 'class' => 'spec_dashboard'));

            $this -> view -> data['form_default_values'] = $form ->getForm();


            $this -> view -> render("users_list/new", $this -> view -> data);
        }

    }

}