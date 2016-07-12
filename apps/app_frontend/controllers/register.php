<?php

class register extends guest_controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        if( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST) ){
            $this -> process();
        }

        $form = new formbuilder("register");

        $options = array( 'Österreich', 'Deutschland', 'Schweiz' );

        $form
            -> addInput("text", "vname", "Vorname", array('placeholder' => "Guillermo"))
            -> addInput("text", "nname", "Nachname", array('placeholder' => "Neugebauer"))
            -> addInput("text", "uname", "Username", array('placeholder' => 'Benutzername'))
            -> addInput("email", "email", "E-Mailadresse", array('placeholder' => 'test@test.at'))
            -> addInput("password", "pw", "Passwort")
            -> addInput("password", "pwwh", "Passwort Wiederholung")
            -> addSelect("country", "Land", $options, 0)
            -> addInput("submit", "setregister", null, array('value' => 'Jetzt registrieren'))
        ;

        $this -> view -> data['form'] = $form -> getForm();

        $this -> view -> render('register/index', $this -> view -> data);
    }

    public function success(){

        $this -> view -> render('register/success');
    }

    public function activate($hash = null){

        if( $hash !== null){
            if( $this -> model -> setActivate($hash) === false ){
                $this -> view -> data['text'] = "Sie wurden bereits aktiviert.";
            }else{
                $this -> view -> data['text'] = "Sie wurden erfolgreich aktiviert. Sie können sich nun einloggen";
            }

            $this -> view -> render('register/activate', $this -> view -> data);
        }
    }

    private function process(){

        if( $_POST['form-token'] == sessions::get('form-token') ){

            $validation = new validation();
            $validation -> val($_POST['f-vname'], "Vorname", true, "text", 2, 20);
            $validation -> val($_POST['f-nname'], "Nachname", true, "text", 2, 20);
            $validation -> val($_POST['f-uname'], "Username", true, "textnumber", 5, 15);
            $validation -> val($_POST['f-email'], "E-Mailadresse", true, "email");
            $validation -> val($_POST['f-pw'], "Passwort", true, "password", 6);
            $validation -> check(
                array('name' => 'Passwort', 'value' => $_POST['f-pw']),
                array('name' => 'Passwort Wiederholung', 'value' => $_POST['f-pwwh'])
            );

            $errors = $validation -> getErrors();

            if( $errors === false ){
                // Es gibt keine Fehler

                // In die DB eintragen
                $hash = $this -> model -> setRegister($_POST);

                $link = APP_ROOT . "register/activate/" . $hash;
                $message = "<p>
                Danke für die Registrierung. Um diese abzuschließen klicke auf den folgenden Link
                <br><br>
                <a href=\"$link\">Bitte klicken Sie hier.</a>
                </p>"; // optimal: E-Mail-Template-View reinladen

                // Mail versenden
                $mail = new PHPMailer();
                $mail -> CharSet = 'utf-8';
                $mail -> IsHTML(true);
                $mail -> AddAddress($_POST['f-email']);
                $mail -> SetFrom("guillermo@smartlabs.at");
                $mail -> Subject = "Ihre Registrierung bei MVC";
                $mail -> Body = $message;
                $mail -> Send();

                // Weiterleitung auf Register - Success
                header('Location: register/success');
                exit();

            }else{
                // Es gibt Fehler
                $this -> view -> data['formErrors'] = $errors;
            }
        }
    }
}