<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
            $url_back = htmlspecialchars($_SERVER['HTTP_REFERER']);
            ?>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>


    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3>Users</h3>
        <span class="page_quader"></span>
        <form action="" method="post">
        <div class="search_field">
            <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 col-xs-8 form-group has-feedback has-feedback-left">
                <label class="control-label invisible" for="search">Search:</label>
                <input class="form-control" name="search" type="text" id="search" placeholder="The event title..">
                <i class="glyphicon glyphicon-search form-control-feedback"></i>
            </div>
            <div class=" col-lg-4 col-md-4 col-xs-4 col-sm-4 col-xs-4 form-group has-feedback has-feedback-left">
                <input type="submit" name="search_event" class="btn btn-block spec_event" id="search_submit" value="go">
            </div>
        </div>

        </form>
    </div>

    <?php
    $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
    $url = explode("/", $url);
    ?>



    <!-- /.content-section-a -->

    <!-- jQuery -->

    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_users">

            <ul class="list">
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/all'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "all"){echo "active";}?>">All events</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/progress'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "progress"){echo "active";}?>">Events in progress</a>

                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/completed'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "completed"){echo "active";}?>">Completed events</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/latest'?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "latest"){echo "active";}?>">Latest created</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_formulars_list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my_formulars">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Eventname</th>
                        <th class="visible-lg visible-md visible-sm">Created at</th>
                        <th>Count users</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        if(isset($data['events']) && !empty($data['events']) && $data['events'] != "false"){

                            foreach ($data['events'] as $event){?>
                            <tr>
                                <td><?php echo $event['title'];?></td>
                                <td class="visible-lg visible-md visible-sm"><?php echo $event['created_at'];?></td>
                                <td><strong><?php echo $event['count'];?></strong></td>
                                <td>
                                    <a href="<?php echo APP_ROOT . 'backend/users/edit/' . $event['id'];?>">go to users</a>
                                </td>
                            </tr>
                    <?php
                            }
                        }elseif($data['events'] == "false"){
                            ?>
                            <tr>
                                <td colspan="4">Ups! No events were found. Please try again!</td>

                            </tr>
                    <?php
                        }else{
                            ?>
                            <tr>
                                <td colspan="4">No events created - Please <a href="myevents/newEvent">create</a> an event!</td>

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
