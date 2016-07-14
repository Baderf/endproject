<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="<?php echo APP_ROOT . $url[0] . '/myevents/newEvent'?>" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Event
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_event">
        <h3>Event: <?php echo $data['event_edit']['title']; ?></h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <div class="event_edit col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="tabbable" id="tabs-357165">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#panel-719455" data-toggle="tab">Overview</a>
                </li>
                <li>
                    <a href="#panel-820482" data-toggle="tab">Settings</a>
                </li>
                <li>
                    <a href="#panel-820473" data-toggle="tab">Formulars</a>
                </li>
                <li>
                    <a href="#panel-820123" data-toggle="tab">Mails</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="panel-719455">
                    <div class="row">
                        <form action="" method="post">
                        <div class="col-xl-6 col-md-6">
                            <h3>Event overview</h3>
                            <p>Here you can edit the event.</p>

                            <div class="event_edit_area">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="eventtitle">Eventtitle:</label>
                                    <input class="form-control" name="eventtitle" type="text" id="eventtitle" placeholder="Your event title..." value="<?php echo $data['event_edit']['title']; ?>">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="eventtype">Eventtype:</label>
                                    <input class="form-control" name="eventtype" type="text" id="eventtype" placeholder="Your event type..." value="<?php if(isset($data['event_edit']['type'])){echo $data['event_edit']['type'];}; ?>">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-md-6">
                            <h4>Start of Event:</h4>

                            <div class="col-lg-8 col-md-8 form-group">
                                <label class="control-label" for="eventdate_to">Date:</label>
                                <div class='input-group date' id='datetimepicker_edit_from'>

                                    <?php
                                    $date = explode(" ", $data['event_edit']['date_from']);
                                    $date_p1 = $date[0];
                                    $date_p2 = $date[1] . " " . $date[2];


                                    $date2 = explode(" ", $data['event_edit']['date_to']);
                                    $date_t1 = $date2[0];
                                    $date_t2 = $date2[1] . " " . $date2[2];


                                    ?>

                                    <input type='text' name="eventdate_from" id="eventdate_from" class="form-control" value="<?php echo $date_p1; ?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 form-group">
                                <label class="control-label" for="eventtime_from">Time:</label>
                                <div class="form-group">
                                    <div class='input-group date' id='timepicker_from'>
                                        <input type='text' name="eventtime_from" class="form-control" value="<?php echo $date_p2; ?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8">



                            </div>
                            


                            <h4>End of Event:</h4>


                            <div class="col-lg-8 col-md-8 form-group">
                                <label class="control-label" for="eventdate_to">Date:</label>
                                <div class='input-group date' id='datetimepicker_edit_to'>

                                    <input type='text' name="eventdate_to" id="eventdate_to" class="form-control" value="<?php echo $date_t1; ?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 form-group">
                                <label class="control-label" for="eventtime_to">Time:</label>
                                <div class="form-group">
                                    <div class='input-group date' id='timepicker_to'>
                                        <input type='text' name="eventtime_to" class="form-control" value="<?php echo $date_t2; ?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                            <input type="submit" name="edit_overview" class="btn btn-lg spec spec_dashboard" value="Save">
                        </div>
                    </div>
                </form>
                </div>
                <div class="tab-pane" id="panel-820482">
                    <div class="row">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-lg-12 col-md-12">
                                <h3>Settings</h3>
                            </div>

                            <div class="col-md-12">
                                <div class="col-lg-4 col-md-4 col-sm-6 form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="event_limit_participates">Limit of Participates:</label>
                                    <input class="form-control" min="0" name="event_limit_participates" type="number" id="event_limit_participates" value="<?php echo $data['event_details']['participants_max']; ?>">
                                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="event_image">Current image:</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <img class="event_edit_image" src="<?php echo APP_ROOT . $data['event_details']['event_image']; ?>" alt="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                        <label class="control-label" for="event_image">Upload new image:</label>
                                        <div class="fileUpload btn spec_event">
                                            <span>Select Image</span>
                                            <input type="file" name="event_image" value="" class="upload" />
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                                <input type="submit" name="edit_settings" class="btn btn-lg spec spec_dashboard" value="Save">
                            </div>



                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="panel-820473">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                            <div class="col-lg-12 col-md-12">
                                <h3>Formulars</h3>
                            </div>

                            <div class="col-lg-4 col-md-4 link_formular">
                                <div class="col-lg-10 col-md-10 form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="event_link_formular">Link a sign-formular to the event:</label>
                                    <select class="form-control" min="0" name="event_link_formular" id="event_link_formular">
                                        <option value="bla">Formular 1</option>
                                        <option value="bla">Formular 2</option>
                                        <option value="bla">Formular 3</option>
                                    </select>
                                </div>
                            </div>

                            </form>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <h4>Linked Formulars</h4>
                              <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Edit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($data['event_formulars']) || empty($data['event_formulars'])){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<p>There are no formulars linked.</p>";
                                    echo "</td>";
                                    echo "<td width='100'></td>";
                                    echo "</tr>";
                                }else{
                                    foreach ($data['event_formulars'] as $formular){
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a href=\"formulars/view/{$formular['id']}\">{$formular['title']}</a>";

                                        echo "</td>";
                                        echo "<td width='100'>";
                                        echo "<a href=\"#\" class=\"btn btn-sm btn-warning\">
                                                <span class=\"glyphicon glyphicon-remove\"></span>
                                            </a>";
                                        echo "<a href=\"#\" class=\"btn btn-sm btn-info\">
                                                <span class=\"glyphicon glyphicon-pencil\"></span>
                                            </a></td>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                            <input type="submit" class="btn btn-lg spec spec_dashboard" value="Save">
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="panel-820123">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="col-lg-12 col-md-12">
                                    <h3>Mails</h3>
                                </div>



                                <div class="col-lg-4 col-md-4 link_formular">
                                    <div class="col-lg-10 col-md-10 form-group has-feedback has-feedback-left">
                                        <label class="control-label" for="event_link_formular">Link a mail to the event:</label>
                                        <select class="form-control" min="0" name="event_link_formular" id="event_link_formular">
                                            <option value="bla">Mail 1</option>
                                            <option value="bla">Mail 2</option>
                                            <option value="bla">Mail 3</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <h4>Linked Mails</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Edit</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#">Mail 1</a></td>
                                    <td width="100"><a href="#" class="btn btn-sm btn-warning">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-info">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                            <input type="submit" class="btn btn-lg spec spec_dashboard" value="Save">
                        </div>
                    </div>
                    </div>

            </div>

            </div>
        </div>
    </div>

    <!-- /.container -->

</div>

