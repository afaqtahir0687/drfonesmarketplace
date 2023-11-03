<?php
error_reporting(0);
$imei = isset($_GET["imei"]) ? trim($_GET['imei']) : '';
if(!empty($imei))
{
  $url = "https://api-staging.wingalpha.com/api/att/device_eligibility/?device_id=$imei&format=json";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 400);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $res = curl_exec($ch);
  $meid=substr($imei, 0, -1);

  
  echo "IMEI: $imei<div>Meid: $meid<div>" ;
  
  
    $arr = json_decode($res,true);
    
    
    
    
    
    
    
    
    
    
    
     if($arr['details']['model']){

    
    
        echo 'Model: '.$arr['details']['model'].'<div>';

   

    
     }
     
     
         require_once('blacksource.php');

     
     
}
?>