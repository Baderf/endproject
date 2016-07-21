<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_input_field input_field text_input" data-table-id="<?php echo $data['user_form_' . $id]['id']; ?>" data-table-input-field="<?php echo $data['user_form_' . $id]['id']; ?>" data-table-input-id="<?php echo $data['user_form_' . $id]['id']; ?>" data-table-type="text">
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
        <div class="form-group has-feedback has-feedback-left">
            <div class="form-group has-feedback has-feedback-left placeholder_value">
                <label class="control-label" for="formtype">Placeholder: </label>
                <input class="form-control input_field_placeholder" name="formtitle" type="text" placeholder="The placeholder goes here..." value="<?php if(!empty($data['user_form_' . $id]['placeholder'])){echo $data['user_form_' . $id]['placeholder']; }; ?>">
                <i class="glyphicon glyphicon-plus form-control-feedback"></i>
            </div>
        </div>

        <div class="hidden_fields">
            <input type="hidden" class="hidden_id_input hidden_user_field_id_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_id_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php echo $data['user_form_' . $id]['id']; ?>">
            <input type="hidden" class="hidden_user_field_type_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_type_<?php echo $data['user_form_' . $id]['id']; ?>" value="text">
            <input type="hidden" class="hidden_user_field_default_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_default_<?php echo $data['user_form_' . $id]['id']; ?>" value="">
            <input type="hidden" class="hidden_user_field_values_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_values_<?php echo $data['user_form_' . $id]['id']; ?>" value="">
            <input type="hidden" class="hidden_user_field_title_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_title_<?php echo $data['user_form_' . $id]['id']; ?>" value="<?php echo $data['user_form_' . $id]['title']; ?>">
            <input type="hidden" class="hidden_user_field_placeholder_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_placeholder_<?php echo $data['user_form_' . $id]['id']; ?>" value="">
            <input type="hidden" class="hidden_user_field_required_<?php echo $data['user_form_' . $id]['id']; ?>" name="user_field_required_<?php echo $data['user_form_' . $id]['id']; ?>" value="true">
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