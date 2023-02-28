<?php

include_once ('../system/user_default.php');
include_once ('../system/routines/php/secure.php');
include_once ('../system/routines/php/anagrafica.php');
include_once ('../system/routines/php/dispositivi.php');

$_SERVER['REQUEST_METHOD'] = 'POST';
$dati["idd"] = 1;
$dati["pm"] = rand(1,50);
$dati["CO"] = rand(1,50);
$dati["NO2"] = rand(1,50);
$dati["SO2"] = rand(1,50);
$dati["O3"] = rand(1,50);
$dati["timestamp"] = rand(1606808554,1612078954);

$ret["debug"] = aggiungi_rilevazione($dati)["error"];

echo json_encode($ret);
