
<!-- Mobile Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top topnav visible-xs" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#about" class="nav-btn">Dashboard</a>
                </li>
                <li>
                    <a href="#services" class="nav-btn">My Events</a>
                </li>
                <li>
                    <a href="#contact" class="nav-btn">Designs</a>
                </li>
                <li>
                    <a href="#getstarted" class="nav-btn">Formulars</a>
                </li>
                <li>
                    <a href="#login" class="nav-btn">Settings</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#about" class="nav-btn">Logout</a>
                </li>
                <li>
                    <a href="#services" class="nav-btn">Logo</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<nav class="nav-logged_in navbar-fixed-top visible-sm visible-md visible-lg">

    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
            <li class="dashboard">
                <i class="icon icon_dashboard"></i>
                <a href="#about" class="nav-btn">Dashboard</a>
            </li>
            <li class="myevents">
                <i class="icon icon_myevents"></i>
                <a href="#services" class="nav-btn">My Events</a>
            </li>
            <li class="designs active">
                <i class="icon icon_designs"></i>
                <a href="#contact" class="nav-btn">Designs</a>
            </li>
            <li class="formulars">
                <i class="icon icon_formulars"></i>
                <a href="#getstarted" class="nav-btn">Formulars</a>
            </li>
            <li class="settings">
                <i class="icon icon_settings"></i>
                <a href="#login" class="nav-btn">Settings</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="logout">
                <i class="icon icon_logout"></i>
                <a href="#about" class="nav-btn">Logout</a>
            </li>
            <li>
                <i class="icon icon_logo"></i>
                <a href="#services" class="nav-btn"></a>
            </li>
        </ul>
    </div>

</nav>


<div class="overlay is_hidden_settings" data-action="close">
    <div class="overlay_wrapper" id="overlay_wrapper_settings">
        <span class="btn_cancel" data-action="close">&times;</span>

        <div class="alert alert-warning full-info">
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Warning! </strong>Please check the email settings and fill out all needed informations! Otherwise it could make some problems at sending this mail.
        </div>
        <h3 class="spec_event">Settings</h3>

        <form action="" method="post">
            <div class="form-group has-feedback has-feedback-left <?php if(isset($data['mail_infos']['title']) && empty($data['mail_infos']['title'])){echo 'info_settings';};?>" >
                <label class="control-label" for="mail_title">Name:</label>
                <input class="form-control" type="text" name="mail_title" id="mail_title" value="<?php echo $data['mail_infos']['title'];?>">
                <i class="glyphicon glyphicon-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback has-feedback-left <?php if(isset($data['event_info']['enterprise']) && empty($data['event_info']['enterprise'])){echo 'info_settings';};?>">
                <label class="control-label" for="mail_sender">Sender:</label>
                <input class="form-control" type="text" name="mail_sender" id="mail_sender" value="<?php echo $data['event_info']['enterprise'];?>">
                <i class="glyphicon glyphicon-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback has-feedback-left <?php if(isset($data['mail_infos']['sender_adress']) && empty($data['mail_infos']['sender_adress'])){echo 'info_settings';};?>">
                <label class="control-label" for="mail_sender_adress">Senders adress:</label>
                <input class="form-control" type="email" name="mail_sender_adress" id="mail_sender_adress" value="<?php echo $data['mail_infos']['sender_adress'];?>">
                <i class="glyphicon glyphicon-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback has-feedback-left <?php if(isset($data['mail_infos']['subject']) && empty($data['mail_infos']['subject'])){echo 'info_settings';};?>">
                <label class="control-label" for="subject">Subject:</label>
                <input class="form-control" type="text" name="subject" id="subject" placeholder="Type in the subject of the mail..." value="<?php echo $data['mail_infos']['subject'];?>">
                <i class="glyphicon glyphicon-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback has-feedback-left last_input <?php if(isset($data['mail_infos']['preview']) && empty($data['mail_infos']['preview'])){echo 'info_settings';};?>">
                <label class="control-label" for="preheader">Preview text:</label>
                <input class="form-control" type="text" name="preheader" id="preheader" placeholder="Type in your preview text..." value="<?php echo $data['mail_infos']['preview'];?>">
                <i class="glyphicon glyphicon-lock form-control-feedback"></i>
            </div>
            <div class="form-group mail_settings_buttons">
                <span class="btn btn-lg btn-home btn-home-big spec_event" data-action="close">close</span>
                <button id="saveMailSettings" class="btn btn-lg btn-home btn-home-big spec_dashboard">save <i class='fa fa-spinner fa-spin'></i></button>
            </div>
            <div class="hidden_message alert alert-success">
                <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                <strong>Successfuly saved! <i class='glyphicon glyphicon-ok'></i></strong>
            </div>

        </form>
    </div>
</div>

<div class="col-lg-12 hader_background">

</div>

<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="<?php echo $_SERVER['REFERER'];?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>


    </div>
    <div class="mail_saving">
        <div class="hidden_message alert alert-success fixed_alert">
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Successfuly saved! <i class='glyphicon glyphicon-ok'></i></strong>
        </div>
        <div class="hidden_message alert alert-info fixed_alert">
            <strong>Info!</strong>
        </div>
        <div class="hidden_message alert alert-danger fixed_alert">
            <strong>Danger!</strong>
        </div>
        <div class="hidden_message alert alert-warning fixed_alert">
            <strong>Warning!</strong>
        </div>
    </div>




    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_design">
        <h3>Design: <?php echo $data['mail_infos']['title'];?></h3>
        <span class="page_quader"></span>
    </div>

    <div class="alert alert-warning full-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
        <strong>Warning! </strong>Please check the email settings and fill out all needed informations! <br/>
        Otherwise it could make some problems at sending this mail.
    </div>

    <div class="design_menu visible-md visible-sm visible-xs">
        <span class="glyphicon glyphicon-picture"></span>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_area">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 design_tools">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_switch_row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_switch switch_designs switch_active">
                    <span class="glyphicon glyphicon-picture"></span>
                    <p>design</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_switch switch_content">
                    <span class="glyphicon glyphicon-align-justify"></span>
                    <p>content</p>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool_elements" >
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_tool_elements_left" id="left_1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_tool_elements_left" id="left_2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool" style="border-color: green">
                        <img src="http://fpoimg.com/120x60">
                        <p>Textbox</p>
                        <div class="email_header email-item">

                            <div id="editor8" contenteditable="true">
                                <h1>Inline Editing in Action!</h1>
                                <p>The "div" element that contains this text is now editable.
                            </div>

                            <div class="email_item_options">
                                <div>
                                    <a href="#" class="btn btn-sm btn-info arrow_up">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-sm btn-info arrow_down">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-sm btn-transparent item_delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div id="metaboxes">
                <div class="email-item metabox">
                    <div contenteditable="true" class="cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" tabindex="0" spellcheck="true" style="position: relative;" role="textbox" aria-describedby="cke_101">
                        <table cellspacing="0" cellpadding="0" border="0" style="width:100%" class=" cke_show_border"><tbody><tr><td style="width:50%"><h3><a href="###AUTHCODE-YES###">I will participate</a></h3></td><td><br></td><td style="width:50%"><h3><a href="###AUTHCODE-NO###">I can't participate</a></h3></td></tr><tr><td>Text 1</td><td><br></td><td>Text 2</td></tr></tbody></table><p>More text goes here.</p>
                    </div>

                    <div class="email_item_options">
                        <div>
                            <a href="#" class="btn btn-sm btn-info arrow_up">
                                <span class="glyphicon glyphicon-arrow-up"></span>
                            </a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-info arrow_down">
                                <span class="glyphicon glyphicon-arrow-down"></span>
                            </a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-transparent item_delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_tool_elements">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_tool_elements_left" id="left_3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_tool_elements_left" id="left_4">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="http://fpoimg.com/120x60">
                        <p>Content</p>
                    </div>
                </div>


            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_settings">


                <?php
                if($data['is_template'] == "1"){

                    ?>
                    <button type="button" class="btn btn-default btn-danger btn-block btn_template" id="load" data-action="delete" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..." data-success-text="Successful!"
                    >Delete as template</button>
                <?php

                }else{

                    ?>
                    <button type="button" class="btn btn-default btn-self btn-block btn_template" id="load" data-action="save" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..." data-success-text="Successful!"
                    >Save as template</button>
                    <?php

                }

                ?>

                <hr>
                <a href="#" class="btn btn-default btn-block btn-back btn-self btn_settings_mail">Settings <span class="settings_warner">x</span></a>
                <button class="btn btn-default btn-block btn-back btn-self" id="setmetaboxes">Set meta-boxes</button>
                <hr>
                <form action="" method="post">
                    <?php
                    $user_file = "usermedia_" . sessions::get("userid") . "/";
                    $mail_file = "mails/mail_edit/mail_" . $data['mail_id'] . ".html";

                    ob_start();
                    require_once $_SERVER['DOCUMENT_ROOT']. "/endproject/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file;
                    $email = ob_get_contents();
                    ob_end_clean();

                    ?>
                    <input type="hidden" id="this_id" name="this_id" value="<?php echo $url[3];?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo sessions::get("userid");?>">
                    <input type="hidden" id="mail_title" name="mail_title" value="<?php echo $data['mail_infos']['title'];?>">
                    <input type="hidden" id="emailhtmlall" name="emailhtmlall" value="1">
                    <input type="hidden" id="emailhtmltext" name="emailhtmltext" value="1">
                    <button class="btn btn-block btn-primary btn-self" id="save_email" name="savemail">save <i class='fa fa-spinner fa-spin'></i></button>
                </form>
            </div>
        </div>

        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 templater">

            <script src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . "ckeditor/ckeditor.js";?>"></script>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_toolbar" id="toolbarLocation">
                </div>



            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 email-wrapper" id="email_template">
                <?php echo $email;?>
            </div>


        </div>
    </div>

    <!-- /.container -->

</div>
<!-- /.banner -->