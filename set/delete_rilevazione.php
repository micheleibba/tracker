<?php

include_once ('../system/user_default.php');
include_once ('../system/routines/php/secure.php');
include_once ('../system/routines/php/anagrafica.php');
include_once ('../system/routines/php/dispositivi.php');

$ret["debug"] = cancella_rilevazione($_POST["idr"]);
$ret["error"] = 0;

echo json_encode($ret);
