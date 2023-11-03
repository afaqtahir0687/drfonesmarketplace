<?php
set_time_limit(0);
error_reporting(0); 
//require_once('mod.php');

$cookie = '';
$im = $_GET['imei']; 


echo "i am here";
$url = "https://www.t-mobile.com/flex/api/access_token";
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 400);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $res = curl_exec($ch);
echo $res;
// echo '</br>';
  $arr = json_decode($res,true);

 $token = $arr['access_token'];
  echo $token;

$cookie = '';

$headers = array(
    'Accept: application/json, text/plain, */*',
           'Authorization:  '.$token,

    'Origin: https://www.t-mobile.com',
    'Referer: https://www.t-mobile.com/resources/bring-your-own-phone',
    'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'
);

$im = $_GET['imei'];

$url = "https://join.t-mobile.com/api/get_byod_check?imeiNumber=$im";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$res = curl_exec ($ch);
$cookie = strstr($res,'PHPSESSID=');
$cookie = substr($cookie, 10);
$cookie = strstr($cookie,'PHPSESSID=');
$cookie = strstr($cookie,' path',true);

$url = "https://join.t-mobile.com/api/get_byod_check?imeiNumber=$im";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
// curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$res = curl_exec ($ch);
 echo $res;
 $arr = json_decode($res,true);



if($arr['0']['IMEI']){

    echo 'IMEI: '.$arr['0']['IMEI'].'<div>';
    echo 'Model: '.$arr['0']['MarketingName'].'<div>';
    echo 'Manufacturer: '.$arr['0']['Manufacturer'].'<div>';


                    
                          }

if($arr['0']['Unlocked'] === false){
echo "Sim-Lock:  <font color='red'> Locked</font><div>";

 }  
  
 else
 
 
if($arr['0']['Unlocked'] === true){
echo "Sim-lock:<font style='color:green;'>  Unlocked</font><div>";


}


if($arr['0']['FullyPaidOff'] === true){
              
echo "Financial Contract: <font color='green'>Out of Contract</font><div>"; 
   
}else


if($arr['0']['FullyPaidOff'] === false){
              
echo "Financial Contract: <font color='red'>Unpaid Balance</font><div>"; 
   
     }
























else{

echo "GSMA Network: <font color='green'> Clean</font><div>"; 
exit;
            
        }










?>



