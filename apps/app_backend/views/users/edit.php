<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
            $url_back = htmlspecialchars($_SERVER['HTTP_REFERER']);

                $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
                $url = explode("/", $url);

            ?>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="<?php echo APP_ROOT . 'backend/users/edit/' . $data['event_id'] . '/new_user';?>" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new User
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3><?php echo "Users of ". $data['event_name']['title'];?></h3>
        <span class="page_quader"></span>
        <form action="" method="post">
            <div class="search_field">
                <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 form-group has-feedback has-feedback-left">
                    <label class="control-label invisible" for="search">Search:</label>
                    <input class="form-control" name="search" type="text" id="search" placeholder="The user name..">
                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
                <div class=" col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group has-feedback has-feedback-left">
                    <input type="submit" name="search_event" class="btn btn-block spec_event" id="search_submit" value="go">
                </div>
            </div>

        </form>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_users">

            <ul class="list">
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/edit/' . $event_id . '/all'; ?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "all"){echo "active";}?>">All user</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/edit/' . $event_id . '/accepted'; ?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "accepted"){echo "active";}?>">Accepted</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/edit/' . $event_id . '/cancelled'; ?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "cancelled"){echo "active";}?>">Cancelled</a>
                </li>

                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users/edit/' . $event_id . '/noaction'; ?>" class="<?php if(isset($data['link_active']) && $data['link_active'] == "noaction"){echo "active";}?>">No action</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">

            <table class="table table-inverse table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th class="visible-md visible-lg visible-sm">Email</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>

                <?php

                    if(!empty($data['users']) && isset($data['users'])){
                        foreach ($data['users'] as $user){
                            ?>

                            <tr>

                                <td><?php echo $user['firstname'];?></td>
                                <td><?php echo $user['lastname'];?></td>

                                <td class="visible-md visible-lg visible-sm"><?php echo $user['email'];?></td>
                                <td><a href="<?php echo APP_ROOT . 'backend/users/edit/' . $data['event_id'] . '/edit_user/' . $user['id'];?>" class="btn btn-sm spec_event">view</a><a href="<?php echo $data['event_id'];?>/delete_user/<?php echo $user['id'];?> " class="btn btn-sm spec_event user_delete" data-id="<?php echo $user['id'];?>" data-event-id="<?php echo $event_id;?>" >delete <i class='fa fa-spinner fa-spin'></i></a></td>

                            </tr>
                            <?php
                        }
                    }else{
                        ?>

                        <tr>

                            <td colspan="4">No users found - <a href="<?php echo APP_ROOT . 'backend/users/edit/' . $data['event_id'] . '/new_user';?>">Create new user</a></td>

                        </tr>
                <?php
                    }

                ?>



                </tbody>
            </table>






        </div>

    </div>

    <!-- /.container -->

</div>