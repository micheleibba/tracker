<?php

require_once 'db_connect.php';

ob_start();
session_start();

$loggedin = isset($_SESSION['login']);
if(isset($_SESSION['uid'])){$uid = $_SESSION['uid'];}

//log_bootstrap($_POST);

function log_bootstrap($array = NULL)
{
    global $_SESSION;
    global $_SERVER;
    global $loggedin;
    global $login_uri;
    global $restricted_area;
    global $login_redirect;
    global $unauthorized_redirect;
    global $db;
    global $uid;
    if(isset($array["action"]) && $array["action"] == "login")
    {
        $username = $array['username'];
        $password = $array['password'];
        //$password = md5($array['password']);
        $sql = mysqli_query($db,"SELECT COUNT(*) as total FROM login WHERE username='$username' AND password='$password' ");
        $row = mysqli_fetch_array($sql);
        $tot = $row['total'];
        if($tot)
        {
            $uid_sql = mysqli_query($db,"SELECT uid FROM login WHERE username='$username' AND password='$password' ");
            $uid_row = mysqli_fetch_array($uid_sql);
            $uid = $uid_row['uid'];
            $_SESSION['login'] = 1;
            $_SESSION['uid'] = $uid;
        }
    }

    $loggedin = isset($_SESSION['login']);

    if(!$loggedin && $_SERVER["REQUEST_URI"] !== $login_uri)
    {
        header("Location: " . $restricted_area);
    }
    elseif($loggedin && $_SERVER["REQUEST_URI"] === $login_uri)
    {
        header("Location: " . $login_redirect);
    }
    elseif($loggedin)
    {
        $tid = get_tid_from_uid($uid);
        $uri = strtok($_SERVER["REQUEST_URI"],'?');
        $authorized = get_autorizzazione_from_path($tid,$uri);
        if($authorized === false)
        {
            //header("Location: " . $unauthorized_redirect);
        }
    }
}

?>
