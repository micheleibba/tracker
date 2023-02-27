<?php

require_once 'db_connect.php';

function get_autorizzazione_from_path($tid,$path)
{
    global $db;
    $sql = mysqli_query($db, "SELECT COUNT(*) as total FROM rel_sitemap_user_type WHERE smid IN "
            . "(SELECT smid FROM sitemap WHERE path = '$path') AND tid = '$tid'");
    $row = mysqli_fetch_array($sql);
    $tot = $row['total'];
    if($tot)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_user_from_uid($uid)
{
    global $db;

    $sql = mysqli_query($db, "SELECT "
            . "tid, "
            . "nome, "
            . "cognome, "
            . "email, "
            . "cellulare, "
            . "nome_azienda, "
            . "ragione_sociale, "
            . "indirizzo, "
            . "piva, "
            . "facebook_pagina, "
            . "instagram_pagina, "
            . "instagram_token, "
            . "instagram_client_id, "
            . "timestamp FROM user WHERE uid = '$uid' ");

    if(!mysqli_num_rows($sql)){
        return;

    }
    $row = mysqli_fetch_array($sql);
    $ret["uid"] = $uid;
    $ret["tid"] = $row["tid"];
    $ret["nome"] = $row["nome"];
    $ret["cognome"] = $row["cognome"];
    $ret["email"] = $row["email"];
    $ret["cellulare"] = $row["cellulare"];
    $ret["nome_azienda"] = $row["nome_azienda"];
    $ret["ragione_sociale"] = $row["ragione_sociale"];
    $ret["indirizzo"] = $row["indirizzo"];
    $ret["piva"] = $row["piva"];
    $ret["facebook_pagina"] = $row["facebook_pagina"];
    $ret["instagram_pagina"] = $row["instagram_pagina"];
    $ret["instagram_token"] = $row["instagram_token"];
    $ret["instagram_client_id"] = $row["instagram_client_id"];
    $ret["timestamp"] = $row["timestamp"];
    return $ret;
}

function get_tid_from_uid($uid)
{
    global $db;

    $sql = mysqli_query($db, "SELECT tid FROM user WHERE uid = '$uid' ");

    if(!mysqli_num_rows($sql)){
        return;

    }
    $row = mysqli_fetch_array($sql);
    return $row["tid"];
}

function get_utenti_from_tid($tid)
{
    global $db;

    $sql = mysqli_query($db, "SELECT "
            . "uid, "
            . "nome, "
            . "cognome, "
            . "email, "
            . "cellulare, "
            . "nome_azienda, "
            . "ragione_sociale, "
            . "indirizzo, "
            . "piva, "
            . "facebook_pagina, "
            . "instagram_pagina, "
            . "instagram_client_id, "
            . "timestamp FROM user WHERE tid='$tid' ORDER BY nome_azienda");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["uid"] = $row["uid"];
        $ret[$i]["nome"] = $row["nome"];
        $ret[$i]["cognome"] = $row["cognome"];
        $ret[$i]["email"] = $row["email"];
        $ret[$i]["cellulare"] = $row["cellulare"];
        $ret[$i]["nome_azienda"] = $row["nome_azienda"];
        $ret[$i]["ragione_sociale"] = $row["ragione_sociale"];
        $ret[$i]["indirizzo"] = $row["indirizzo"];
        $ret[$i]["piva"] = $row["piva"];
        $ret[$i]["facebook_pagina"] = $row["facebook_pagina"];
        $ret[$i]["instagram_pagina"] = $row["instagram_pagina"];
        $ret[$i]["instagram_client_id"] = $row["instagram_client_id"];
        $ret[$i]["timestamp"] = $row["timestamp"];
        $i++;
    }
    return $ret;
}

function get_login_from_uid($uid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT username,password FROM login WHERE uid='$uid'");
    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["username"] = $row["username"];
    $ret["password"] = $row["password"];
    return $ret;
}

function get_operatori_groupby_user_type()
{
    global $db;
    $user_types = get_user_types();
    $i=0;
    for($j=0;$j<count($user_types);$j++)
    {
        $tid = $user_types[$j]["tid"];
        $sql = mysqli_query($db, "SELECT "
                . "uid, "
                . "tid, "
                . "nome, "
                . "cognome, "
                . "email, "
                . "cellulare "
                . " FROM user WHERE tid = '$tid' ORDER BY nome");

        while($row = mysqli_fetch_array($sql))
        {
            $ret[$i]["uid"] = $row["uid"];
            $ret[$i]["tid"] = $row["tid"];
            $ret[$i]["ruolo"] = $user_types[$j]["name"];
            $ret[$i]["nome"] = $row["nome"];
            $ret[$i]["cognome"] = $row["cognome"];
            $ret[$i]["email"] = $row["email"];
            $ret[$i]["cellulare"] = $row["cellulare"];
            $login = get_login_from_uid($row["uid"]);
            $ret[$i]["username"] = $login["username"];
            $ret[$i]["password"] = $login["password"];
            $i++;
        }
    }
    return $ret;
}

function get_operatori()
{
    global $db;
    $sql = mysqli_query($db, "SELECT "
            . "uid, "
            . "tid, "
            . "nome, "
            . "cognome, "
            . "email, "
            . "cellulare "
            . " FROM user ORDER BY nome");
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["uid"] = $row["uid"];
        $ret[$i]["tid"] = $row["tid"];
        $ret[$i]["nome"] = $row["nome"];
        $ret[$i]["cognome"] = $row["cognome"];
        $ret[$i]["email"] = $row["email"];
        $ret[$i]["cellulare"] = $row["cellulare"];
        $login = get_login_from_uid($row["uid"]);
        $ret[$i]["username"] = $login["username"];
        $ret[$i]["password"] = $login["password"];
        $i++;
    }
    return $ret;
}



function get_utenti()
{
    global $db;

    $sql = mysqli_query($db, "SELECT "
            . "uid, "
            . "tid, "
            . "nome, "
            . "cognome, "
            . "email, "
            . "cellulare, "
            . "nome_azienda, "
            . "ragione_sociale, "
            . "indirizzo, "
            . "piva, "
            . "facebook_pagina, "
            . "instagram_pagina, "
            . "instagram_client_id, "
            . "timestamp FROM user ORDER BY nome");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["uid"] = $row["uid"];
        $ret[$i]["tid"] = $row["tid"];
        $ret[$i]["nome"] = $row["nome"];
        $ret[$i]["cognome"] = $row["cognome"];
        $ret[$i]["email"] = $row["email"];
        $ret[$i]["cellulare"] = $row["cellulare"];
        $ret[$i]["nome_azienda"] = $row["nome_azienda"];
        $ret[$i]["ragione_sociale"] = $row["ragione_sociale"];
        $ret[$i]["indirizzo"] = $row["indirizzo"];
        $ret[$i]["piva"] = $row["piva"];
        $ret[$i]["facebook_pagina"] = $row["facebook_pagina"];
        $ret[$i]["instagram_pagina"] = $row["instagram_pagina"];
        $ret[$i]["instagram_client_id"] = $row["instagram_client_id"];
        $ret[$i]["timestamp"] = $row["timestamp"];
        $i++;
    }
    return $ret;
}

function get_utente_tid($uid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT tid FROM user WHERE uid='$uid'");
    if(!mysqli_num_rows($sql)){
        return;
    }

    $row = mysqli_fetch_array($sql);
    $ret["tid"] = $row["tid"];
    return $ret["tid"];
}

function get_tid_from_slug($slug)
{
    global $db;
    $sql = mysqli_query($db, "SELECT tid FROM user_type WHERE table_name='$slug'");
    if(!mysqli_num_rows($sql))
    {
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["tid"] = $row["tid"];
    return $ret["tid"];
}

function aggiungi_utente($dati,$tid)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nome = $dati["nome"];
        $cognome = $dati["cognome"];
        $email = $dati["email"];
        $cellulare = $dati["cellulare"];
        mysqli_query($db, "INSERT INTO user (tid,nome,cognome,email,cellulare) VALUES ('$tid','$nome','$cognome','$email','$cellulare')");
        $uid = mysqli_insert_id($db);
        $username = $dati["username"];
        $password = $dati["password"];
        $sql = mysqli_query($db,"SELECT COUNT(*) as total FROM login WHERE username='$username' ");
        $row = mysqli_fetch_array($sql);
        $tot = $row['total'];
        if($tot)
        {
            $ret["error"] = 2;
            return $ret;
        }
        mysqli_query($db, "INSERT INTO login (uid,username,password) VALUES ('$uid','$username','$password')");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function aggiorna_cliente($uid,$dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nome = $dati["nome"];
        $cognome = $dati["cognome"];
        $email = $dati["email"];
        $cellulare = $dati["cellulare"];
        $nome_azienda = $dati["nome_azienda"];
        $ragione_sociale = $dati["ragione_sociale"];
        $indirizzo = $dati["indirizzo"];
        $piva = $dati["piva"];
        $facebook_pagina = $dati["facebook_pagina"];
        $instagram_pagina = $dati["instagram_pagina"];
        $instagram_client_id = $dati["instagram_client_id"];

        mysqli_query($db, "UPDATE user SET "
                . "nome = '$nome', "
                . "cognome = '$cognome', "
                . "email = '$email', "
                . "cellulare = '$cellulare', "
                . "nome_azienda = '$nome_azienda', "
                . "ragione_sociale = '$ragione_sociale', "
                . "indirizzo = '$indirizzo', "
                . "piva = '$piva', "
                . "facebook_pagina = '$facebook_pagina', "
                . "instagram_pagina = '$instagram_pagina', "
                . "instagram_client_id = '$instagram_client_id' "
                . "WHERE uid = '$uid'");
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function aggiorna_utente($dati)
{
    global $db;
    $tid = $dati["tid"];
    $uid = $dati["uid"];
    $nome = $dati["nome"];
    $cognome = $dati["cognome"];
    $email = $dati["email"];
    $cellulare = $dati["cellulare"];
    $username = $dati["username"];
    $password = $dati["password"];

    $sql = mysqli_query($db,"SELECT COUNT(*) as total FROM login WHERE uid <> '$uid' AND username='$email' ");
    $row = mysqli_fetch_array($sql);
    $tot = $row['total'];
    if($tot)
    {
        $ret["error"] = 1;
        return $ret;
    }
    mysqli_query($db, "UPDATE user SET tid= '$tid', nome = '$nome', cognome = '$cognome', email = '$email', cellulare = '$cellulare' WHERE uid = '$uid'");
    if($password !=="")
    {
        mysqli_query($db, "UPDATE login SET username = '$username', password = '$password' WHERE uid = '$uid'");
    }
    else
    {
        mysqli_query($db, "UPDATE login SET username = '$username' WHERE uid = '$uid'");
    }
    $ret["error"] = 0;
    return $ret;
}

function cancella_utente($uid)
{
    global $db;
    mysqli_query($db, "DELETE FROM user WHERE uid = '$uid'");
    mysqli_query($db, "DELETE FROM login WHERE uid = '$uid'");
}

function cancella_cliente($uid)
{
    global $db;
    mysqli_query($db, "DELETE FROM user WHERE uid = '$uid'");
}

function get_user_types()
{
    global $db;

    $sql = mysqli_query($db, "SELECT "
            . "tid, "
            . "name, "
            . "table_name "
            . "FROM user_type ORDER BY name");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["tid"] = $row["tid"];
        $ret[$i]["name"] = $row["name"];
        $ret[$i]["table_name"] = $row["table_name"];
        $i++;
    }
    return $ret;
}

function get_menu_from_from_tid($tid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT mid FROM rel_menu_user_type WHERE tid = '$tid'");

    if(!mysqli_num_rows($sql)){
        return;
    }
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["mid"] = $row["mid"];
        $i++;
    }
    return $ret;
}

function get_sitemap_from_from_tid($tid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT smid FROM rel_sitemap_user_type WHERE tid = '$tid'");

    if(!mysqli_num_rows($sql)){
        return;
    }
    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["smid"] = $row["smid"];
        $i++;
    }
    return $ret;
}

function get_user_type_from_tid($tid)
{
    global $db;
    $sql = mysqli_query($db, "SELECT "
            . "tid, "
            . "name, "
            . "table_name "
            . "FROM user_type WHERE tid='$tid' ");

    if(!mysqli_num_rows($sql)){
        return;
    }
    $row = mysqli_fetch_array($sql);
    $ret["tid"] = $row["tid"];
    $ret["name"] = $row["name"];
    $ret["table_name"] = $row["table_name"];
    $ret["mids"] = get_menu_from_from_tid($tid);
    $ret["smids"] = get_sitemap_from_from_tid($tid);
    return $ret;
}

function save_user_type($dati)
{
    global $db;
    global $_SERVER;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && $dati["ruolo"] !== "")
    {
        $ruolo = $dati["ruolo"];
        $slug = preg_replace('/\s*/', '', $ruolo);
        $slug = strtolower($slug);
        mysqli_query($db, "INSERT INTO user_type (name,table_name) VALUES ('$ruolo','$slug')");
        $tid = mysqli_insert_id($db);
        foreach($dati['mids'] as $mid)
        {
            mysqli_query($db, "INSERT INTO rel_menu_user_type (mid,tid) VALUES ('$mid','$tid')");
        }
        foreach($dati['smids'] as $smid)
        {
            mysqli_query($db, "INSERT INTO rel_sitemap_user_type (smid,tid) VALUES ('$smid','$tid')");
        }
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function edit_user_type($dati)
{
    global $db;
    global $_SERVER;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $tid = $dati["tid"];
        $ruolo = $dati["ruolo"];
        $slug = preg_replace('/\s*/','',$ruolo);
        $slug = strtolower($slug);
        mysqli_query($db, "UPDATE user_type SET "
                . "name='$ruolo',"
                . "table_name='$slug' "
                . "WHERE tid='$tid'");
        mysqli_query($db, "DELETE FROM rel_menu_user_type WHERE tid = '$tid'");
        mysqli_query($db, "DELETE FROM rel_sitemap_user_type WHERE tid = '$tid'");
        foreach($dati['mids'] as $mid)
        {
            mysqli_query($db, "INSERT INTO rel_menu_user_type (mid,tid) VALUES ('$mid','$tid')");
        }
        foreach($dati['smids'] as $smid)
        {
            mysqli_query($db, "INSERT INTO rel_sitemap_user_type (smid,tid) VALUES ('$smid','$tid')");
        }
        $ret["error"] = 0;
        return $ret;
    }
    else
    {
        $ret["error"] = 1;
        return $ret;
    }
}

function delete_user_type($tid)
{
    global $db;
    mysqli_query($db, "DELETE FROM user_type WHERE tid = '$tid'");
    mysqli_query($db, "DELETE FROM rel_menu_user_type WHERE tid = '$tid'");
    mysqli_query($db, "DELETE FROM rel_sitemap_user_type WHERE tid = '$tid'");
}
