<div class="wrapper clearfix">

    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_event" id="send_mail">
        <h3>Send - Properties: <?php echo $data['mail_infos']['title'];?></h3>
        <span class="page_quader"></span>
    </div>

    <?php
    if(isset($data['sending-errors']) && $data['sending-errors'] === "error"){
        ?>
        <div class="alert alert-danger info_shown">
            <strong>Attention!</strong>  The mail couldn't be sent. Please check all settings and your user and try it again later!
        </div>
    <?php
    }
    ?>

    <input type="hidden" id="event_id" value="<?php echo $data['mail_infos']['event_id'];?>">
    <input type="hidden" id="user_id" value="<?php echo sessions::get("userid");?>">
    <input type="hidden" id="mail_id" value="<?php echo $data['mail_infos']['id'];?>">
    <input type="hidden" id="mail_type" value="<?php echo $data['mail_infos']['mail_type'];?>">
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


    <!-- /.content-section-a -->

    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 send_errors">
            <div class="alert alert-warning <?php if(isset($data['errors'])){echo "info_shown";}else{echo "full-info";}?> error_mail_settings">
                <strong>Warning! </strong> <?php if(isset($data['errors'])){echo $data['errors'];}?>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 create_event my_container clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="check_system">
                <h4>Checking your settings!</h4>
                <hr>
                <?php
                $type = $data['mail_infos']['mail_type'];

                if($type == "savethedate"){
                    $type = "Save the Date";
                    $text = "This is a <strong>$type</strong>-mail. The recipients are all persons who haven't got any mail from you from this event!";
                }elseif($type == "invitation"){
                    $text = "This is a <strong>$type</strong>-mail. The recipients are all persons who haven't got an invitation from this event.";
                }elseif($type == "reminder"){
                    $text = "This is a <strong>$type</strong>-mail. The recipients are all persons who made no reaction to any further mails.";
                }elseif($type == "information"){
                    $text = "This is a <strong>$type</strong>-mail. The recipients are all persons who accepted the invitation and have the status 'participate'.";
                }elseif($type == "thankyou"){
                    $type = "Thank you";
                    $text = "This is a <strong>$type</strong>-mail. The recipients are all persons who accepted the invitation and have the status 'participate'.";
                }

                ;?>
                <p><?php echo $text;?></p>


                <form action="" role="form" method="post">
                    <div class="form-group has-feedback has-feedback-left <?php if(isset($data['mail_infos']['sender']) && empty($data['mail_infos']['sender'])){echo 'info_settings';};?>">
                        <label class="control-label" for="mail_sender">Sender:</label>
                        <input class="form-control" type="text" name="mail_sender" id="mail_sender" value="<?php echo $data['mail_infos']['sender'];?>">
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
                    <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-info wait-info">
                        <strong>Waiting</strong> for the checking-system (right side)!
                        <i class="fa fa-spinner fa-spin fa-spinner-show"></i>
                    </div>
                    <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-danger info_invisible slide-info">
                        <strong>Attention</strong> for the checking-system (right side)!
                    </div>
                    <div>
                        <button class="btn btn-lg btn-block spec spec_event" id="update_settings" disabled="true">Update settings <i class='fa fa-spinner fa-spin'></i></button>
                        <input type="submit" disabled class="btn btn-lg btn-block spec spec_dashboard" id="send_mail_btn" name="send_mail" value="Send">
                    </div>


                    <!---->


            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 check_operator_area" id="check_operator">
                <h4>Checking your users!</h4>
                <hr>
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-info check_count_users">
                    <strong>Checking</strong> to how much user this mail goes!
                    <i class="fa fa-spinner fa-spin fa-spinner-show"></i>
                </div>
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-info check_mails_users">
                    <strong>Checking</strong> if all user-emails are ok!
                    <i class="fa fa-spinner fa-spin fa-spinner-show"></i>
                </div>
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-info check_mail_settings">
                    <strong>Checking</strong> if all email-settings are ok!
                    <i class="fa fa-spinner fa-spin fa-spinner-show"></i>
                </div>
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 alert alert-info check_user_duplicates">
                    <strong>Checking</strong> for duplicates!
                    <i class="fa fa-spinner fa-spin fa-spinner-show"></i>
                </div>
            </div>


            </form>
        </div>




        <!-- /.container -->

    </div>

    <!-- /.container -->

</div>