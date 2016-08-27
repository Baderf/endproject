<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
            $url_back = htmlspecialchars($_SERVER['HTTP_REFERER']);
            ?>
            <a href="<?php
            echo $url_back;
            ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>

    </div>

    <div class="hidden">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $url[5];?>">
        <input type="hidden" id="event_id" name="event_id" value="<?php echo $url[3];?>">

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


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3>Edit User:</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <!-- jQuery -->

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 default_user_values">
                <h4>User-Data:</h4>
                <?php echo $data['user_values'];?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 default_user_mail_settings">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4>Reset Mail Statics of User:</h4>

                <?php

               if(!isset($data['reset_options']) || empty($data['reset_options'])){
                   ?>
                   <div class="alert alert-info">
                       <strong>Info!</strong> This user has got no mails from you!
                   </div>
                   <?php
               }else{

                // Wenn 0 dann nur ein div mit info anzeigen
                foreach ($data['reset_options'] as $option){
                    if($option['invitation_sent'] != 0){
                        ?>
                        <div>
                        <button class="btn-block btn btn-sm spec_event static_delete" id="invitation">invitation statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php
                    }if($option['std_sent'] != 0){
                        ?>
                        <div>
                        <button class="btn-block btn btn-sm spec_event static_delete" id="std">save the date statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php
                    };
                    if($option['reminder_sent'] != 0){
                        ?>
                        <div>
                        <button class="btn-block btn btn-sm spec_event static_delete" id="reminder">reminder statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php
                    };
                    if($option['info_sent'] != 0){
                        ?>
                        <div>
                        <button class="btn-block btn btn-sm spec_event static_delete" id="info" >information statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php
                    };
                    if($option['ty_sent'] != 0){
                        ?>
                        <div>
                        <button class="btn-block btn btn-sm spec_event static_delete" id="ty">thank you statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php
                    }elseif ($option['ty_sent'] == '0' && $option['info_sent'] == 0 && $option['reminder_sent'] == 0 && $option['std_sent'] == 0 && $option['invitation_sent'] == 0){
                    ?>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> This user didn't get any email from you yet!
                        </div>
                <?php
                    }else{
                        ?>
                        <hr>
                        <div>
                            <button class="btn-block btn btn-sm spec_dashboard static_delete" id="all">All mail statics <i class='fa fa-spinner fa-spin'></i></button>
                        </div>
                            <?php

                    }
                }

               }


                ?>




            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 send_mail_user">
                <?php
                if(isset($data['send_options']) || !empty($data['send_options'])) {
                    ?>
                    <hr>
                    <h4>Send Mails:</h4>
                    <button class="btn btn-sm btn-block spec_event">Send user mail</button>
                    <?php
                }
                ?>

                <h4>Set user options:</h4>
                <button class="btn btn-sm btn-success">participate</button>
                <button class="btn btn-sm btn-warning">no action</button>
                <button class="btn btn-sm btn-danger">dont participate</button>
            </div>

        </div>

    </div>

    <!-- /.container -->

</div>