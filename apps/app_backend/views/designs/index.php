<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="designs/newDesign" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Design
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_design">
        <h3>My Designs</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_design">

            <ul class="list">
                <li>
                    <a href="#" class="list_filter" data-type="designs/index" data-item="item" data-insert="table_mails_body" data-action="all">All mails</a>
                </li>

                <li>
                    <a href="#about" class="list_filter" data-type="designs/index" data-item="item" data-insert="table_mails_body" data-action="progress">In progress</a>
                </li>

                <li>
                    <a href="#services" class="list_filter" data-type="designs/index" data-item="item" data-insert="table_mails_body" data-action="alreadysent">Already sent</a>
                </li>

                <li>
                    <a href="#contact" class="list_filter" data-type="designs/index" data-item="item" data-insert="table_mails_body" data-action="latest">Latest updated</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 area_loading_spinner"><p class="loading_text"><i class='fa fa-spinner fa-spin'></i></p></div>

            <?php

            if(isset($data['mails']) && !empty($data['mails'])) {

                ?>

                <table class="table table-inverse table-striped table_mails">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Eventname</th>
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
                                <td class="mail_type"><?php echo $mail['mail_type']; ?></td>
                                <td><?php echo $mail['event_title']; ?></td>
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
                                        <a href="designs/edit/<?php echo $mail['id']; ?>" class="btn btn-sm btn-info">edit</a>
                                        <a href="<?php echo APP_ROOT . 'backend/myevents/send/' . $mail['id']; ?>"
                                           class="btn btn-sm btn-success">send</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="designs/view/<?php echo $mail['id']; ?>" class="btn btn-sm btn-info">view</a>
                                        <a href="myevents/send/<?php echo $mail['id']; ?>"
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
                        <span><a href="designs/newDesign" class="btn btn-default btn-lg btn-back btn-self">
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
                    <strong>Info</strong> You have no designs. Please <strong><a href="designs/newDesign">create</a></strong> a new design!
                </div>
            <?php

            }
            ?>




        </div>

    </div>

    <!-- /.container -->

</div>