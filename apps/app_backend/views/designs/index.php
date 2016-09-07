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
                    <a href="#">All mails</a>
                </li>

                <li>
                    <a href="#about">In progress</a>
                </li>

                <li>
                    <a href="#services">Already sent</a>
                </li>

                <li>
                    <a href="#contact">Latest updated</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">

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
                <tbody>

                <?php

                if(isset($data['mails']) && !empty($data['mails'])){
                    foreach ($data['mails'] as $mail){
                ?>

                        <tr>
                            <th scope="row"><?php echo $mail['title'];?></th>
                            <td class="mail_type"><?php echo $mail['mail_type'];?></td>
                            <td><?php echo $mail['event_title'];?></td>
                            <td><?php
                                    if($mail['already_sent'] == "1"){
                                        echo "already sent";
                                    }else{
                                        echo "in progress";
                                    }
                                ?></td>
                            <td>

                                <?php if($mail['already_sent'] != "1"){
                                  ?>
                                    <a href="designs/edit/<?php echo $mail['id'];?>" class="btn btn-sm btn-info">edit</a>
                                    <a href="designs/send/<?php echo $mail['id'];?>" class="btn btn-sm btn-success">send</a>
                            <?php
                                }else{
                                    ?>
                                    <a href="designs/view/<?php echo $mail['id'];?>" class="btn btn-sm btn-info">view</a>
                                    <a href="myevents/send/<?php echo $mail['id'];?>" class="btn btn-sm btn-success">send again</a>
                            <?php
                                }?>

                            </td>
                        </tr>

                <?php
                    }
                }else{
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






        </div>

    </div>

    <!-- /.container -->

</div>