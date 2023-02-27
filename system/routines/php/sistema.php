<?php

require_once 'db_connect.php';

function get_facebook_pagename_from_uid($uid)
{
    global $db;

    $sql = mysqli_query($db, "SELECT facebook_pagina FROM user WHERE uid = '$uid' ");

    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    return $row["facebook_pagina"];
}

function get_facebook_access_token()
{
    global $db;

    $sql = mysqli_query($db, "SELECT aid,access_token FROM facebook_token");

    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["aid"] = $row["aid"];
    $ret["access_token"] = $row["access_token"];
    return $ret;
}

function get_instagram_client_id($uid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT instagram_client_id FROM user WHERE uid = '$uid'");
    if(!mysqli_num_rows($sql)){
        return 0;
    }
    $row = mysqli_fetch_array($sql);
    return $row["instagram_client_id"];
}

function get_instagram_access_token($uid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT instagram_token FROM user WHERE uid = '$uid'");
    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    return $row["instagram_token"];
}

function get_page_id($uid)
{
    $pagename = get_facebook_pagename_from_uid($uid);
    $fb_access_token = get_facebook_access_token();
    $url = "https://graph.facebook.com/v3.3/".$pagename."?access_token=".$fb_access_token["access_token"];
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $ret["url"] =$url;
    if($obj->id === NULL)
    {
        $ret["error"] = 1;
        return $ret;
    }
    $ret["page_id"] =$obj->id;
    $ret["error"] = 0;
    return $ret;
}

function get_instagram_media($uid,$last_post_id = NULL)
{
    global $instagram_recent_media;
    $ig_access_token = get_instagram_access_token($uid);
    if($last_post_id === NULL)
    {
        $url = $instagram_recent_media.$ig_access_token;
    }
    else
    {
        $url = $instagram_recent_media.$ig_access_token."&max_id=".$last_post_id;
    }
    $json = file_get_contents($url);
    $obj = json_decode($json);
    if(!$json)
    {
        $ret["error"] = 2;
        return $ret;
    }
    $ret["media"] = $obj->data;
    $ret["error"] = 0;
    return $ret;
}

function get_instagram_nome_utente($uid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT instagram_pagina FROM user WHERE uid = '$uid'");
    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    preg_match('/http[s]*:\/\/[^\/]+(\/.+)/', $row["instagram_pagina"], $ret);
    $nome_utente = str_replace("/", "", $ret[1]);
    return $nome_utente;
}

function get_stato_facebook($uid)
{
    global $db;
    $error = get_page_id($uid)["error"];
    $sql = mysqli_query($db, "SELECT sid,nome,messaggio,colore FROM stato_facebook WHERE eid = '$error'");
    $row = mysqli_fetch_array($sql);
    $ret["sid"] = $row["sid"];
    $ret["nome"] = $row["nome"];
    $ret["messaggio"] = $row["messaggio"];
    $ret["colore"] = $row["colore"];
    $ret["error"] = $error;
    return $ret;
}

function get_stato_instagram($uid)
{
    global $db;
    global $instagram_token_request_link;
    global $redirect_url;

    $ig_client_id = get_instagram_client_id($uid);
    $error = get_instagram_media($uid)["error"];
    $sql = mysqli_query($db, "SELECT sid,nome,messaggio,colore FROM stato_instagram WHERE eid = '$error'");
    $row = mysqli_fetch_array($sql);
    $ret["sid"] = $row["sid"];
    $ret["nome"] = $row["nome"];
    if(!strlen($ig_client_id) || $error)
    {
        $ig_link = $instagram_token_request_link.$ig_client_id."&redirect_uri=".$redirect_url."&response_type=token";
        $utente_instagram = get_instagram_nome_utente($uid);
        $row["messaggio"] = str_replace("%instagram%", $utente_instagram, $row["messaggio"]);
        $row["messaggio"] = str_replace("%link%", $ig_link, $row["messaggio"]);
    }
    $ret["messaggio"] = $row["messaggio"];
    $ret["colore"] = $row["colore"];
    $ret["error"] = $error;
    return $ret;
}

function set_facebook_access_token($access_token)
{
    global $db;
    $sql = mysqli_query($db, "SELECT aid,access_token FROM facebook_token");

    if(!mysqli_num_rows($sql)){
        mysqli_query($db, "INSERT INTO facebook_token (access_token) VALUES ('$access_token')");
        return 0;
    }
    $row = mysqli_fetch_array($sql);
    $aid = $row["aid"];
    mysqli_query($db, "UPDATE facebook_token SET access_token = '$access_token' WHERE aid = '$aid'");
    return 0;
}

function set_instagram_access_token($uid,$access_token)
{
    global $db;
    mysqli_query($db, "UPDATE user SET instagram_token = '$access_token' WHERE uid = '$uid'");
    return 0;
}

function set_instagram_client_id($uid,$client_id)
{
    global $db;
    mysqli_query($db, "UPDATE user SET instagram_client_id = '$client_id' WHERE uid = '$uid'");
    return 0;
}
