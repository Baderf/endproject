<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="myevents/newEvent" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Event
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_event">
        <h3>My Events</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_event">

            <ul class="list">
                <li>
                    <a href="#" class="list_filter active" data-type="myevents/index" data-item="my_events_event" data-insert="my_events_list" data-action="all">All events</a>
                </li>

                <li>
                    <a href="#about" class="list_filter" data-type="myevents/index" data-item="my_events_event" data-insert="my_events_list" data-action="progress">In progress</a>
                </li>

                <li>
                    <a href="#services" class="list_filter" data-type="myevents/index" data-item="my_events_event" data-insert="my_events_list" data-action="completed">Completed</a>
                </li>

                <li>
                    <a href="#contact" class="list_filter" data-type="myevents/index" data-item="my_events_event" data-insert="my_events_list" data-action="latest">Latest created</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 area_loading_spinner"><p class="loading_text"><i class='fa fa-spinner fa-spin'></i></p></div>
            <?php if($data['events']){


                $rules = [
                    "std_" => "Save the date",
                    "invitation_" => "Invitation",
                    "reminder_" => "Reminder",
                    "info_" => "Information",
                    "ty_" => "Thank you",
                ];
                $positions = [
                    "Save the date" => "std_sent",
                    "Invitation" => "invitation_sent",
                    "Reminder" => "reminder_sent",
                    "Information" => "info_sent",
                    "Thank you" => "ty_sent",
                ];

                foreach($data['events'] as $event){

                    if($event['image'] === "standard"){
                        $image = APP_ROOT . 'apps/app_backend/' . APP_PUBLIC . 'media/standard.jpg';
                    }else{
                        $image = APP_ROOT . $event['image'];
                    }



                    $today = time();
                    $event_time = strtotime($event['date_to']);

                    if($event_time >= $today){
                        $progress = "In progress";
                    }else{
                        $progress = "Completed";
                    }

                    $tasks = array();

                    if($event['std_sent'] !== "0"){
                        array_push($tasks, $rules["std_"]);
                    }

                    if($event['invitation_sent'] !== "0"){
                        array_push($tasks, $rules["invitation_"]);
                    }

                    if($event['reminder_sent'] !== "0"){
                        array_push($tasks, $rules["reminder_"]);
                    }

                    if($event['info_sent'] !== "0"){
                        if(count($tasks) >= 3){
                            array_shift($tasks);
                        }
                        array_push($tasks, $rules["info_"]);
                    }

                    if($event['ty_sent'] !== "0"){
                        if(count($tasks) >= 3){
                            array_shift($tasks);
                        }
                        array_push($tasks, $rules["ty_"]);
                    }

                    if(empty($tasks)){
                        $next_step = "Save the Date";
                    }elseif($event['ty_sent'] === "0"){
                        $last_task = end($tasks);
                        $tosearch = array_search($last_task, $rules);


                        $current = $tosearch;
                        $keys = array_keys($rules);
                        $ordinal = (array_search($current,$keys)+1)%count($keys);
                        $next = $keys[$ordinal];
                        $next_step = $rules[$next];
                    }else{
                        $next_step = "Finished!";
                    }





                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my_events_event">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 event_image">
                            <img src="<?php echo $image; ?>" class="my_event_image">
                            <span class="img_text_overlay"><?php echo $progress; ?></span>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 event_title">
                            <h4><?php echo $event['title']; ?></h4>
                            <p>Date created - <span class="text-info"><?php echo $event['created_at']; ?></span></p>
                            <p class="status_info">Start of event - <span class="text-info"><?php echo $event['date_to']; ?></span></p>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 event_info">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 finished_tasks">
                                <h5>Finished Tasks</h5>

                                <?php
                                    if(!empty($tasks)){
                                    ?>
                                        <ul class="list">
                                            <?php



                                        foreach ($tasks as $task){
                                                $search = $positions[$task];
                                            ?>

                                                <li>
                                                    <?php echo $task;?> sent - <span class="text-info"><?php echo $event[$search]; ?></span>
                                                </li>


                                <?php
                                        }
                                        ?>
                                        </ul>
                                            <?php

                                    }else{
                                        ?>

                                        <span class="text-info">No mails sent jet!</span>

                                        <?php

                                    }
                                ?>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 statistic_infos">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 statistic-box">
                                    <span class="text-info">Open Rate</span>
                                    <span class="sum">33 %</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 statistic-box">
                                    <span class="text-info">Participants</span>
                                    <span class="sum">33 %</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 statistic-box">
                                    <span class="text-info">next step</span>

                                    <?php
                                        if($next_step != "Finished!"){
                                        ?>
                                            <p class="next-step"><?php echo $next_step; ?></p>
                                            <a href="<?php echo APP_ROOT . 'backend/' . 'designs/newDesign';  ?>" class="btn btn-default btn-sm btn-view spec_dashboard">Create</a>
                                            <?php
                                        }else{
                                            ?>
                                            <p class="next-step"><?php echo $next_step; ?></p>
                                            <?php
                                        }
                                    ?>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 event_btns">
                                <div class="col-lg-12 col-xs-12 event_btn">
                                    <a href="myevents/delete/<?php echo $event['id']; ?>" class="btn btn-block btn-default delete_event" data-event-id = "<?php echo $event['id']; ?>" data-user-id = "<?php echo sessions::get("userid"); ?>">delete <i class='fa fa-spinner fa-spin'></i></a>
                                </div>
                                <div class="col-lg-12 col-xs-12 event_btn">
                                    <a href="myevents/edit/<?php echo $event['id']; ?>" class="btn btn-block btn-default spec_event_low">edit</a>
                                </div>
                            </div>

                        </div>


                    </div>
            <?php
                }

            }elseif(!$data['events']){
                ?>
                <div class="alert alert-info">
                    <strong>Info</strong> You no events. Please <strong><a href="myevents/newEvent">create</a></strong> a new event!
                </div>
            <?php
            }?>





        </div>

    </div>

    <!-- /.container -->

</div>