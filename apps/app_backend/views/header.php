<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mailpig - Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC; ?>css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC; ?>css/loggedin.css"/>

    <!-- Custom Fonts -->
    <link href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC; ?>css/bootstrap-datetimepicker.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <base href="<?php echo APP_ROOT . APPS . CURRENT_APP; ?>"/>
    <![endif]-->

</head>

<div class="overlay is_hidden" id="delete_overlay" data-action="close">
    <div class="overlay_wrapper" id="overlay_wrapper">
        <span class="btn_cancel" data-action="close">X</span>
        <p>
            Are you sure to do this?
        </p>
        <span class="btn btn-lg btn-success" data-action="close">
            YES
        </span>
        <span class="btn btn-lg btn-danger" data-action="close">
            NO
        </span>
    </div>
</div>
<body class="logged_in" data-baseurl="<?php echo APP_ROOT; ?>">
<div class="mailpig_helper col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <img src="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img/logo_pig.png'; ?>" alt="">
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p><strong class="mailpig_helper_title">Hi, <?php // echo sessions::get("username"); ?></strong></p>
        <p class="mailpig_helper_text">Do you need some help?</p>
        <button class="btn btn-sm spec_dashboard">dont show again</button>
    </div>
    </div>

<!-- Mobile Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top topnav visible-xs" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="<?php echo APP_ROOT?>home"><h1>Mailpig</h1></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">

                <?php
                $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
                $url = explode("/", $url);
                ?>
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/dashboard' ?>" class="nav-btn">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/myevents' ?>" class="nav-btn">My Events</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/designs' ?>" class="nav-btn">Designs</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/formulars' ?>" class="nav-btn">Formulars</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/users' ?>" class="nav-btn">Users</a>
                </li>
            </ul>
            <hr>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo APP_ROOT . $url[0] . '/logout' ?>" class="nav-btn">Logout</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT;?>home" class="nav-btn">Back to Mailpig</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<nav class="nav-logged_in navbar-fixed-top visible-sm visible-md visible-lg">

    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
            <?php
            $url = ( isset($_GET['url']) ) ? $_GET['url'] : null;
            $url = explode("/", $url);
            require_once "config/nav_backend.php";
            
            foreach ($nav_backend as $key => $val){
                if ($val == $url[1]){
                    echo "<li class='$val active'>";
                }else {
                    echo "<li class='$val'>";
                }

                $link = APP_ROOT . $url[0] . '/' . $val;
                echo "<i class=\"icon icon_$val\"></i>";
                echo "<a href=\"$link\" class=\"nav-btn\">$key</a>";


            }
            ?>


        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="logout">
                <i class="icon icon_logout"></i>
                <a href="<?php echo APP_ROOT . $url[0] . '/' . 'logout'?>" class="nav-btn">Logout</a>
            </li>
            <li>
                <i class="icon icon_logo"></i>
                <a href="<?php echo APP_ROOT?>home" class="nav-btn"></a>
            </li>
        </ul>
    </div>

</nav>

<div class="col-lg-12 hader_background">

</div>