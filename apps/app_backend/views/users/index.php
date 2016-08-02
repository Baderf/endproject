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


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3>Users</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <!-- jQuery -->

    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 left_filter_area spec_users">

            <ul class="list">
                <li>
                    <a href="#">All events</a>
                </li>

                <li>
                    <a href="#about">Events in progress</a>
                </li>

                <li>
                    <a href="#services">Events Completed</a>
                </li>

                <li>
                    <a href="#contact">Latest created</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 my_formulars_list">
            <div class="col-lg-12 col-md-12 col-sm-12 my_formulars">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Eventname</th>
                        <th>Created at</th>
                        <th>Count users</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Finance Meeting</td>
                        <td>12.02.2016</td>
                        <td><strong>99</strong></td>
                        <td>
                            <a href="users/edit/1">go to users</a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- /.container -->

</div>