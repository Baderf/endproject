<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field user_input_radio select_field_area select_field_area_<?php echo $data['user_form_' . $id]['id']; ?>" data-type="radio" data-table-type="radio" data-table-input-id="<?php echo $data['user_form_' . $id]['id']; ?>" data-user-field-id="<?php echo $data['user_form_' . $id]['id']; ?>">
    <dt class="accordion_opener"><?php echo $data['user_form_' . $id]['title']; ?> (<?php echo $data['user_form_' . $id]['type']; ?> field)
    <div class="dt_options">
        <a href="#" class="btn btn-sm btn-info arrow_up">
            <span class="glyphicon glyphicon-arrow-up"></span>
        </a>
        <a href="#" class="btn btn-sm btn-info arrow_down">
            <span class="glyphicon glyphicon-arrow-down"></span>
        </a>
        <a href="#" class="btn btn-sm btn-transparent field_delete">
            <span class="glyphicon glyphicon-trash"></span>
        </a>
    </div>
    </dt>
    <dd>
        <div class="form-group has-feedback has-feedback-left">
            <label class="control-label" for="formtype">The Input Title: </label>
            <input class="form-control input_field_title" name="formtitle" id="field_title_<?php echo $data['user_form_' . $id]['id']; ?>" type="text" placeholder="Fill in the title..." value="<?php echo $data['user_form_' . $id]['title']; ?>">
            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group form_build_selection" >
                <label class="control-label" for="selection_user" id="field_title_<?php echo $data['user_form_' . $id]['title']; ?>">Defaultvalue:</label>
                <select class="form-control selection_user" name="form_selection_<?php echo $data['user_form_' . $id]['id']; ?>" >

                    <?php

                    // FOREACH DATA VALUES "," $data['user_form_' . $id]['id'];
                    $values = explode("::", $data['user_form_' . $id]['data_values']);

                    foreach ($values as $key){
                        $key = str_replace(":", "", $key);
                        if($key === $data['user_form_' . $id]['default_value']){
                            echo "<option value='$key' selected>$key</option>";
                        }else{
                            echo "<option value='$key'>$key</option>";
                        }

                    }

                    ?>
                </select>
            </div>
            <div class="hidden_fields">
                <input type="hidden" class="hidden_id_input hidden_user_field_id_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_id_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php echo $data['user_form_' . $id]['id']; ?>">
                <input type="hidden" class="hidden_user_field_type_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_type_<?php echo $data['user_form_' . $id]['id']; ?>" value="radio">
                <input type="hidden" class="hidden_user_field_default_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_default_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id]['default_value'])){echo $data['user_form_' . $id]['default_value']; }; ?>">
                <input type="hidden" class="hidden_user_field_values_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_values_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id]['data_values'])){echo $data['user_form_' . $id]['data_values']; }; ?>">
                <input type="hidden" class="hidden_user_field_title_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_title_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php echo $data['user_form_' . $id]['title']; ?>">
                <input type="hidden" class="hidden_user_field_placeholder_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_placeholder_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id]['placeholder'])){echo $data['user_form_' . $id]['placeholder']; }; ?>">
                <input type="hidden" class="hidden_user_field_required_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_required_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id]['is_required'])){echo $data['user_form_' . $id]['is_required']; }; ?>">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="form-group form_build_selection_add">
                <label class="control-label" for="selection_user_add">Add an option:</label>
                <input class="form-control" name="selection_user_add" type="text" id="selection_user_add" placeholder="Enter another section value...">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            </br>
            <a href="#" class="btn btn-sm btn-success btn-selection-field-adder" data-table-id="<?php echo $data['user_form_' . $id]['id']; ?>"> add
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 selection_table">
            <p>Your possible Selections:</p>
            <table class="table table-striped form_field_options" data-table-id="<?php echo $data['user_form_' . $id]['id']; ?>">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Edit</td>
                </tr>
                </thead>
                <tbody class="tbody_id_<?php echo $data['user_form_' . $id]['id']; ?>" data-table-id="<?php echo $data['user_form_' . $id]['id']; ?>">
                <?php

                // FOREACH DATA VALUES "," für TR
                foreach ($values as $key){
                    $key = str_replace(":", "", $key);

                    ?>

                    <tr data-table-id="<?php echo $data['user_form_' . $id]['id']; ?>" class="is_selection" data-table-type="selection">
                        <td>
                            <input type="hidden" class="editable_input" value="<?php echo $key; ?>">
                            <span class="editable_text"><?php echo $key; ?></span>
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

                    <?php
                }

                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
            <p>Options:</p>
            <div class="checkbox">
                <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" <?php if(!empty($data['user_form_' . $id]['is_required']) && $data['user_form_' . $id]['is_required'] == "true" ){echo "checked"; }; ?>>required?</label>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
            <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
            </a>
        </div>
    </dd>
</div>