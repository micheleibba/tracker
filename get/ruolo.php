<?php

include_once ('../system/user_default.php');
include_once ('../system/routines/php/secure.php');
include_once ('../system/routines/php/anagrafica.php');

$ret = get_user_type_from_tid($_POST["tid"]);
$ret["error"] = 0;

echo json_encode($ret);
