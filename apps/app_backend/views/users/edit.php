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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="<?php echo $data['event_id'];?>/new_user" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new User
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3><?php echo "Users of ". $data['event_name']['title'];?></h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_users">

            <ul class="list">
                <li>
                    <a href="#">All user</a>
                </li>

                <li>
                    <a href="#about">Commited</a>
                </li>

                <li>
                    <a href="#services">Cancelled</a>
                </li>

                <li>
                    <a href="#contact">No feedback</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">

            <table class="table table-inverse table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
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

                                <td><?php echo $user['email'];?></td>
                                <td><a href="<?php echo $data['event_id'];?>/edit_user/<?php echo $user['id'];?>">go</a></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>

                        <tr>

                            <td colspan="4">No users found - <a href="<?php echo $data['event_id'];?>/new_user">Create new user</a></td>

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