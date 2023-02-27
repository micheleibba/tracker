<?php

require_once 'db_connect.php';

function get_sitemap()
{
    global $db;
    $sql = mysqli_query($db, "SELECT smid, titolo, path FROM sitemap ORDER BY titolo");
    if(!mysqli_num_rows($sql))
    {
        return;
    }
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["smid"] = $row["smid"];
        $ret[$i]["titolo"] = $row["titolo"];
        $ret[$i]["path"] = $row["path"];
        $i++;
    }
    return $ret;
}

function get_sitemap_from_smid($smid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT smid, titolo, path FROM sitemap WHERE smid='$smid'");
    if(!mysqli_num_rows($sql))
    {
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["smid"] = $row["smid"];
    $ret["titolo"] = $row["titolo"];
    $ret["path"] = $row["path"];
    return $ret;
}

function save_sitemap($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $dati["titolo"] !== "")
    {
        $titolo = $dati["titolo"];
        $path = $dati["path"];
        mysqli_query($db, "INSERT INTO sitemap (titolo,path) VALUES ('$titolo','$path')");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function edit_sitemap($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $smid = $dati["smid"];
        $titolo = $dati["titolo"];
        $path = $dati["path"];
        mysqli_query($db, "UPDATE sitemap SET titolo='$titolo', path='$path' WHERE smid='$smid'");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function delete_sitemap($smid)
{
    global $db;
    mysqli_query($db, "DELETE FROM sitemap WHERE smid = '$smid'");
}