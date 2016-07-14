<div class="wrapper clearfix">

    <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>

    <div class="col-lg-12 page_header spec_event">
        <h3>Create new event</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 create_event my_container clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <form action="" role="form" method="post">
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="eventtitle">Eventtitle</label>
                        <input class="form-control" name="eventtitle" type="text" id="eventtitle" placeholder="Your event title...">
                        <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="enterprisename">Enterprise name</label>
                        <input class="form-control" type="text" name="enterprisename" id="enterprisename" placeholder="Your enterprise name...">
                        <i class="glyphicon glyphicon-home form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="eventtype">Eventtype</label>
                        <input class="form-control" type="text" name="eventtype" id="eventtype" placeholder="What type of event is this?">
                        <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                    </div>
                    <input type="hidden" name="date_from" id="date_from" value="11/03/2012 12:00 PM">
                    <input type="hidden" name="date_to" id="date_to" value="12/03/2012 12:00 PM">
                    <input type="submit" class="btn btn-lg btn-block spec spec_dashboard visible-lg visible-md" value="Create">

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 date_area">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  spec_event date_area_from active">
                    <h4>from:</h4>
                    <p class="year">2016</p>
                    <p class="day">Thu,</p>
                    <p class="monthandday"><span class="month">Apr</span><span class="day_num"> 13</span> <span class="time">(04 p.m.)</span></p>
                    <span class="hover_date_area hover_date_from">Click to select</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 spec_event_low date_area_to">
                    <h4>to:</h4>
                    <p class="year">2016</p>
                    <p class="day">Thu,</p>
                    <p class="monthandday"><span class="month">Apr</span><span class="day_num"> 13</span> <span class="time">(04 p.m.)</span></p>
                    <span class="hover_date_area hover_date_to">Click to select</span>
                </div>


            </div>

            <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 datepicker_area">
                <div style="overflow:hidden;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div id="datetimepicker_from" data-date="12/03/2012 12:00 PM"></div>

                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div id="datetimepicker_to" data-date="12/03/2012 12:00 PM"></div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="submit" name="createEvent" class="btn btn-lg btn-block spec spec_dashboard visible-sm visible-xs" value="Create">
            </div>
            </form>
        </div>




        <!-- /.container -->

    </div>

    <!-- /.container -->

</div>