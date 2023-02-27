<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/secure.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/anagrafica.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/sistema.php');


$ret= get_page_id($_POST["nome_pagina"]);

echo json_encode($ret);

