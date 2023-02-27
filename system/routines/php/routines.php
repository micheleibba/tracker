<?php

require_once 'db_connect.php';

function get_today_timestamp()
{
    return strtotime("00:00:00");
}

function is_weekend($date)
{
    return (date('N', $date) >= 6);
}

function format_timestamp($timestamp)
{
    $str = explode(" ", $timestamp);
    $date = $str[0];
    $hour = $str[1];
    $str = explode(":", $hour);
    $hour = $str[0];
    $min = $str[1];
    $str = explode("-", $date);
    $ret = $hour.":".$min." ".$str[2]."/".$str[1]."/".$str[0];
    return $ret;
}

function upload_file($file,$folder)
{
    global $root_folder;
    $ts = time();
    $tmp  = $file['tmp_name'];
    $name  = $file['name'];
    $ext = strtolower(strrchr($name, '.'));
    $name = rand(0, 500) . "_" .$ts . $ext;
    $path = $root_folder."system/files/". $folder ."/" . $name;
    move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'] . $path);
    return $path;
}

function read_csv($path,$row=null)
{
    global $gruppi_strlen;
    $ret = array();
    $i = 0;
    $count = 0;
    if(($handle = fopen($path, "r")) !== FALSE)
    {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            if($i<$row || $row === null)
            {
                $num = count($data);
                for($c=0; $c < $num; $c++)
                {

                    $ret["row"][$i]["field"][$c] = parseString($data[$c],$gruppi_strlen);
                }
            }
            $i++;
            $count++;
        }
        fclose($handle);
    }
    $ret["count"] = $count;
    return $ret;
}

function get_csv_select_fields()
{
    global $db;
    $ret = array();
    $sql = mysqli_query($db, "SELECT "
            . "sid, "
            . "nome, "
            . "valore FROM csv_select_fields ORDER BY sid");

    if(!mysqli_num_rows($sql)){
        return;
    }

    $i=0;
    while($row = mysqli_fetch_array($sql))
    {
        $ret[$i]["sid"] = $row["sid"];
        $ret[$i]["nome"] = $row["nome"];
        $ret[$i]["valore"] = $row["valore"];
        $i++;
    }
    return $ret;
}

function get_goto_azioni($slug)
{
    global $db;

    $sql = mysqli_query($db,"SELECT azione FROM goto_azioni WHERE slug='$slug' ");
    $row = mysqli_fetch_array($sql);
    $azione = $row["azione"];
    return $azione;
}

function parseString($string,$len)
{
    if(strlen($string)>$len)
    {
        $parsed = substr($string, 0, $len) . '...';
    }
    else
    {
        $parsed = $string;
    }
    return $parsed;
}

function monthNumToStr($mese)
{
    switch ($mese)
    {
            case 1:
                    $mese = "Gennaio";
                    break;
            case 2:
                    $mese = "Febbraio";
                    break;
            case 3:
                    $mese = "Marzo";
                    break;
            case 4:
                    $mese = "Aprile";
                    break;
            case 5:
                    $mese = "Maggio";
                    break;
            case 6:
                    $mese = "Giugno";
                    break;
            case 7:
                    $mese = "Luglio";
                    break;
            case 8:
                    $mese = "Agosto";
                    break;
            case 9:
                    $mese = "Settembre";
                    break;
            case 10:
                    $mese = "Ottobre";
                    break;
            case 11:
                    $mese = "Novembre";
                    break;
            case 12:
                    $mese = "Dicembre";
                    break;
    }
    return $mese;
}

function get_last_month_timestamp($month)
{
    $year = date('y');
    $day = 1;
    $last_month_timestamp = strtotime($year."-".$month."-".$day);
    return $last_month_timestamp;
}

function get_next_month_timestamp($from)
{
    $month = date("n",$from);
    $month++;
    $year = date('y');
    $day = 1;
    $next_month_timestamp = strtotime($year."-".$month."-".$day);
    return $next_month_timestamp;
}

function get_number_of_months_between_two_timestamp($from,$to)
{
    $year1 = date('Y', $from);
    $year2 = date('Y', $to);

    $month1 = date('m', $from);
    $month2 = date('m', $to);

    $diff = ((($year2 - $year1) * 12) + ($month2 - $month1))+1;

    return $diff;
}

function prevent_refresh_submit($error)
{
    global $_SERVER;
    if(!$error)
    {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
}
