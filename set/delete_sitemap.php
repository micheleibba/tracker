<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/secure.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/sitemap.php');

$ret["debug"] = delete_sitemap($_POST["smid"]);
$ret["error"] = 0;

echo json_encode($ret);


