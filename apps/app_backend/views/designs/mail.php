<?php

$header = ob_get_contents(APP_ROOT . APPS . CURRENT_APP . APP_VIEWS . 'designs/mailheader.txt');
$footer = ob_get_contents(APP_ROOT . APPS . CURRENT_APP . APP_VIEWS . 'designs/mailfooter.txt');

$full_mail = $header . $emailtext . $footer;