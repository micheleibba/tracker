<?php

include_once ('./system/user_default.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/menu.php');

$ret["debug"] = delete_menu($_POST["mid"]);
$ret["error"] = 0;

echo json_encode($ret);


