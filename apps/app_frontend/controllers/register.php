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
            -> addInput("text", "vname", "Firstname", array('placeholder' => "Guillermo"))
            -> addInput("text", "nname", "Lastname", array('placeholder' => "Neugebauer"))
            -> addInput("text", "uname", "Username", array('placeholder' => 'Benutzername'))
            -> addInput("email", "email", "E-Mail", array('placeholder' => 'test@test.at'))
            -> addInput("password", "pw", "Password")
            -> addInput("password", "pwwh", "Password repeat")
            -> addSelect("country", "Country", $options, 0)
            -> addInput("submit", "setregister", null, array('value' => 'Register now!'))
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
                $this -> view -> data['text'] = "You are already acitvated.";
            }else{
                $this -> view -> data['text'] = "The activation was successful. You can now login to your account!";
            }

            $this -> view -> render('register/activate', $this -> view -> data);
        }
    }

    private function process(){

        if( $_POST['form-token'] == sessions::get('form-token') ){

            $validation = new validation();
            $validation -> val($_POST['f-vname'], "Firstname", true, "text", 2, 20);
            $validation -> val($_POST['f-nname'], "Lastname", true, "text", 2, 20);
            $validation -> val($_POST['f-uname'], "Username", true, "textnumber", 5, 15);
            $validation -> val($_POST['f-email'], "E-Mail", true, "email");
            $validation -> val($_POST['f-pw'], "Password", true, "password", 6);
            $validation -> check(
                array('name' => 'Passwort', 'value' => $_POST['f-pw']),
                array('name' => 'Passwort repeat', 'value' => $_POST['f-pwwh'])
            );

            $errors = $validation -> getErrors();

            if( $errors === false ){
                // Es gibt keine Fehler

                // In die DB eintragen
                $hash = $this -> model -> setRegister($_POST);

                $link = "www.baderflorian.at/register/activate/" . $hash;
                $message = "<p>
                Thank you for registration to mailpig. Please click at the following link to activate your account!
                <br><br>
                <a href=\"$link\">Please click here.</a>
                </p>"; // optimal: E-Mail-Template-View reinladen

                // Mail versenden

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = 'florian.bader.merken@gmail.com';                 // SMTP username
                $mail->Password = 'Schnappi33!';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;
                //$mail->SMTPDebug = 2;
                $mail->isHTML(true);
                $mail -> Body = $message;
                $mail->setFrom('florian.bader.merken@gmail.com', "Mailpig");

                $mail->Subject = "Your registration at mailpig";
                $mail -> AddAddress($_POST['f-email']);


                $mail -> send();

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