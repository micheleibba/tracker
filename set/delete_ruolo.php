<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/secure.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/anagrafica.php');

$ret["debug"] = delete_user_type($_POST["tid"]);
$ret["error"] = 0;

echo json_encode($ret);


