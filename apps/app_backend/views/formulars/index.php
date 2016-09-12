<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="formulars/newFormular" class="btn btn-default btn-lg btn-back btn-self spec_formular">
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


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 left_filter_area spec_formular">

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
        <div class="col-lg-10 col-md-10 col-sm-10 my_formulars_list">
            <div class="col-lg-12 col-md-12 col-sm-12 my_formulars">
                <h4>All formulars</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Formular name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
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
                                    <td><?php
                                        echo $formular['created_at'];
                                        ?></td>
                                    <td><?php
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
