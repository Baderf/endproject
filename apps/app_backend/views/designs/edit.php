
<div class="overlay is_hidden_testmail" data-action="close">
    <div class="overlay_wrapper clearfix" id="overlay_wrapper_testmail">
        <span class="btn_cancel" data-action="close">&times;</span>

        <h3 class="spec_event">Testmail to:</h3>

        <p>Please type in the email to whom you want to send this mail!</p>
        <form action="" method="post">
            <div class="form-group">
                <label class="control-label" for="user_mails">Mails:</label>
                <input class="form-control" type="email" name="test_mail_to" id="test_mail_to" value="" placeholder="Type in an email...">
            </div>

            <input type="submit" class="btn btn-block spec_dashboard" name="send_user_mail" id="send_button_user_testmail" value="send">
        </form>

        <div class="hidden_message alert alert-success send_success">
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Successfuly saved! <i class='glyphicon glyphicon-ok'></i></strong>
        </div>
        <div class="hidden_message alert alert-danger send_error">
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->

        </div>
    </div>
</div>
<div class="overlay is_hidden_showinfo" data-action="close">
    <div class="overlay_wrapper clearfix" id="overlay_wrapper_show_info">
        <span class="btn_cancel" data-action="close">&times;</span>

        <h3 class="spec_event">Information</h3>

        <ul>
            <li>
                <strong>Salutation:</strong>
                <p>To insert a Salutation just insert this text: <strong>###Salutation###</strong></br>
                    The Salutation works as follows:<br><br>

                    Dear + Sex of your user (Mr./Ms.) + Lastname of your user!

                </p>

            </li>
        </ul>

    </div>
</div>

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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_area">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 design_tools">
            <div class="col-lg-12 col-md-12 visible-lg visible-md design_switch_row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_switch switch_designs switch_active">
                    <span class="glyphicon glyphicon-picture"></span>
                    <p>design</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_switch switch_content">
                    <span class="glyphicon glyphicon-align-justify"></span>
                    <p>content</p>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 visible-lg visible-md design_tool_elements" >
                <!-- HIER -->


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool_elements_left" id="left_2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_image.jpg'; ?>">
                        <p>2 Images with Text</p>
                        <div class="email_header email-item">

                            <div id="editor94" contenteditable="true">
                                <table cellspacing="0" cellpadding="0" border="0" style="width:100%" class=" cke_show_border"><tbody><tr><td style="width:50%"><h3>Your image goes here...</h3></td><td><br></td><td style="width:50%"><h3>Your image goes here...</h3></td></tr><tr><td>More text goes here...</td><td><br></td><td>More text goes here</td></tr></tbody></table><p>More text goes here.</p>
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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_icon.jpg'; ?>">
                        <p>Text-Image-box</p>
                        <div class="email_header email-item">

                            <div id="editor103" contenteditable="true">
                                <table cellspacing="0" cellpadding="5" border="0" style="width:100%" class=" cke_show_border"><tbody><tr><td style="width:50%"><h3>place image here</h3><p><br></p></td><td><br></td><td style="width:50%"><h3>your text goes here</h3><p><br></p></td></tr><tr><td>More text goes here</td><td><br></td><td>More text goes here</td></tr></tbody></table><p><br></p><p style="text-align: left;">More text goes here.</p>
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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_image.jpg'; ?>">
                        <p>2 Images with Text</p>
                        <div class="email_header email-item">

                            <div id="editor31" contenteditable="true">
                                <table cellspacing="0" cellpadding="0" border="0" style="width:100%" class=" cke_show_border"><tbody><tr><td style="width:50%"><h3>Your image goes here...</h3></td><td><br></td><td style="width:50%"><h3>Your image goes here...</h3></td></tr><tr><td>More text goes here...</td><td><br></td><td>More text goes here</td></tr></tbody></table><p>More text goes here.</p>
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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/title_icon.jpg'; ?>">
                        <p>Titlebox</p>
                        <div class="email_header email-item">

                            <div id="editor91" contenteditable="true">
                                <table cellspacing="0" cellpadding="5" border="0" style="width:100%; background-color: #e9f93c;" class=" cke_show_border"><tbody><tr><td style="width:50%" colspan="3"><h3 style="text-align: left;">Title of your event...</h3></td></tr></tbody></table><p><br></p><p style="text-align: left;">More text goes here.</p>
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
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_image.jpg'; ?>">
                        <p>Imagebox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_image.jpg'; ?>">
                        <p>Text-Imagebox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_icon.jpg'; ?>">
                        <p>Textbox</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 design_tool_elements_left" id="left_4">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_image.jpg'; ?>">
                        <p>Text-Image box</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/title_icon.jpg'; ?>">
                        <p>Titlebox</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 design_tool">
                        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/icons/text_icon.jpg'; ?>">
                        <p>Textbox</p>
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
                <a href="#" class="btn btn-default btn-block btn-back btn-self btn_test_mail" id="open_test_mail">Send testmail</a>
                <a href="#" class="btn btn-default btn-block btn-back btn-self btn_show_info" id="show_info">Info</a>
                <button class="btn btn-default btn-block btn-back btn-self visible-lg visible-md" id="setmetaboxes">Set meta-boxes</button>
                <hr>
                <form action="" method="post">

                    <input type="hidden" id="this_id" name="this_id" value="<?php echo $url[3];?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo sessions::get("userid");?>">
                    <input type="hidden" id="mail_title" name="mail_title" value="<?php echo $data['mail_infos']['title'];?>">
                    <input type="hidden" id="emailhtmlall" name="emailhtmlall" value="">
                    <input type="hidden" id="emailhtmltext" name="emailhtmltext" value="">
                    <button class="btn btn-block btn-primary btn-self" id="save_email" name="savemail">save <i class='fa fa-spinner fa-spin'></i></button>
                </form>
            </div>
        </div>

        <div class="col-lg-9 col-md-12 visible-lg visible-md templater">

            <script src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . "ckeditor/ckeditor.js";?>"></script>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_toolbar" id="toolbarLocation">
                </div>



            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 email-wrapper" id="email_template">
                <?php $user_file = "usermedia_" . sessions::get("userid") . "/";
                $mail_file = "mails/mail_edit/mail_" . $data['mail_id'] . ".html";

                if(!require_once $_SERVER['DOCUMENT_ROOT'] . "/" . APPS . CURRENT_APP . APP_PUBLIC . "media/" . $user_file . $mail_file){
                    ?>
                    <div class="alert alert-warning">
                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        <strong>We are sorry, there was a problem getting your mail!</strong>
                        <br>
                        <i class="glyphicon glyphicon-thumbs-down"></i><br><br>
                        Please contact us. We will fix the problem.
                    </div>
                <?php
                }?>
            </div>


        </div>

        <div class="col-sm-6 col-xs-12 visible-sm visible-xs templater_info">
            <div class="alert alert-warning">
                <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                <strong>We are sorry, your device is too small!</strong>
                <br><br>
                <i class="glyphicon glyphicon-thumbs-down" style="display:block; text-align: center; font-size:30px;"></i><br><br>
                Please switch to a bigger screen. The mail needs a space from 720 pixels, so that's very much space.
            </div>
        </div>
    </div>

    <!-- /.container -->

</div>
<!-- /.banner -->