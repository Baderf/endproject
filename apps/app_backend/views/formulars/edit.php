<div class="wrapper clearfix">

    <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>

    <div class="col-lg-12 page_header spec_formular">
        <h3>Edit formular: </h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 edit_formular my_container clearfix">


        <div class="tabbable" id="tabs-357165">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#panel-719455" data-toggle="tab">Overview</a>
                </li>
                <li>
                    <a href="#panel-820482" data-toggle="tab">Standard fields</a>
                </li>
                <li>
                    <a href="#panel-820473" data-toggle="tab">Userspecified fields</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="panel-719455">
                    <div class="row">
                        <form action="" role="form" method="post">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <h4>Formular overview</h4>
                            <hr>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtitle">Formtitle</label>
                                    <input class="form-control" name="formtitle" type="text" id="formtitle" placeholder="Your formular title...">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="formtitle">Description</label>
                                    <textarea class="form-control" name="formdescription" rows="3" placeholder="Your description goes here..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="formaction">What should the user get after positive type in?</label>
                                    <select class="form-control" name="formaction" id="formaction">
                                        <option value="choose" selected>Please choose</option>
                                        <option value="url">User gets to a external url</option>
                                        <option value="confirmation_mail">Confirmation mail will be sent</option>
                                        <option value="feedback">Direct feedback in browser</option>
                                    </select>
                                </div>
                                <div class="form-group chosen_fields">
                                    <div class="form-group not_active choose_url">
                                        <label class="control-label" for="form_choose_url">Url:</label>
                                        <input class="form-control" name="form_choose_url" type="text" id="form_choose_url" placeholder="Which url?">
                                    </div>
                                    <div class="form-group not_active choose_mail">
                                        <label class="control-label" for="form_choose_mail">Confirmation mail:</label>
                                        <select class="form-control" name="form_choose_mail" id="form_choose_mail">
                                            <option value="id" selected>Mail 1</option>
                                        </select>
                                    </div>
                                    <div class="form-group not_active choose_feedback">
                                        <label class="control-label" for="form_choose_feedback">Direct feedback:</label>
                                        <textarea class="form-control" name="form_choose_feedback" rows="3" placeholder="Your feedback goes here..."></textarea>
                                    </div>
                                </div>


                                <!--
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype"></label>
                                    <select class="form-control" name="formtype" id="formtype" placeholder="The type of the formular...">
                                        <option value="select">Selection</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="radio">One-Selection (Radio)</option>
                                        <option value="forminput">Form-Input</option>
                                    </select>
                                    <i class="glyphicon glyphicon-home form-control-feedback"></i>
                                </div>
                                -->

                                <input type="submit" name="saveOverviewFormular" class="btn btn-lg btn-block spec spec_dashboard visible-lg visible-md" value="Save">

                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 info-box">
                            <h4>Information</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Consectetur corporis culpa deserunt nam nemo officiis rem.
                                Cumque ducimus eaque eligendi fugiat illo, numquam odit quidem quod sint sit,
                                ullam velit.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Consectetur corporis culpa deserunt nam nemo officiis rem.
                                Cumque ducimus eaque eligendi fugiat illo, numquam odit quidem quod sint sit,
                                ullam velit.
                            </p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" name="saveOverviewFormular" class="btn btn-lg btn-block spec spec_dashboard visible-sm visible-xs" value="Save">
                        </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="panel-820482">
                    <div class="row">
                        <form action="" role="form" method="post">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h4>Active fields</h4>
                                <hr>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 active_standard_fields">
                                    <div class="standard_field_active">
                                        <table class="table table-striped activated_standard_fields">
                                            <thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>Type</td>
                                                    <td>Edit</td>
                                                    <td>Position</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr data-row-id="1" class="active_tr">
                                                    <td>Firstname</td>
                                                    <td>Input field</td>
                                                    <td class="td_btn_area">
                                                        <input type="hidden" class="active_field" data-id="1">
                                                        <a href="#" class="btn btn-sm btn-danger remove_tr"> deactivate
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-info arrow_up">
                                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-info arrow_down">
                                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr data-row-id="2" class="active_tr">
                                                    <td>Lastname</td>
                                                    <td>Input field</td>
                                                    <td class="td_btn_area">
                                                        <input type="hidden" class="active_field" data-id="2">
                                                        <a href="#" class="btn btn-sm btn-danger remove_tr"> deactivate
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                     </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-info arrow_up">
                                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-info arrow_down">
                                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr data-row-id="3" class="active_tr">
                                                    <td>Lastname</td>
                                                    <td>Input field</td>
                                                    <td class="td_btn_area">
                                                        <input type="hidden" class="active_field" data-id="3">
                                                        <a href="#" class="btn btn-sm btn-danger remove_tr"> deactivate
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-info arrow_up">
                                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-info arrow_down">
                                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h4>Deactivated fields</h4>
                                <hr>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 deactive_standard_fields">
                                    <div class="deactivated_standard_fields">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <td>Name</td>
                                                <td>Type</td>
                                                <td>Edit</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-row-id="8" class="deactive_tr">
                                                <td>Firstname</td>
                                                <td>Input field</td>
                                                <td class="td_btn_area">
                                                    <input type="hidden" class="active_field" data-id="8">
                                                    <a href="#" class="btn btn-sm btn-success remove_tr"> activate
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                     </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info arrow_up">
                                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-info arrow_down">
                                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr data-row-id="10" class="deactive_tr">
                                                <td>Lastname</td>
                                                <td>Input field</td>
                                                <td class="td_btn_area">
                                                    <input type="hidden" class="active_field" data-id="10">
                                                    <a href="#" class="btn btn-sm btn-success remove_tr">activate
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info arrow_up">
                                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-info arrow_down">
                                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="hidden" name="active_standard_fields" class="active_standard_fields_row" value=":0:">
                                <input type="hidden" name="deactive_standard_fields" class="deactive_standard_fields_row" value=":1:">
                                <input type="submit" name="saveStandardFieldsFormular" class="btn btn-lg btn-block spec spec_dashboard" value="Save">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="panel-820473">
                    <div class="row">


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

    <!-- /.container -->

</div>