<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
            <a href="myevents/newEvent" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Event
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_dashboard">
        <h3>Dashboard</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <?php if ($data['events'] == "noevents"){
        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-info">
                <strong>Info</strong> You don't have any events. Please <strong><a href="myevents/newEvent">create</a></strong> a new event!
            </div>
        </div>

    <?php
    }else{

    }?>
    <div class="dashboard_row">
        <?php
        $running_events = array();
        $upcomming_events = array();

        foreach ( $data['events'] as $event ){
            if($event['dashboard'] == "running"){
                array_push($running_events, $event);
            }else{
                array_push($upcomming_events, $event);
            }
        }

        $count_running_events = count($running_events);
        $count_upcomming_events = count($upcomming_events);

        ?>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashboard_events">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ds_events ds_running_events">
                <div class="ds_header">
                    <i class="glyphicon glyphicon-play-circle"></i>
                    <h4>Running events (<?php echo $count_running_events; ?>)</h4>
                </div>
                <?php
                $e = 1;
                foreach ($running_events as $event){
                    if($e === 1){
                        ?>
                        <div class="dashboard_event">
                            <a class="event_link event_link_stat event_active" href="#" data-id="<?php echo $event['id']; ?>"><?php echo $event['title']; ?> </a><span class="text-info"><?php echo $event['counts']['TOTAL']; ?> <i class="glyphicon glyphicon-user"></i></span>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="dashboard_event">
                            <a class="event_link event_link_stat" href="#" data-id="<?php echo $event['id']; ?>"><?php echo $event['title']; ?> </a><span class="text-info"><?php echo $event['counts']['TOTAL']; ?> <i class="glyphicon glyphicon-user"></i></span>
                        </div>
                        <?php
                    }

                    $e++;
                }
                ?>
                <div class="statistic_button_footer visible-xs">
                    <p class="click_info_text">Click on an event and view its statistic:</p>
                    <a href="#statistics" data-spy="scroll" class="btn btn-default btn-lg btn-back btn-self page-scroll">
                        go to statistic
                    </a>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ds_events ds_upcomming_events">
                <div class="ds_header">
                    <i class="glyphicon glyphicon-repeat"></i>
                    <h4>Upcomming events (<?php echo $count_upcomming_events; ?>)</h4>
                </div>
                <?php
                foreach ($upcomming_events as $event){
                    ?>
                    <div class="dashboard_event">
                        <a class="event_link" href="#" data-id="<?php echo $event['id']; ?>"><?php echo $event['title']; ?> </a><span class="text-info"><?php echo $event['counts']['TOTAL']; ?> <i class="glyphicon glyphicon-user"></i></span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 dashboard_statistics" id="statistics">
        <?php
            $i = 0;
            foreach ($data['events'] as $event){
                    if(in_array($event, $upcomming_events)){
                        continue;
                    }
                    $id = $event['id'];

                    if($i === 0){
                        // First element to show:

                        echo "<div class=\"statistic_event statistic_event_active\" data-id='$id'>";
                    }else{
                        echo "<div class=\"statistic_event statistic_event_hide\" data-id='$id'>";
                    }

                ?>
                    <div class="col-lg-12 statistic_header">
                        <h4>Statistic overview</h4>
                        <span>Event: <?php echo $event['title']; ?></span>
                        <span class="start_of_event">Start of event: <span class="text-info"><?php echo $event['date_from']; ?></span></span>
                        <hr>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 statistic_growth chart_area">
                        <h5>Participation, canceled and persons without any action:</h5>

                        <?php
                        if($event['counts']['TOTAL'] == "NULL"){
                            ?>

                                <div class="alert alert-info">
                                    <strong>Info</strong> There are no users to show!
                                </div>

                        <?php
                        }else{
                            ?>
                            <canvas class="chart" data-accepted="<?php echo $event['actions']['accepted']; ?>" data-canceled="<?php echo $event['actions']['canceled']; ?>" data-noaction="<?php echo $event['actions']['noaction']; ?>"></canvas>
                            <script src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC ?>js/chart.js"></script>
                        <?
                        }

                        ?>


                        <div class="statistic_button_footer">
                            <a href="myevents/edit/<?php echo $event['id']; ?>" class="btn btn-default btn-lg btn-back btn-self">
                                go to event
                            </a>
                        </div>

                        <hr>
                    </div>

                    <div class="col-lg-12 statistic_boxes clearfix">
                        <h5>Mailing view-rates:</h5>
                        <?php
                            if($event['std_sent'] == "1"){
                                $count_sent = intval($event['counts']['std_sent']);
                                $count_viewed = intval($event['counts']['std_viewed']);

                                if($count_viewed != 0){
                                    $output = ($count_viewed / $count_sent) * 100;
                                }else{
                                    $output = 0;
                                }

                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="statistic-box">
                                        <p>Save the date</p>
                                        <p><?echo $output;?> %</p>
                                    </div>

                                </div>
                                <?php



                            }
                            if($event['invitation_sent'] == "1"){
                                $count_sent = intval($event['counts']['invitation_sent']);
                                $count_viewed = intval($event['counts']['invitation_viewed']);

                                if($count_viewed != 0){
                                    $output = ($count_viewed / $count_sent) * 100;
                                }else{
                                    $output = 0;
                                }

                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="statistic-box">
                                        <p>Invitation</p>
                                        <p><?echo $output;?> %</p>
                                    </div>

                                </div>
                                <?php



                            }
                        if($event['reminder_sent'] == "1"){
                            $count_sent = intval($event['counts']['reminder_sent']);
                            $count_viewed = intval($event['counts']['reminder_viewed']);

                            if($count_viewed != 0){
                                $output = ($count_viewed / $count_sent) * 100;
                            }else{
                                $output = 0;
                            }

                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="statistic-box">
                                    <p>Reminder</p>
                                    <p><?echo $output;?> %</p>
                                </div>

                            </div>
                            <?php



                        }
                        if($event['info_sent'] == "1"){
                            $count_sent = intval($event['counts']['info_sent']);
                            $count_viewed = intval($event['counts']['info_viewed']);

                            if($count_viewed != 0){
                                $output = ($count_viewed / $count_sent) * 100;
                            }else{
                                $output = 0;
                            }

                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="statistic-box">
                                    <p>Information</p>
                                    <p><?echo $output;?> %</p>
                                </div>

                            </div>
                            <?php



                        }
                        if($event['ty_sent'] == "1"){
                            $count_sent = intval($event['counts']['ty_sent']);
                            $count_viewed = intval($event['counts']['ty_viewed']);

                            if($count_viewed != 0){
                                $output = ($count_viewed / $count_sent) * 100;
                            }else{
                                $output = 0;
                            }

                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="statistic-box">
                                    <p>Thank you</p>
                                    <p><?echo $output;?> %</p>
                                </div>

                            </div>
                            <?php



                        }
                        ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 hr_line">
                            <hr>
                        </div>

                    </div>

                    <div class="col-lg-12 statistic_participants">
                        <h5>Sent Mails:</h5>

                        <?php
                        if($event['std_sent'] == "1"){
                                $count_sent = intval($event['counts']['std_sent']);
                                $total = intval($event['counts']['TOTAL']);

                                $result = ($count_sent / $total) * 100;

                        ?>
                        <div class="col-lg-12">
                            <div class="statistic_bar">
                                <p>Save the date:</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_sent; ?>"
                                         aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $result; ?>%">
                                        <span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                                <span class="text-info"><?php echo $count_sent; ?> of <?php echo $total; ?></span>
                            </div>
                        </div>



                        <?php
                        }
                        ?>

                        <?php
                        if($event['invitation_sent'] == "1"){
                            $count_sent = intval($event['counts']['invitation_sent']);
                            $total = intval($event['counts']['TOTAL']);

                            $result = ($count_sent / $total) * 100;

                            ?>
                            <div class="col-lg-12">
                                <div class="statistic_bar">
                                    <p>Invitation:</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_sent; ?>"
                                             aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $result; ?>%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <span class="text-info"><?php echo $count_sent; ?> of <?php echo $total; ?></span>
                                </div>
                            </div>



                            <?php
                        }
                        ?>



                        <?php
                        if($event['reminder_sent'] == "1"){
                            $count_sent = intval($event['counts']['reminder_sent']);
                            $total = intval($event['counts']['TOTAL']);

                            $result = ($count_sent / $total) * 100;

                            ?>
                            <div class="col-lg-12">
                                <div class="statistic_bar">
                                    <p>Reminder:</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_sent; ?>"
                                             aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $result; ?>%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <span class="text-info"><?php echo $count_sent; ?> of <?php echo $total; ?></span>
                                </div>
                            </div>



                            <?php
                        }
                        ?>

                        <?php
                        if($event['info_sent'] == "1"){
                            $count_sent = intval($event['counts']['info_sent']);
                            $total = intval($event['counts']['TOTAL']);

                            $result = ($count_sent / $total) * 100;

                            ?>
                            <div class="col-lg-12">
                                <div class="statistic_bar">
                                    <p>Information:</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_sent; ?>"
                                             aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $result; ?>%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <span class="text-info"><?php echo $count_sent; ?> of <?php echo $total; ?></span>
                                </div>
                            </div>



                            <?php
                        }
                        ?>

                        <?php
                        if($event['ty_sent'] == "1"){
                            $count_sent = intval($event['counts']['ty_sent']);
                            $total = intval($event['counts']['TOTAL']);

                            $result = ($count_sent / $total) * 100;

                            ?>
                            <div class="col-lg-12">
                                <div class="statistic_bar">
                                    <p>Thank you:</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count_sent; ?>"
                                             aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $result; ?>%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <span class="text-info"><?php echo $count_sent; ?> of <?php echo $total; ?></span>
                                </div>
                            </div>



                            <?php
                        }
                        ?>
                        <div class="statistic_button_footer">
                            <a href="myevents/edit/<?php echo $event['id']; ?>" class="btn btn-default btn-lg btn-back btn-self">
                                go to event
                            </a>
                        </div>

                    </div>

                </div>

                <?php

                $i++;
            }
        ?>
        </div>
    </div>

    <!-- /.container -->

</div>
<!-- /.banner -->