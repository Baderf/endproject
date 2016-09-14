<div class="wrapper clearfix">

    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>

    <div class="col-lg-12 page_header spec_event" id="send_mail">
        <h3>Send - Report: <?php echo $data['mail_infos']['title'];?></h3>
        <span class="page_quader"></span>
    </div>

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
            <h4>Success - Your mail was sent!</h4>
            <hr>
            <div class="alert alert-success info_shown col-lg-12 col-sm-12 col-xs-12 col-md-12">
                <strong>Success!</strong> The mail was sent to all users!  <br>   <br>
                <p>The mail was sent succesfuly! You can now close this window or go back to the <a href="<?php echo APP_ROOT . 'backend/' . 'dashboard';?>">dashboard</a>!</p>
            </div>




        </div>


    </div>




    <!-- /.container -->

</div>

<!-- /.container -->

</div>