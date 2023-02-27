<?php

include_once ('../system/user_default.php');
include_once ('../system/routines/php/secure.php');
include_once ('../system/routines/php/anagrafica.php');
include_once ('../system/routines/php/sitemap.php');

$ret = get_sitemap_from_smid($_POST["smid"]);
$ret["error"] = 0;

echo json_encode($ret);
