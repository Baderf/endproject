<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">
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

    <div class="dashboard_row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashboard_events">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ds_events ds_running_events">
                <div class="ds_header">
                    <i class="glyphicon glyphicon-play-circle"></i>
                    <h4>5 Running events</h4>
                </div>


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
                    <h4>5 Upcomming events</h4>
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

        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 dashboard_statistics" id="statistics">
            <div class="col-lg-12 statistic_header">
                <h4>Statistic overview<span class="text-info"> - Today</span></h4>
                <span>Event: Project Finance Meeting</span>
                <span class="start_of_event">Start of event: <span class="text-info">21 June 2016</span></span>
                <hr>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 statistic_growth">
                <h5>Growth</h5>
                <canvas id="myChart" width="100" height="300"></canvas>
                <script src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC ?>js/chart.js"></script>
                <script>
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            fullWidth: true,
                            maintainAspectRatio: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                </script>
                <div class="statistic_button_footer">
                    <a href="#" class="btn btn-default btn-lg btn-back btn-self">
                        go to event
                    </a>
                </div>

                <hr>
            </div>

            <div class="col-lg-12 statistic_boxes clearfix">
                <h5>Rates</h5>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="statistic-box">
                        <p>Click Rate</p>
                        <p>27 %</p>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="statistic-box">
                        <p>Click Rate</p>
                        <p>27 %</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="statistic-box">
                        <p>Click Rate</p>
                        <p>27 %</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="statistic-box">
                        <p>Click Rate</p>
                        <p>27 %</p>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 hr_line">
                    <hr>
                </div>

            </div>

            <div class="col-lg-12 statistic_participants">
                <h5>Other statistics</h5>
                <div class="col-lg-12">
                    <div class="statistic_bar">
                        <p>Accepted</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                        <span class="text-info">12 of 200</span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="statistic_bar">
                        <p>Accepted</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:33%">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                        <span class="text-info">12 of 200</span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="statistic_bar">
                        <p>Accepted</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:54%">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                        <span class="text-info">12 of 200</span>
                    </div>
                </div>
                <div class="statistic_button_footer">
                    <a href="#" class="btn btn-default btn-lg btn-back btn-self">
                        go to event
                    </a>
                </div>

            </div>


        </div>
    </div>

    <!-- /.container -->

</div>
<!-- /.banner -->