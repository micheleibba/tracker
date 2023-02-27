<?php

require_once 'db_connect.php'; 

function get_menu()
{
    global $db;
    
    $sql = mysqli_query($db, "SELECT mid, titolo, path, mdi, prio FROM menu ORDER BY prio");
    
    if(!mysqli_num_rows($sql)){
        return;
    }
    
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["mid"] = $row["mid"];
        $ret[$i]["titolo"] = $row["titolo"];
        $ret[$i]["path"] = $row["path"];
        $ret[$i]["mdi"] = $row["mdi"];
        $ret[$i]["prio"] = $row["prio"];
        $i++;
    }
    return $ret;
}

function get_menu_from_tid($tid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT mid, titolo, path, mdi, prio FROM menu WHERE mid IN (SELECT mid FROM rel_menu_user_type WHERE tid='$tid') ORDER BY prio ASC");
    if(!mysqli_num_rows($sql))
    {
        return;
    }
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["mid"] = $row["mid"];
        $ret[$i]["titolo"] = $row["titolo"];
        $ret[$i]["path"] = $row["path"];
        $ret[$i]["mdi"] = $row["mdi"];
        $ret[$i]["prio"] = $row["prio"];
        $i++;
    }
    return $ret;
}

function get_menu_from_mid($mid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT mid, titolo, path, mdi, prio FROM menu WHERE mid='$mid'");
    if(!mysqli_num_rows($sql))
    {
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["mid"] = $row["mid"];
    $ret["titolo"] = $row["titolo"];
    $ret["path"] = $row["path"];
    $ret["mdi"] = $row["mdi"];
    $ret["prio"] = $row["prio"];
    return $ret;
}

function save_menu($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $dati["titolo"] !== "")
    {
        $titolo = $dati["titolo"];
        $path = $dati["path"];
        $mdi = $dati["mdi"];
        $prio = $dati["prio"];
        mysqli_query($db, "INSERT INTO menu (titolo,path,mdi,prio) VALUES ('$titolo','$path','$mdi','$prio')");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function edit_menu($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $mid = $dati["mid"];
        $titolo = $dati["titolo"];
        $path = $dati["path"];
        $mdi = $dati["mdi"];
        $prio = $dati["prio"];
        mysqli_query($db, "UPDATE menu SET titolo='$titolo',path='$path',mdi='$mdi',prio='$prio' WHERE mid='$mid'");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function delete_menu($mid)
{
    global $db;
    mysqli_query($db, "DELETE FROM menu WHERE mid = '$mid'");
}
