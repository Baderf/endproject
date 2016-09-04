<div class="wrapper clearfix">

    <div class="mail_saving user_saving">
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


<?php
  if($data['user_mails']){
      ?>

    <div class="overlay is_hidden_settings" data-action="close">
        <div class="overlay_wrapper" id="overlay_wrapper_settings">
            <span class="btn_cancel" data-action="close">&times;</span>

            <h3 class="spec_event">Mails to send</h3>

            <p>Choose the Mail you want to send:</p>
                  <form action="" method="post">
                      <div class="form-group">
                          <label class="control-label" for="user_mails">Mails:</label>
                          <select class="form-control" name="user_mails" id="user_mails">
                              <option value="default">Please choose...</option>
                              <?php

                              foreach($data['user_mails'] as $mail){

                                  ?>
                                  <option value="<?php echo $mail['id']; ?>"><?php echo $mail['title']; ?></option>
                              <?php
                              }

                              ?>


                          </select>
                      </div>

                      <input type="submit" class="btn btn-block spec_dashboard" disabled="true" name="send_user_mail" id="send_button_user_mail" value="send">
                  </form>

        </div>
    </div>

      <?php

  }
?>


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
                    if($option['invitation_sent'] == 1){
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
                if(!empty($data['user_mails'])) {
                    ?>
                    <hr>
                    <h4>Send Mails:</h4>
                    <button class="btn btn-sm btn-block spec_event" id="send_mail_user">Send user mail</button>
                    <?php
                }else{
                    ?>
                    <div class="alert alert-info">
                      <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                      <strong>Info! </strong>This event has no mails yet. To send the user mails you first have to create mails.
                  </div>
                <?php
                }
                ?>
                <hr>
                <h4>Set user options:</h4>
                <input type="hidden" value="<?php echo $url[3]; ?>" id="event_id">
                <input type="hidden" value="<?php echo $url[5]; ?>" id="user_id">

                <div class="user_reactions">
                <?php

                    if($data['user_reactions']['yes'] == "0" && $data['user_reactions']['no'] == "0"){
                    ?>
                        <p>Active status:</p>
                        <p class="btn-sm btn-warning">no action</p>
                        <p>Set other status:</p>
                        <button id="user_participate" data-action="participate" class="user_reaction btn btn-sm btn-default">participate <i class='fa fa-spinner fa-spin'></i></button>
                        <button id="user_cancel" data-action="cancel" class="user_reaction btn btn-sm btn-default">dont participate <i class='fa fa-spinner fa-spin'></i></button>
                    <?php
                    }elseif($data['user_reactions']['yes'] == "1"){
                    ?>
                        <p>Active status:</p>
                        <p class="btn-sm btn-success">participate</p>
                        <p>Set other status:</p>
                        <button id="user_noaction" data-action="noaction" class="user_reaction btn btn-sm btn-default">no action <i class='fa fa-spinner fa-spin'></i></button>
                        <button id="user_cancel" data-action="cancel" class="user_reaction btn btn-sm btn-default">dont participate <i class='fa fa-spinner fa-spin'></i></button>
                    <?php
                    }else{
                    ?>
                        <p>Active status:</p>
                        <p class="btn-sm btn-danger">dont participate</p>
                        <p>Set other status:</p>
                        <button id="user_participate" data-action="participate" class="user_reaction btn btn-sm btn-default">participate <i class='fa fa-spinner fa-spin'></i></button>
                        <button id="user_noaction" data-action="noaction" class="user_reaction btn btn-sm btn-default">no action <i class='fa fa-spinner fa-spin'></i></button>

                    <?php
                    }
                ?>
                </div>
            </div>

        </div>

    </div>

    <!-- /.container -->

</div>