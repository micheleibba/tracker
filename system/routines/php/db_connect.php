<?php

$db = mysqli_connect($db_host, $db_usr, $db_psw, $db_name);
/* check connection */
if (mysqli_connect_errno())
{
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit();
}
