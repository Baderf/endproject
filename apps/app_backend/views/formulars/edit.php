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
                                            </thead>
                                            <tbody>

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
                        <form action="" method="post">


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Create a new form</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dicta doloremque earum error eum illum, placeat quisquam rem saepe sequi! Facilis nesciunt optio porro quasi quo quos reprehenderit, ut! Explicabo.</p>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <div class="form-group has-feedback has-feedback-left">
                                        <label class="control-label" for="formtitle">Formtitle</label>
                                        <input class="form-control" name="formtitle" type="text" id="formtitle_user_spec" placeholder="Your formular title..." value="">
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

                        </div>

                        <div class="row" id="userspec_field_area">
                            <input type="hidden" id="last_id" value="<?php

                            echo $this -> data['last_user_id'][0] +1;?>">

                            <?php
                            if(isset($data['user_form_ids']) && !empty($data['user_form_ids'])){
                                $user_form_ids = explode("::", $data['user_form_ids']);

                                foreach ($user_form_ids as &$id){
                                    $id = str_replace(":", "", $id);

                                    $type = $data['user_form_' . $id][0]['type'];

                                    if($type != ""){
                                        require APPS . CURRENT_APP . APP_VIEWS . '/formulars/templates/' . $type . '_form.php';
                                    }

                                }

                            }
                            ?>

                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-right-area">
                            <input type="hidden" value="<?php echo $data['formdetails']['user_field_ids'];?>" name="UserFieldIds" id="userfieldids">
                            <input type="submit" name="saveUserFields" class="btn btn-lg spec spec_dashboard" value="Save">
                        </div>
                        </form>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input_templates">

                        <!--
                           SELECT
                        -->

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field user_input_select select_field_area select_field_area_" data-type="select" data-table-type="select" data-table-input-id="#" data-user-field-id="#">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form_build_selection" >
                                        <label class="control-label" for="selection_user">Defaultvalue:</label>
                                        <select class="form-control selection_user" name="form_selection_" >

                                        </select>
                                    </div>
                                    <div class="hidden_fields">
                                        <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                        <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="select">
                                        <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                        <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                        <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                        <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                        <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
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
                                        <tbody class="tbody_id_">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                    <p>Options:</p>
                                    <div class="checkbox">
                                        <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                    <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                    </a>
                                </div>
                            </dd>
                        </div>


                        <!---

                         CHECKBOX



                         --->



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field user_input_checkbox select_field_area select_field_area_" data-type="checkbox" data-table-type="checkbox" data-table-input-id="#" data-user-field-id="#">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group form_build_selection" >
                                    <label class="control-label" for="selection_user" id="field_title_">Defaultvalue:</label>
                                    <select class="form-control selection_user" name="form_selection_" >
                                        <option value="select" selected>Please choose</option>
                                    </select>
                                </div>
                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                    <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="checkox">
                                    <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                    <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                    <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                    <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                    <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
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
                                    <tbody class="tbody_id_">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                               </dd>
                        </div>



                        <!---

                      TEXTINPUT



                      --->




                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field text_input" data-table-id="#" data-table-input-field="#" data-table-input-id="#" data-table-type="text">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">The Input Title: </label>
                                <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
                                <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">Placeholder: </label>
                                <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                            </div>

                            <div class="hidden_fields">
                                <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="text">
                                <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                                </dd>
                        </div>



                        <!---

                    NUMBERINPUT



                    --->


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field number_field" data-table-id="#" data-table-input-field="#" data-table-input-id="#" data-table-type="number">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">The Input Title: </label>
                                <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
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
                                <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="number">
                                <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                            </dd>
                        </div>

                        <!---

                  DATEINPUT



                  --->


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field date_input" data-table-id="#" data-table-input-id="#" data-table-type="date">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">The Input Title: </label>
                                <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
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
                                <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="date">
                                <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                            </dd>
                        </div>






                        <!---

                  TIMEINPUT



                  --->

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field date_field time_input" data-table-id="#" data-table-input-id="#" data-table-type="time" data-type="time">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">The Input Title: </label>
                                <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
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
                                <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="time">
                                <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                            </dd>
                        </div>



                        <!---

           RADIOINPUT



       --->            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field user_input_radio select_field_area select_field_area_" data-type="radio" data-table-type="radio" data-table-input-id="#" data-user-field-id="#">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="formtype">The Input Title: </label>
                                    <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
                                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                                </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group form_build_selection" >
                                    <label class="control-label" for="selection_user">Defaultvalue:</label>
                                    <select class="form-control selection_user" name="form_selection_" >
                                        <option value="select" selected>Please choose</option>
                                    </select>
                                </div>
                                <div class="hidden_fields">
                                    <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                    <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="radio">
                                    <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                    <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                    <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                    <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                    <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
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
                                    <tbody class="tbody_id_">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                            </dd>
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






                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field textarea_input" data-table-id="#" data-table-input-field="#" data-table-input-id="#" data-table-type="textarea">
                            <dt class="accordion_opener">Hier steht der Titel des Formulars</dt>
                            <dd>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">The Input Title: </label>
                                <input class="form-control input_field_title" name="formtitle" id="field_title_" type="text" placeholder="Fill in the title..." value="">
                                <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label class="control-label" for="formtype">Placeholder: </label>
                                <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="">
                                <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                            </div>

                            <div class="hidden_fields">
                                <input type="hidden" class="hidden_id_input hidden_user_field_id_" name="user_field_id_" value="">
                                <input type="hidden" class="hidden_user_field_type_" name="user_field_type_" value="textarea">
                                <input type="hidden" class="hidden_user_field_default_" name="user_field_default_" value="">
                                <input type="hidden" class="hidden_user_field_values_" name="user_field_values_" value="">
                                <input type="hidden" class="hidden_user_field_title_" name="user_field_title_" value="">
                                <input type="hidden" class="hidden_user_field_placeholder_" name="user_field_placeholder_" value="">
                                <input type="hidden" class="hidden_user_field_required_" name="user_field_required_" value="true">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
                                <p>Options:</p>
                                <div class="checkbox">
                                    <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" checked>required?</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
                                <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
                                </a>
                            </div>
                              </dd>
                        </div>


                        <table class="table_template">
                            <thead>
                            <tr>
                                <td>Name</td>
                                <td>Edit</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="tr_template" data-table-type="selection" data-table-id="#">
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
                </div>



            </div>
            </div>
        </div>
    </div>





        <!-- /.container -->

    </div>

    <!-- /.container -->

</div>