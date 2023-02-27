<?php

include_once ('./system/user_default.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/send.php');

$ret = send_email();

echo json_encode($ret);
