<div class="wrapper clearfix">

    <?php

    $intro = sessions::get("intro_on");

    if( $intro == "1"){
        ?>
        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/logo_pig.png'; ?>" class="mail_pig_helper_img" alt="">

        <div class="mailpig_helper">
            <div class="mailpig_speak_edge"></div>
            <div class="mailpig_steps">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                <div class="step step1 active" data-step="1">
                    Ok, here we are at your <strong>designs</strong>-list.
                    Here you will see created mails ...
                </div>
                <div class="step step2" data-step="2">
                    You can filter them on the left side...
                </div>
                <div class="step step3" data-step="3">
                    The mail is in progress so long you don't send it ...
                </div>
                <div class="step step4" data-step="4">
                    To create a new mail just click on <strong>create new design</strong>
                </div>

                <div class="mailpig_helper_options">
                    <button class="btn btn-sm spec_dashboard dont_show_again">dont show again <i class='fa fa-spinner fa-spin'></i></button>
                    <button class="btn btn-sm spec_event mailpig_prev"><i class="glyphicon glyphicon-step-backward"></i></button>
                    <button class="btn btn-sm spec_event mailpig_next"><i class="glyphicon glyphicon-step-forward"></i></button>
                    <input type="hidden" name="userid" class="helper_user_id" value="<?php echo sessions::get("userid");?>">
                </div>

            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="<?php echo $_SERVER['REFERER'];?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="<?php echo APP_ROOT . 'backend/designs/newDesign';?>" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Design
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_design">
        <h3>My Designs</h3>
        <span class="page_quader"></span>
        <form action="" method="post">
            <div class="search_field">
                <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 form-group has-feedback has-feedback-left">
                    <label class="control-label invisible" for="search">Search:</label>
                    <input class="form-control" name="search" type="text" id="search" placeholder="The formular title..">
                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
                <div class=" col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group has-feedback has-feedback-left">
                    <input type="submit" name="search_event" class="btn btn-block spec_dashboard" id="search_submit" value="go">
                </div>
            </div>

        </form>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_design">

            <ul class="list">
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/designs/all'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "all"){echo "active";}?>">All mails</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/designs/progress'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "progress"){echo "active";}?>">In progress</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/designs/alreadysent'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "alreadysent"){echo "active";}?>">Already sent</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/designs/latest'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "latest"){echo "active";}?>">Latest updated</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 area_loading_spinner"><p class="loading_text"><i class='fa fa-spinner fa-spin'></i></p></div>

            <?php

            if(isset($data['mails']) && !empty($data['mails']) && $data['mails'] != "none") {

                ?>

                <table class="table table-inverse table-striped table_mails">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th class="visible-lg visible-md visible-sm">Type</th>
                        <th class="visible-lg visible-md visible-sm">Eventname</th>
                        <th>In progress/sent</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table_mails_body">

                    <?php

                    if (isset($data['mails']) && !empty($data['mails'])) {
                        foreach ($data['mails'] as $mail) {
                            ?>

                            <tr class="item">
                                <th scope="row"><?php echo $mail['title']; ?></th>
                                <td class="mail_type visible-lg visible-md visible-sm"><?php echo $mail['mail_type']; ?></td>
                                <td class="visible-lg visible-md visible-sm"><?php echo $mail['event_title']; ?></td>
                                <td><?php
                                    if ($mail['already_sent'] == "1") {
                                        echo "already sent";
                                    } else {
                                        echo "in progress";
                                    }
                                    ?></td>
                                <td>

                                    <?php if ($mail['already_sent'] != "1") {
                                        ?>
                                        <a href="<?php echo APP_ROOT . 'backend/designs/edit/' . $mail['id']; ?>" class="btn btn-sm btn-info">edit</a>
                                        <a href="<?php echo APP_ROOT . 'backend/myevents/send/' . $mail['id']; ?>"
                                           class="btn btn-sm btn-success">send</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo APP_ROOT . 'backend/designs/view/' . $mail['id']; ?>" class="btn btn-sm btn-info">view</a>
                                        <a href="<?php echo APP_ROOT . 'backend/myevents/send/' . $mail['id']; ?>"
                                           class="btn btn-sm btn-success">send again</a>
                                        <?php
                                    } ?>

                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <th scope="row" colspan="5"><span>You haven't created mails yet.</span>
                        <span><a href="<?php echo APP_ROOT . 'backend/designs/newDesign';?>" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Design
            </a></span>
                            </th>

                        </tr>
                        <?php

                    }

                    ?>

                    </tbody>
                </table>

                <?php
            }else{
                ?>
                <div class="alert alert-info">
                    <strong>Info</strong> You have no designs. Please <strong><a href="<?php echo APP_ROOT . 'backend/designs/newDesign';?>">create</a></strong> a new design!
                </div>
            <?php

            }
            ?>




        </div>

    </div>

    <!-- /.container -->

</div>