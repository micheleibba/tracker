<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/secure.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/anagrafica.php');

$ret["utente"] = get_user_from_uid($_POST["uid"]);
$ret["login"] = get_login_from_uid($_POST["uid"]);
$ret["error"] = 0;

echo json_encode($ret);
