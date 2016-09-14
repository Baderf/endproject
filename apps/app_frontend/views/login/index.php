<div class="content-section-b login text-center" id="login">

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h2>Login</h2>
            </div>
            <div class="col-lg-12 login-form text-center">
                <form action="" role="form" method="post">
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="username">Username</label>
                        <input class="form-control" type="text" name="f-username" id="username" placeholder="Username...">
                        <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="password">Password</label>
                        <input class="form-control" type="password" name="f-password" id="password" placeholder="Password...">
                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                    </div>

                    <?php
                    if(isset($data['formError'])){
                        ?>
                        <div class="alert alert-danger">
                            <strong>Warning!</strong>- <?php echo $data['formError']; ?>
                        </div>
                    <?php

                    }
                    ?>

                    <input type="submit" name="f-setlogin" value="Login" class="btn btn-lg btn-home btn-home-big btn-default"></input>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>