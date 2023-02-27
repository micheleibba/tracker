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
