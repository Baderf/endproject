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
                                    <input class="form-control" name="formtitle" type="text" id="formtitle" placeholder="Your formular title..." value="<?php echo $data['formdetails']['title'];  ?>">
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
                                                <?php
                                                if(isset($data['activefields']) && !empty($data['activefields'])){
                                                    foreach ($data['activefields'] as $form){
                                                        ?>
                                                <tr data-row-id="<?php echo $form['id']?>" class="active_tr">
                                                    <td><?php echo $form['fullname'] ?></td>
                                                    <td><?php echo $form['type'] ?></td>
                                                    <td class="td_btn_area">
                                                        <input type="hidden" class="active_field" data-id="<?php echo $form['id']?>">
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
                                                        <?php
                                                    }
                                                }


                                                ?>

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
                                            </thead>                 F
                                            <tbody>                  F

                                            <?php
                                            if(isset($data['deactivefields']) && !empty($data['deactivefields'])){
                                            foreach ($data['deactivefields'] as $form){
                                            ?>
                                            <tr data-row-id="<?php echo $form['id']?>" class="deactive_tr">
                                                <td><?php echo $form['fullname'] ?></td>
                                                <td><?php echo $form['type'] ?></td>
                                                <td class="td_btn_area">
                                                    <input type="hidden" class="active_field" data-id="<?php echo $form['id']?>">
                                                    <a href="#" class="btn btn-sm btn-success remove_tr"> activate
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info arrow_up">
                                                        <span class="glyphicon glyphicon-arrow-up arrow_up"></span>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-info arrow_down">
                                                        <span class="glyphicon glyphicon-arrow-down arrow_down"></span>
                                                    </a>
                                                </td>
                                                <?php
                                                }
                                                }


                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="hidden" name="active_standard_fields" class="active_standard_fields_row" value="<?php echo $data['formdetails']['standard_field_ids']?>">
                                <input type="hidden" name="deactive_standard_fields" class="deactive_standard_fields_row" value="<?php echo $data['formdetails']['deactive_standard_fields']?>">
                                <input type="submit" name="saveStandardFieldsFormular" class="btn btn-lg btn-block spec spec_dashboard" value="Save">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="panel-820473">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Create a new form</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dicta doloremque earum error eum illum, placeat quisquam rem saepe sequi! Facilis nesciunt optio porro quasi quo quos reprehenderit, ut! Explicabo.</p>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <div class="form-group has-feedback has-feedback-left">
                                        <label class="control-label" for="formtitle">Formtitle</label>
                                        <input class="form-control" name="formtitle" type="text" id="formtitle" placeholder="Your formular title...">
                                        <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <div class="form-group">
                                        <label class="control-label" for="form_choose_type">Type:</label>
                                        <select class="form-control form_choose_type" name="formtype" id="formtype" placeholder="The type of the formular...">
                                            <option value="default">Please choose...</option>
                                            <option value="select">Selection</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="radio">Yes/No</option>
                                            <option value="date">Date</option>
                                            <option value="text">Text-Input</option>
                                            <option value="textarea">Notice</option>
                                            <option value="number">Number</option>
                                            <option value="time">Time</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <div class="form-group has-feedback has-feedback-left">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <a href="#" class="btn btn-lg btn-success btn-field-creator" data-next-id="2"> create
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 select_field_area select_field_area_1" data-table-id="1" data-type="selection" data-table-input-id="1" data-user-field-id="1">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form_build_selection" >
                                        <label class="control-label" for="selection_user" id="field_title_1">Defaultvalue:</label>
                                        <select class="form-control selection_user" name="form_selection_1" >
                                            <option value="select" selected>Please choose</option>
                                        </select>
                                    </div>
                                    <div class="hidden_fields">
                                        <input type="hidden" class="hidden_id_input hidden_user_field_id_1" name="user_field_1_id" value="">
                                        <input type="hidden" class="hidden_user_field_type_1" name="user_field_1_type" value="select">
                                        <input type="hidden" class="hidden_user_field_default_1" name="user_field_1_default" value="">
                                        <input type="hidden" class="hidden_user_field_values_1" name="user_field_1_values" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form_build_selection_add">
                                        <label class="control-label" for="selection_user_add">Defaultvalue:</label>
                                        <input class="form-control" name="selection_user_add" type="text" id="selection_user_add" placeholder="Enter another section value...">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    </br>
                                    <a href="#" class="btn btn-sm btn-success btn-selection-field-adder" data-table-id="1"> add
                                                                            </a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 selection_table">
                                   <p>Your possible Selections:</p>
                                    <table class="table table-striped form_field_options" data-table-id="1">
                                        <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Edit</td>
                                        </tr>
                                        </thead>
                                        <tbody class="tbody_id_1">

                                        </tbody>
                                    </table>
                                </div>



                            </div>







                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_templates">




                            <!---

                             CHECKBOX



                             --->



                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 select_field_area" data-type="checkbox" data-table-input-id="#" data-user-field-id="#">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form_build_selection" >
                                        <label class="control-label" for="selection_user" id="field_title_#">Defaultvalue:</label>
                                        <select class="form-control selection_user" name="form_selection_#" >
                                            <option value="select" selected>Please choose</option>
                                        </select>
                                    </div>
                                    <div class="hidden_fields">
                                        <input type="hidden" class="hidden_id_input hidden_user_field_id_#" name="user_field_#_id" value="">
                                        <input type="hidden" class="hidden_user_field_type_#" name="user_field_#_type" value="checkbox">
                                        <input type="hidden" class="hidden_user_field_default_#" name="user_field_#_default" value="">
                                        <input type="hidden" class="hidden_user_field_values_#" name="user_field_#_values" value="">
                                        <input type="hidden" class="hidden_user_field_title_#" name="user_field_#_title" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form_build_selection_add">
                                        <label class="control-label" for="selection_user_add">Defaultvalue:</label>
                                        <input class="form-control" name="selection_user_add" type="text" id="selection_user_add" placeholder="Enter another section value...">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    </br>
                                    <a href="#" class="btn btn-sm btn-success btn-selection-field-adder" data-table-id="#"> add
                                    </a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 selection_table">
                                    <p>Your possible Selections:</p>
                                    <table class="table table-striped form_field_options" data-table-id="#">
                                        <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Edit</td>
                                        </tr>
                                        </thead>
                                        <tbody class="tbody_id_#">

                                        </tbody>
                                    </table>
                                </div>

                            </div>



                            <!---

                          TEXTINPUT



                          --->




                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_field" data-table-id="4" data-table-input-field="4" data-table-input-id="4" data-table-type="text">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">Placeholder: </label>
                                    <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>

                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_4" name="user_field_4_id" value="">
                                    <input type="hidden" class="hidden_user_field_type_4" name="user_field_4_type" value="text">
                                    <input type="hidden" class="hidden_user_field_default_4" name="user_field_4_default" value="">
                                    <input type="hidden" class="hidden_user_field_title_4" name="user_field_4_title" value="">
                                </div>

                            </div>



                            <!---

                        NUMBERINPUT



                        --->


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_field number_field" data-table-id="5" data-table-input-field="5" data-table-input-id="5" data-table-type="number">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min_max">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group has-feedback has-feedback-left">
                                            <label class="control-label" for="formtype">Placeholder: </label>
                                            <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group has-feedback has-feedback-left">
                                            <label class="control-label" for="formtype">Min-Value: </label>
                                            <input class="form-control input_field_placeholder min_value_field" name="formtitle" type="number" placeholder="min-value" value="">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group has-feedback has-feedback-left">
                                            <label class="control-label" for="formtype">Max-Value: </label>
                                            <input class="form-control input_field_placeholder max_value_field" name="formtitle" type="number" placeholder="max-value" value="">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_5" name="user_field_5_id" value="">
                                    <input type="hidden" class="hidden_user_field_type_5" name="user_field_5_type" value="number">
                                    <input type="hidden" class="hidden_user_field_default_5" name="user_field_5_default" value="">
                                    <input type="hidden" class="hidden_user_field_title_5" name="user_field_5_title" value="">
                                    <input type="hidden" class="hidden_user_field_values_5" name="user_field_5_values" value="">
                                </div>
                            </div>

                            <!---

                      DATEINPUT



                      --->


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_field date_field" data-table-id="6" data-table-input-field="6" data-table-input-id="6" data-table-type="date">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <div class="form-group has-feedback has-feedback-left placeholder_value">
                                            <label class="control-label" for="formtype">Placeholder: </label>
                                            <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <div class="form-group has-feedback has-feedback-left default_value">
                                            <label class="control-label" for="formtype">Default-Value: </label>
                                            <input class="form-control datepicker_userspec" name="formtitle" type="text" placeholder="Your formular title...">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_6" name="user_field_6_id" value="">
                                    <input type="hidden" class="hidden_user_field_type_6" name="user_field_6_type" value="date">
                                    <input type="hidden" class="hidden_user_field_default_6" name="user_field_6_default" value="">
                                    <input type="hidden" class="hidden_user_field_title_6" name="user_field_6_title" value="">
                                    <input type="hidden" class="hidden_user_field_values_6" name="user_field_6_values" value="">
                                    <input type="hidden" class="hidden_user_field_placeholder_6" name="user_field_6_placeholder" value="">
                                </div>
                            </div>






                            <!---

                      TIMEINPUT



                      --->

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_field date_field" data-table-id="7" data-table-input-field="7" data-table-input-id="7" data-table-type="time">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <div class="form-group has-feedback has-feedback-left placeholder_value">
                                            <label class="control-label" for="formtype">Placeholder: </label>
                                            <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <div class="form-group has-feedback has-feedback-left">
                                            <label class="control-label" for="formtype">Default-Value: </label>
                                            <input class="form-control timepicker_userspec" name="formtitle" type="text" placeholder="Your time goes here...">
                                            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_7" name="user_field_7_id" value="">
                                    <input type="hidden" class="hidden_user_field_type_7" name="user_field_7_type" value="time">
                                    <input type="hidden" class="hidden_user_field_default_7" name="user_field_7_default" value="">
                                    <input type="hidden" class="hidden_user_field_title_7" name="user_field_7_title" value="">
                                    <input type="hidden" class="hidden_user_field_values_7" name="user_field_7_values" value="">
                                    <input type="hidden" class="hidden_user_field_placeholder_7" name="user_field_7_placeholder" value="">
                                </div>
                            </div>



                            <!---

               RADIOINPUT



               --->            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 select_field_area select_field_area_8" data-type="radio" data-table-id="8" data-table-input-id="8" data-user-field-id="8">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form_build_selection" >
                                        <label class="control-label" for="selection_user" id="field_title_8">Defaultvalue:</label>
                                        <select class="form-control selection_user" name="form_selection_8" id="selection_user_8" >
                                            <option value="select" selected>Please choose</option>
                                        </select>
                                    </div>
                                    <div class="hidden_fields">
                                        <input type="hidden" class="hidden_id_input hidden_user_field_id_8" name="user_field_8_id" value="">
                                        <input type="hidden" class="hidden_user_field_type_8" name="user_field_8_type" value="radio">
                                        <input type="hidden" class="hidden_user_field_default_8" name="user_field_8_default" value="">
                                        <input type="hidden" class="hidden_user_field_values_8" name="user_field_8_values" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form_build_selection_add">
                                        <label class="control-label" for="selection_user_add">Defaultvalue:</label>
                                        <input class="form-control" name="selection_user_add" type="text" id="selection_user_add" placeholder="Enter another section value...">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    </br>
                                    <a href="#" class="btn btn-sm btn-success btn-selection-field-adder" data-table-id="8"> add
                                    </a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 selection_table">
                                    <p>Your possible Selections:</p>
                                    <table class="table table-striped form_field_options" data-table-id="8">
                                        <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Edit</td>
                                        </tr>
                                        </thead>
                                        <tbody class="tbody_id_8">

                                        </tbody>
                                    </table>
                                </div>



                            </div>

                            <!-- TEMPLATE für mich dann: RADIO-TEMPLATE
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label" for="formtype">Formtitlte</label>
                                <p>type = Yes/No</p>
                                <div class="form-group">

                                        <label class="control-label" for="formtype">Default-Value: </label>

                                        <label class="control-label" for="Yes">Yes</label>
                                        <input name="formtitle" id="Yes" type="radio" value="Yes" >
                                        <label class="control-label" for="No">No</label>
                                        <input name="formtitle" id="No" type="radio" value="No" >

                                </div>
                            </div>

                            -->



                                            <!---

                               NOTICE - TEXTAREA - INPUT



                               --->






                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_field" data-table-id="9" data-table-input-field="9" data-table-input-id="9" data-table-type="textarea">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">Placeholder: </label>
                                    <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>

                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_9" name="user_field_9_id" value="">
                                    <input type="hidden" class="hidden_user_field_type_9" name="user_field_9_type" value="textarea">
                                    <input type="hidden" class="hidden_user_field_default_9" name="user_field_9_default" value="">
                                    <input type="hidden" class="hidden_user_field_title_9" name="user_field_9_title" value="">
                                    <input type="hidden" class="hidden_user_field_placeholder_9" name="user_field_9_placeholder" value="">
                                </div>

                            </div>


                                <table class="table_template">
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Edit</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="tr_template" data-table-type="selection">
                                        <td>
                                            <input type="hidden" class="editable_input" value="Please choose...">
                                            <span class="editable_text">Please choose...</span>
                                        </td>
                                        <td width="200">
                                            <a href="#" class="btn btn-sm btn-info arrow_up">
                                                <span class="glyphicon glyphicon-arrow-up"></span>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-info arrow_down">
                                                <span class="glyphicon glyphicon-arrow-down"></span>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger option_delete">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>

                                        </td>
                                    </tr>
                                    </tbody>
                                    </table>

                            <!--TEXT AREA TEMPLATE -->
                            <div class="form-group has-feedback has-feedback-left">
                                <p>type = Notice</p>
                                <div class="form-group">
                                    <label class="control-label" for="formtitle">Defaultvalue</label>
                                    <textarea class="form-control" name="formdescription" rows="3" placeholder="Your description goes here..."></textarea>
                                </div>

                            </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                            <input type="hidden" value="" name="UserFieldIds" id="userfieldids">
                            <input type="submit" name="saveUserFields" class="btn btn-lg spec spec_dashboard" value="Save">
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