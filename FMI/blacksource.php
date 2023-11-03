<?php

set_time_limit(0);
error_reporting(0);







$imei = $_GET['imei'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://myaccount.skyprotect.com/wcs/resources/store/11151/1.0/imei');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"IMEINumber\":\"$imei\"}");
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Origin: https://www.skyprotect.com';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
echo $result;
//echo "<b>IMEI</b>: $imei".'<div>';
    $arr = json_decode($result,true);

if($arr['errMessage'] === 'Unable to determine make and model for IMEI'){

echo '<div>Blacklist GSMA: <font color="red"> Reported as Lost/Stolen</font><div>';
}else{
echo '<div>Blacklist GSMA: <font color="green"> Clean</font><div>';

}
    //echo '<b>Model</b>: '.$arr['makes']['0']['models']['1']['name'].'<div>';
   // echo '<b>DESCRIPTION</b>: '.$arr['makes']['0']['models']['1']['storage'].'';
   // echo ' '.$arr['makes']['0']['models']['1']['colour'].'<div>';




?>