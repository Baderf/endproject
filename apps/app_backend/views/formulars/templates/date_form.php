<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field date_input" data-table-id="<?php echo $data['user_form_' . $id][0]['id']; ?>" data-type="<?php echo $data['user_form_' . $id][0]['type']; ?>" data-table-input-id="<?php echo $data['user_form_' . $id][0]['id']; ?>" data-table-type="date">
    <dt class="accordion_opener"><?php echo $data['user_form_' . $id][0]['title']; ?> (<?php echo $data['user_form_' . $id][0]['type']; ?> field)</dt>
    <dd>
        <div class="form-group has-feedback has-feedback-left">
            <label class="control-label" for="formtype">The Input Title: </label>
            <input class="form-control input_field_title" name="formtitle" id="field_title_<?php echo $data['user_form_' . $id][0]['id']; ?>" type="text" placeholder="Fill in the title..." value="<?php echo $data['user_form_' . $id][0]['title']; ?>">
            <i class="glyphicon glyphicon-plus form-control-feedback"></i>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="form-group has-feedback has-feedback-left placeholder_value">
                    <label class="control-label" for="formtype">Placeholder: </label>
                    <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="<?php if(!empty($data['user_form_' . $id][0]['placeholder'])){echo $data['user_form_' . $id][0]['placeholder']; }; ?>">
                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div class="form-group has-feedback has-feedback-left default_value">
                    <label class="control-label" for="formtype">Default-Value: </label>
                    <input class="form-control datepicker_userspec" name="formtitle" type="text" placeholder="Your formular title..." value="<?php if(!empty($data['user_form_' . $id][0]['default_value'])){echo $data['user_form_' . $id][0]['default_value']; }; ?>">
                    <i class="glyphicon glyphicon-plus form-control-feedback"></i>
                </div>
            </div>
        </div>

        <div class="hidden_fields">
            <input type="hidden" class="hidden_id_input hidden_user_field_id_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_id_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php echo $data['user_form_' . $id][0]['id']; ?>">
            <input type="hidden" class="hidden_user_field_type_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_type_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="date">
            <input type="hidden" class="hidden_user_field_default_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_default_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id][0]['default_value'])){echo $data['user_form_' . $id][0]['default_value']; }; ?>">
            <input type="hidden" class="hidden_user_field_values_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_values_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id][0]['data_values'])){echo $data['user_form_' . $id][0]['data_values']; }; ?>">
            <input type="hidden" class="hidden_user_field_title_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_title_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php echo $data['user_form_' . $id][0]['title']; ?>">
            <input type="hidden" class="hidden_user_field_placeholder_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_placeholder_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id][0]['placeholder'])){echo $data['user_form_' . $id][0]['placeholder']; }; ?>">
            <input type="hidden" class="hidden_user_field_required_<?php echo $data['user_form_' . $id][0]['id']; ?>" name="user_field_required_<?php echo $data['user_form_' . $id][0]['id']; ?>" value="<?php if(!empty($data['user_form_' . $id][0]['is_required'])){echo $data['user_form_' . $id][0]['is_required']; }; ?>">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 input_field_options">
            <p>Options:</p>
            <div class="checkbox">
                <label class="label_option_is_required"><input class="option_is_required" type="checkbox" value="" <?php if(!empty($data['user_form_' . $id][0]['is_required']) && $data['user_form_' . $id][0]['is_required'] == "true" ){echo "checked"; }; ?>>required?</label>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 remove_user_field">
            <a href="#" class="btn btn-sm btn-danger btn-field-remover"> remove field
            </a>
        </div>
    </dd>
</div>