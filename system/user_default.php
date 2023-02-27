<?php

$title = "CRM";

$db_name = "kernelpanic_db_manage";
$db_host = "localhost";
$db_usr = "kp_dbusr";
$db_psw = "Oi0y4x8#";

$root_folder = "/tracker/";
$login_uri = $root_folder."login.php";
$restricted_area = $root_folder."login.php";
$login_redirect = $root_folder."index.php";
$logout_redirect = $root_folder."login.php";
$unauthorized_redirect = $root_folder."401.php";

$copyright_footer = 'Copyright © 2019 <a href="https://manage.kernelpanic.codes" target="_blank">kernelpanic.codes</a>. All rights reserved.';

$site_uri = "http://manage.kernelpanic.codes";
$login_global_uri = $site_uri."login.php";
$logo_global_url = $site_uri."style/images/logo.png";
$logo = "./style/images/logo.png";
$logo_quadrato = "./style/images/logo_sq.jpg";
$regex_email = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/';
$no_reply_email = "noreply@kernelpanic.codes";
$mail_assistenza = "mic.ibba@gmail.com";
$telefono_assistenza = "3408538104";

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'From: '.$title.' <'.$no_reply_email.'>';
//$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
//$headers[] = 'Cc: birthdayarchive@example.com';
//$headers[] = 'Bcc: birthdaycheck@example.com';

$days[0] = "Monday";
$days[1] = "Tuesday";
$days[2] = "Wednesday";
$days[3] = "Thursday";
$days[4] = "Friday";
$days[5] = "Saturday";
$days[6] = "Sunday";
