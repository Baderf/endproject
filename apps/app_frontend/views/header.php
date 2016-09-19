<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mailpig</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC ?>css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC ?>css/styles.css"/>

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo APP_ROOT . APPS . CURRENT_APP . APP_PUBLIC . 'img'; ?>/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top topnav" role="navigation">
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
        <div class="collapse navbar-collapse home_lg_nav" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo APP_ROOT . 'home#about';?>" class="page-scroll">About</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . 'home#services';?>" class="page-scroll">Services</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . 'home#contact';?>" class="page-scroll">Contact</a>
                </li>
                <li>
                    <a href="<?php echo APP_ROOT . 'home#getstarted';?>" id="get_started_free" class="btn btn-default btn-home btn-sm page-scroll">get started</a>
                </li>
                <li>
                    <?php
                    if (sessions::get("usergroup") === false) {
                        echo  "<a href=" . APP_ROOT . 'login' . ">Login</a>";
                    }             else{
                        echo '<a href="backend/dashboard">Dashboard</a>';
                    }
                    ?>

                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>