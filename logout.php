<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location: " . $logout_redirect); 
    exit;
?>
