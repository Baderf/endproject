<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
            $url_back = htmlspecialchars($_SERVER['HTTP_REFERER']);
            ?>
            <a href="<?php
            echo $url_back;
            ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3>Edit User:</h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->

    <!-- jQuery -->

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 default_user_values">
                <h4>User-Data:</h4>
                <?php echo $data['user_values'];?>
            </div>
        </div>

    </div>

    <!-- /.container -->

</div>