<?php
    $running_events = array();
    $upcomming_events = array();

    var_dump($data['events']);

    foreach ( $data_events as $event ){
        if($event['dashboard'] == "running"){
            array_push($running_events, $event);
        }else{
            array_push($upcomming_events, $event);
        }
    }

    $count_running_events = count($running_events);
    $count_upcomming_events = count($upcomming_events);

    echo $count_running_events;
?>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashboard_events">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ds_events ds_running_events">
        <div class="ds_header">
            <i class="glyphicon glyphicon-play-circle"></i>
            <h4><?php echo $count_running_events; ?> Running events</h4>
        </div>
        <?php
        foreach ($running_events as $event){
            ?>
            <div class="dashboard_event">
                <a class="event_link" href="#"><?php echo $event['title']; ?> </a><span class="text-info">33 <i class="glyphicon glyphicon-user"></i></span>
            </div>
        <?php
        }
        ?>

        <div class="dashboard_event">
            <a class="event_link" href="#">Project Finance Meeting </a><span class="text-info">33 <i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="dashboard_event">
            <a class="event_link" href="#">Project Finance Meeting </a><span class="text-info">33 <i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="dashboard_event">
            <a class="event_link" href="#">Project Finance Meeting </a><span class="text-info">33 <i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="dashboard_event">
            <a class="event_link event_active" href="#">Project Finance Meeting </a><span class="text-info">33 <i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="statistic_button_footer visible-xs">
            <p class="click_info_text">Click on an event and view its statistic:</p>
            <a href="#statistics" class="btn btn-default btn-lg btn-back btn-self page-scroll">
                go to statistic
            </a>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ds_events ds_upcomming_events">
        <div class="ds_header">
            <i class="glyphicon glyphicon-repeat"></i>
            <h4><?php echo $count_upcomming_events; ?> Upcomming events</h4>
        </div>
        <div class="dashboard_event">
            <a  class="event_link" href="#">Project Finance Meeting </a><span class="text-info event_date">27/10/2016</span>
        </div>
        <div class="dashboard_event">
            <a  class="event_link" href="#">Project Finance Meeting </a><span class="text-info event_date">27/10/2016</span>
        </div>
        <div class="dashboard_event">
            <a class="event_link" href="#">Project Finance Meeting </a><span class="text-info event_date">27/10/2016</span>
        </div>
        <div class="dashboard_event">
            <a class="event_link" href="#">Project Finance Meeting </a><span class="text-info event_date">27/10/2016</span>
        </div>
    </div>
</div>