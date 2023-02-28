<?php

require_once 'db_connect.php';

function get_dispositivo_from_idd($idd)
{
    global $db;

    $sql = mysqli_query($db, "SELECT "
            . "idd, "
            . "idm, "
            . "nome, "
            . "coord_x, "
            . "coord_y FROM dispositivi WHERE idd = '$idd' ");

    if(!mysqli_num_rows($sql)){
        return;

    }
    $row = mysqli_fetch_array($sql);
    $ret["idd"] = $idd;
    $ret["idm"] = $row["idm"];
    $ret["nome"] = $row["nome"];
    $ret["coord_x"] = $row["coord_x"];
    $ret["coord_y"] = $row["coord_y"];
    return $ret;
}

function get_dispositivi()
{
    global $db;
    $sql = mysqli_query($db, "SELECT "
            . "idd, "
            . "idm, "
            . "nome, "
            . "coord_x, "
            . "coord_y FROM dispositivi ORDER BY idm");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["idd"] = $row["idd"];
        $ret[$i]["idm"] = $row["idm"];
        $ret[$i]["nome"] = $row["nome"];
        $ret[$i]["coord_x"] = $row["coord_x"];
        $ret[$i]["coord_y"] = $row["coord_y"];
        $i++;
    }
    return $ret;
}

function aggiungi_dispositivo($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idm = $dati["idm"];
        $nome = $dati["nome"];
        $coord_x = $dati["coord_x"];
        $coord_y = $dati["coord_y"];
        mysqli_query($db, "INSERT INTO dispositivi (idm,nome,coord_x,coord_y) VALUES ('$idm','$nome','$coord_x','$coord_y')");
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function aggiorna_dispositivo($dati)
{
    global $db;
    $idd = $dati["idd"];
    $idm = $dati["idm"];
    $nome = $dati["nome"];
    $coord_x = $dati["coord_x"];
    $coord_y = $dati["coord_y"];

    mysqli_query($db, "UPDATE dispositivi SET idm= '$idm', nome = '$nome', coord_x = '$coord_x', coord_y = '$coord_y' WHERE idd = '$idd'");

    $ret["error"] = 0;
    return $ret;
}

function cancella_dispositivo($idd)
{
    global $db;
    mysqli_query($db, "DELETE FROM dispositivi WHERE idd = '$idd'");
}

function aggiungi_rilevazione($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idd = $dati["idd"];
        $pm = $dati["pm"];
        $CO = $dati["CO"];
        $NO2 = $dati["NO2"];
        $SO2 = $dati["SO2"];
        $O3 = $dati["O3"];
        $timestamp = $dati["timestamp"];
        mysqli_query($db, "INSERT INTO rilevazioni (idd,pm,CO,NO2,SO2,O3,data_rilevazione) VALUES ('$idd','$pm','$CO','$NO2','$SO2','$O3','$timestamp')");
        $ret["error"] = 0;
    }
    else
    {
        $ret["error"] = 1;
    }
    return $ret;
}

function get_rilevazioni()
{
    global $db;
    $sql = mysqli_query($db, "SELECT idr,idd,pm,CO,NO2,SO2,O3,data_rilevazione FROM rilevazioni ORDER BY idr");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["idr"] = $row["idr"];
        $ret[$i]["idd"] = $row["idd"];
        $ret[$i]["pm"] = $row["pm"];
        $ret[$i]["CO"] = $row["CO"];
        $ret[$i]["NO2"] = $row["NO2"];
        $ret[$i]["SO2"] = $row["SO2"];
        $ret[$i]["O3"] = $row["O3"];
        $ret[$i]["timestamp"] = $row["data_rilevazione"];
        $i++;
    }
    return $ret;
}

function cancella_rilevazione($idr)
{
    global $db;
    mysqli_query($db, "DELETE FROM rilevazioni WHERE idr = '$idr'");
}
