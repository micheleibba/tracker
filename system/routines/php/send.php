<?php

require_once 'db_connect.php';

include_once ('./system/routines/php/routines.php');
include_once ('./system/routines/php/anagrafica.php');
include_once ('./system/routines/php/lavorazioni.php');

function send_email()
{
    global $title;
    global $login_global_uri;
    global $logo_global_url;
    global $headers;
    global $mail_assistenza;
    global $telefono_assistenza;
    global $oggetto_email_task;
    global $testo_task_odierni;
    global $testo_task_scaduti;

    $subject = $oggetto_email_task;
    $ouid_lavorazioni = get_lavorazioni_groupby_ouid();
    for($i=0;$i<count($ouid_lavorazioni);$i++)
    {
        $user = $ouid_lavorazioni[$i]["operatore"];
        $nome_utente = $user["nome"];
        $to = $user["email"];//$mail_assistenza;
        $today = get_today_timestamp();
        $lavorazioni = get_lavorazioni_from_uid($user["uid"],$today,$today);
        $lavorazioni_scadute = get_lavorazioni_from_uid($user["uid"],0,$today);
        if(!count($lavorazioni) && !count($lavorazioni_scadute))
        {
            continue;
        }
        $message = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <title>'.$title.'</title>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <style type="text/css">
        html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}

                @media only screen and (min-device-width: 750px) {
                        .table750 {width: 750px !important;}
                }
                @media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
              table[class="table750"] {width: 100% !important;}
              .mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
              .mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
              .mob_left {text-align: left !important;}
              .mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
              .mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
              .mob_center {text-align: center !important;}
              .top_pad {height: 15px !important; max-height: 15px !important; min-height: 15px !important;}
              .mob_pad {width: 15px !important; max-width: 15px !important; min-width: 15px !important;}
              .mob_div {display: block !important;}
                }
           @media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
              .mod_div {display: block !important;}
           }
                .table750 {width: 750px;}
        </style>
        </head>
        <body style="margin: 0; padding: 0;">

        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f3f3f3; min-width: 350px; font-size: 1px; line-height: normal;">
                <tr>
                <td align="center" valign="top">
                        <!--[if (gte mso 9)|(IE)]>
                 <table border="0" cellspacing="0" cellpadding="0">
                 <tr><td align="center" valign="top" width="750"><![endif]-->
                        <table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #f3f3f3;">
                                <tr>
                       <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
                                        <td align="center" valign="top" style="background: #ffffff;">

                          <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                             <tr>
                                <td align="right" valign="top">
                                   <div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
                                </td>
                             </tr>
                          </table>

                          <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                             <tr>
                                <td align="left" valign="top">
                                   <div style="height: 39px; line-height: 39px; font-size: 37px;">&nbsp;</div>
                                   <a href="'.$login_global_uri.'" target="_blank" style="display: block; max-width: 250px;">
                                      <img src="'.$logo_global_url.'" alt="img" width="250" border="0" style="display: block; width: 250px;" />
                                   </a>
                                   <div style="height: 73px; line-height: 73px; font-size: 71px;">&nbsp;</div>
                                </td>
                             </tr>
                          </table>

                          <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                             <tr>
                                <td align="left" valign="top">
                                   <font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">
                                      <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 24px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">Ciao '. $nome_utente .',</span>
                                   </font>';


        if(count($lavorazioni))
        {
            $message .= '       <div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
                                <font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                      <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">
                                        '.$testo_task_odierni.'</span>
                                   </font>';

            $message .= '<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">';
            for($j=0;$j<count($lavorazioni);$j++)
            {
                $message .= '<tr>';
                $message .= '   <td align="left" valign="top"><font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                <font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                    <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">
                                        <b>&#8227; '.$lavorazioni[$j]["servizio"]["nome"].'</span></b>
                                </font>
                                </td></tr><ul>';
                for($k=0;$k<count($lavorazioni[$j]["tasks"]);$k++)
                {
                    $message .= '   <li align="left" valign="top"><font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">'
                                . ' <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">';
                    $message .= '&#9702; '.$lavorazioni[$j]["tasks"][$k]["cliente"]["nome_azienda"] . " - " . $lavorazioni[$j]["tasks"][$k]["task"]["nome"];
                    $message .= '</span></font></li>';
                }
                 $message .= '</ul>';
            }
            $message .= '</table>';
        }
        if(count($lavorazioni_scadute))
        {
            $message .= '       <div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
                                <font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                      <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">
                                        '.$testo_task_scaduti.'</span>
                                   </font>';

            $message .= '<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">';
            for($j=0;$j<count($lavorazioni_scadute);$j++)
            {
                $message .= '<tr>';
                $message .= '   <td align="left" valign="top"><font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                <font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size: 18px; line-height: 32px;">
                                    <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">
                                        <b>&#8227; '.$lavorazioni_scadute[$j]["servizio"]["nome"].'</span></b>
                                </font>
                                </td></tr><ul>';
                for($k=0;$k<count($lavorazioni_scadute[$j]["tasks"]);$k++)
                {
                    for($y=0;$y<count($lavorazioni_scadute[$j]["tasks"][$k]["todo"]);$y++)
                    {
                        if($lavorazioni_scadute[$j]["tasks"][$k]["eseguita"])
                        {
                            continue;
                        }
                    $message .= '   <li align="left" valign="top"><font face="\'Source Sans Pro\', sans-serif" color="#585858" style="font-size:18; line-height: 32px;">'
                                . ' <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 32px;">';
                    $message .= '&#9702; '.$lavorazioni_scadute[$j]["tasks"][$k]["cliente"]["nome_azienda"] . " - " . $lavorazioni_scadute[$j]["tasks"][$k]["task"]["nome"] . " - <b style='color:red'>Scaduto il: ".date("d/m/Y", $lavorazioni_scadute[$j]["tasks"][$k]["todo"][$y]["timestamp"])."</b>";
                    $message .= '</span></font></li>';
                    }
                }
                 $message .= '</ul>';
            }
            $message .= '</table>';
        }
        $message .=                '<div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
                                   <table class="mob_btn" cellpadding="0" cellspacing="0" border="0" style="background: #27cbcc; border-radius: 4px;">
                                      <tr>
                                         <td align="center" valign="top">
                                            <a href="'.$login_global_uri.'" target="_blank" style="display: block; border: 1px solid #27cbcc; border-radius: 4px; padding: 12px 23px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                               <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                                  <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Accedi ora</span>
                                               </font>
                                            </a>
                                         </td>
                                      </tr>
                                   </table>
                                   <div style="height: 75px; line-height: 75px; font-size: 73px;">&nbsp;</div>
                                </td>
                             </tr>
                          </table>
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                             <tr>
                                <td align="center" valign="top">
                                   <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
                                   <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                                      <tr>
                                         <td align="center" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="78%" style="min-width: 300px;">
                                               <tr>
                                                  <td align="center" valign="top" width="23%">
                                                     <a href="'.$login_global_uri. '" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
                                                        <font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
                                                           <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">ACCEDI AL TUO ACCOUNT</span>
                                                        </font>
                                                     </a>
                                                  </td>
                                               </tr>
                                            </table>
                                            <div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
                                            <font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 20px;">
                                               <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="mailto:'.$mail_assistenza.'" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Scrivi per ricevere assistenza</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="tel:'.$telefono_assistenza. '" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Chiama per ricevere assistenza</a> &nbsp;&nbsp;</span>
                                            </font>

                                            <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                         </td>
                                      </tr>
                                   </table>
                                </td>
                             </tr>
                          </table>

                       </td>
                       <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
                    </tr>
                 </table>
                 <!--[if (gte mso 9)|(IE)]>
                 </td></tr>
                 </table><![endif]-->
              </td>
           </tr>
        </table>
        </body>
        </html>
        ';
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
    $ret["error"] = 0;
    return $ret;
}
