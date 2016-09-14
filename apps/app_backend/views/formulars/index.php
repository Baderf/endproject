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
                    Here you can find all your <strong>formulars</strong> ...
                </div>
                <div class="step step2" data-step="2">
                    You can filter them on the left side...
                </div>
                <div class="step step3" data-step="3">

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
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="formulars/newFormular" class="btn btn-default btn-lg btn-back btn-self spec_event">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Formular
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_formular">
        <h3>My Formulars</h3>
        <span class="page_quader"></span>
        <form action="" method="post">
            <div class="search_field">
                <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 col-xs-8 form-group has-feedback has-feedback-left">
                    <label class="control-label invisible" for="search">Search:</label>
                    <input class="form-control" name="search" type="text" id="search" placeholder="The formular title..">
                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
                <div class=" col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xs-4 form-group has-feedback has-feedback-left">
                    <input type="submit" name="search_event" class="btn btn-block spec_dashboard" id="search_submit" value="go">
                </div>
            </div>

        </form>
    </div>


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_formular">

            <ul class="list">
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/formulars/all'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "all"){echo "active";}?>">All formulars</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/formulars/userfields'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "userfields"){echo "active";}?>">With specified fields</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/formulars/nouserfields'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "nouserfields"){echo "active";}?>">Without specified fields</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/formulars/latest'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "latest"){echo "active";}?>">Latest created</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_formulars_list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my_formulars">
                <h4>All formulars</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Formular name</th>
                        <th class="visible-lg visible-md visible-sm">Created at</th>
                        <th class="visible-lg visible-md visible-sm">Updated at</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        if($data['formulars'] != "none"){
                            foreach ($data['formulars'] as $formular){
                                ?>
                                <tr>
                                    <td><?php
                                    echo $formular['title'];
                                        ?></td>
                                    <td class="visible-lg visible-md visible-sm"><?php
                                        echo $formular['created_at'];
                                        ?></td>
                                    <td class="visible-lg visible-md visible-sm"><?php
                                        echo $formular['updated_at'];
                                        ?></td>
                                    <td>
                                        <a href="<?php echo APP_ROOT . $url[0] . '/formulars/delete/' . $formular['id'];?>" class="btn btn-sm btn-warning">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <a href="<?php echo APP_ROOT . $url[0] . '/formulars/edit/' . $formular['id'];?>" class="btn btn-sm btn-info">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                </tr>
                    <?php

                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="4">You don't have any formulars - <a href="<?php echo APP_ROOT . $url[0] . '/formulars/newFormular'?>">Create new formular!</a></td>
                            </tr>
                    <?php

                        }
                    ?>



                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- /.container -->

</div>
