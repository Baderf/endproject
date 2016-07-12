<?php

class messages extends user_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $this->view->data['chats'] = $this->model->getAllMessages();
        $this->view->render('messages/index', $this->view->data);
    }

    public function newmessage(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){
            $this -> process();
        }

        $form = new formbuilder("messages");
        $form
            -> addInput("text", "user", "Empfange User")
            -> addInput("hidden", "userids", null)
            -> addTextarea("message", "Nachricht")
            -> addInput("submit", "insertmessage", null, array('value' => 'Nachricht absenden'))
        ;

        $this -> view -> data['form'] = $form -> getForm();
        $this -> view -> render('messages/newmessage', $this -> view -> data);
    }

    public function chat( $chatGroupID = null ){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){
            $this -> chatprocess($chatGroupID);
        }

        $this -> model -> checkAlreadyRead($chatGroupID);

        if( $chatGroupID !== null ){

            $form = new formbuilder("reply");
            $form
                -> addTextarea("message", "Antwort verfassen")
                -> addInput("hidden", "chatid", null, array("value" => $chatGroupID))
                -> addInput("submit", "insertmessage", null, array('value' => 'Nachricht absenden'))
            ;

            $this -> view -> data['form'] = $form -> getForm();

            $this -> view -> data['chatmessages'] = $this -> model -> getChatMessages( $chatGroupID );
            $this -> view -> render('messages/chat', $this -> view -> data);
        }
    }

    private function process(){

        if( sessions::get('form-token') == $_POST['form-token']){

            $groupid = $this -> model -> createChat($_POST['f-userids'], $_POST['f-message']);

            header('Location: ' . APP_ROOT . 'messages/chat/' . $groupid);
            exit();
        }
    }

    private function chatprocess($chatGroupID = null){

        if( sessions::get('form-token') == $_POST['form-token']){
            $this -> model -> checkAlreadyRead($chatGroupID);
            $groupid = $this -> model -> createMessage($chatGroupID, $_POST['f-message']);
        }
    }

    public function insertmessage(){
        $message = $_POST['message'];
        $groupID = $_POST['groupid'];


        echo $this -> model -> createMessage($groupID, $message, true);
    }

    public function updatemessage(){
        $msgID = $_POST['msgid'];
        $message = $_POST['msg'];

        $this -> model -> updateMessage($msgID, $message);
    }

}