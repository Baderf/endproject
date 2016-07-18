<?php

class formulars extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this -> view -> data['username'] = sessions::get('uname');

        $this -> view -> render("formulars/index", $this -> view -> data);
    }

    public function new(){
        $this -> view -> render("formulars/new");
    }

    public function edit($form_id){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ) {
            if (isset($_POST['saveStandardFieldsFormular'])) {
                $active_fields = $_POST['active_standard_fields'];
                $deactive_fields = $_POST['deactive_standard_fields'];

                if($this -> model -> updateStandardFields($form_id, $active_fields, $deactive_fields)){
                      // GUT
                }else{
                    // SCHLECHT
                }
            }

        }

        $this -> model -> getFormularInfos($form_id);
        $this -> view -> render("formulars/edit");


    }

}