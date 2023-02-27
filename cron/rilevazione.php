<?php

include_once ('./system/user_default.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/send.php');

$ret = rileva();

echo json_encode($ret);
