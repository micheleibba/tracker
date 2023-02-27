<?php

include_once ('../system/user_default.php');
include_once ('../system/routines/php/secure.php');
include_once ('../system/routines/php/anagrafica.php');

$ret["debug"] = cancella_utente($_POST["uid"]);
$ret["error"] = 0;

echo json_encode($ret);
