<div class="wrapper_formular clearfix">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header">
        <a href="#" class="btn btn-default btn-lg btn-back btn-self">Close</a>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_formular">
        <h3>Preview: <?php echo $data['form_details']['title']; ?></h3>
        <span class="page_quader"></span>
    </div>

    <?php
        if (!empty($data['form_details']['description'])){
            ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formular_description">
        <h4>Description:</h4>
        <p><?php
        echo $data['form_details']['description'];
            ?></p>
    </div>

    <?php
        }
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 preview_field_area" style="background-color: #fff;">
    <?php

        if( isset($formErrors) ){
            echo '<div class="error">';
            foreach($formErrors as $error){
                echo "<p>$error</p>";
            }
            echo '</div>';
        }

    ?>

        <?php echo $form; ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Close</a>
        </div>
    </div>

</div>