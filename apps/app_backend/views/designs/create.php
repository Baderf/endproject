<div class="wrapper clearfix">

    <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>

    <div class="col-lg-12 page_header spec_design">
        <h3>Create new design</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 create_event my_container clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <form action="" role="form" method="post">
                    <input type="hidden" id="user" value="<?php echo sessions::get("userid"); ?>">
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="mailtitle">Mailname</label>
                        <input class="form-control" name="mailtitle" type="text" id="mailtitle" placeholder="Your event title...">
                        <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="enterprisename">Enterprise name</label>
                        <input class="form-control" type="text" name="enterprisename" id="enterprisename" placeholder="Your enterprise name...">
                        <i class="glyphicon glyphicon-home form-control-feedback"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="mailtype">Link an event:</label>
                        <select class="form-control selection_user" name="event_selection" id="select_event">
                            <option value="default">Please choose...</option>
                            <?php
                            if(isset($data['events'])){
                                foreach ($data['events'] as $event){
                                    echo "<option value='$event[id]'>$event[title]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="mailtype">Mailtype</label>
                        <select class="form-control selection_user" name="type_selection" id="select_type">
                            <option value="savethedate">Save the date</option>
                            <option value="invitation">Invitation</option>
                            <option value="reminder">Reminder</option>
                            <option value="information">Information</option>
                            <option value="thankyou">Thank you</option>
                        </select>
                    </div>

                    <input type="submit" name="createDesign" class="btn btn-lg btn-block spec spec_dashboard visible-lg visible-md" value="Create">

            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 info_area">
                <div style="overflow:hidden;">
                    <p>Loremkaopsdaksopdasokpd dkopasakopdakosp opa sdopks aos daopk aapsodk opsdka dopsak aopsdk adops adoskp ads kopads opasdopk asdopk ads opkads kopasd kop</p>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="submit" name="createDesign" class="btn btn-lg btn-block spec spec_dashboard visible-sm visible-xs" value="Create">
            </div>
            </form>
        </div>




        <!-- /.container -->

    </div>

    <!-- /.container -->

</div>