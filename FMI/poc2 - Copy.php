<?php

set_time_limit(0);
error_reporting(0); 
$imei = $_GET['imei'];
$meid=substr($imei, 0, -1);
echo "Going to make request";


$cookie = '';

$headers = array(
    
   'Host: www.sfonenow.com',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:78.0) Gecko/20100101 Firefox/78.0',
'Accept: */*',
'Accept-Language: en-US,en;q=0.5',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'H1234511hBBQ: 4f83f44c70632f91681e9694',
'pshchoCin2225: 4491777b1aa8b5b32c2e8666dbe1a495',
'X-Requested-With: XMLHttpRequest',
'Content-Length: 75',
'Origin: https://www.sfonenow.com',
'Connection: keep-alive',
'Referer: https://www.sfonenow.com/BYOD.php',
'Cookie: __cfduid=d7dcd9f48752c09c385c66bd495b971591594315261; _ga=GA1.2.1976418361.1594315280; PHPSESSID=ak2h642o570v8rkbcachhvoq46; _gid=GA1.2.809855670.1595656339',
);



$url = "https://www.sfonenow.com/ajaxfiles/apiajax.php?esn=$imei&carrier=SPR&device_type=CDMA&imei=&action=validate_byod";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); //could be empty, but causeproblems on some hosts
curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp'); //could be empty, but cause problems on some hosts
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$res = curl_exec ($ch);
$cookie = strstr($res,'PHPSESSID=');
$cookie = substr($cookie, 10);
$cookie = strstr($cookie,'PHPSESSID=');
$cookie = strstr($cookie,' path',true);
//echo $res;

$url = "https://www.sfonenow.com/ajaxfiles/apiajax.php";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
// curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "esn=$imei&carrier=SPR&device_type=CDMA&imei=&action=validate_byod");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt ($ch, CURLOPT_COOKIE, cookie.txt);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$result = curl_exec ($ch);
echo $result;
/*$arr = json_decode($result,true);

if($arr['errors']['0'] === "DEVICE_WITH_INCOMPATIBLE_ACTIVATION_POLICY: Device has incompatible activation policy"){
     
 
                echo '<font style="color:red;"> Not Sprint Device.</font>';
                exit;
 
   }
 


if($arr['data']['devicefedmetind'] === ""){
     
 
                echo '<font style="color:red;"> Invalid Request or device not Supported.</font>';
                exit;

   }
 


if($arr['data']['model_number']){
     
   echo 'IMEI: '.$arr['data']['esn'];
      echo '<div>Model Number: '.$arr['data']['model_number'];

   echo '<div>Description: '.$arr['data']['model_name'];



   }
   
   
   if($arr['data']['pocswapind'] === "false"){
     

               echo '<div>Poc Swap:  <font style="color:red;"> False</font>';
 
   }
   
   
   if($arr['data']['pocswapind'] === "true"){
     

               echo '<div>Poc Swap:  <font style="color:green;"> True</font>';
 
   }
   
if($arr['data']['uicc_sku']){
     

   echo '<div>Uicc_Sku: '.$arr['data']['uicc_sku'];
 
   }
   


 if($arr['data']['activation_status'] === "N"){
     
               echo '<div>Activation Status:  <font style="color:red;"> Not Activated</font>';

       // echo "IMEI: $imei<div>Meid: $meid<div>Model: $mod<div>";
 
   }
   
  if($arr['data']['activation_status'] === "Y"){
     
               echo '<div>Activation Status:  <font style="color:green;"> Activated</font>';

       // echo "IMEI: $imei<div>Meid: $meid<div>Model: $mod<div>";
 
   } 
   
   
   
  
if($arr['data']['devicefedmetind'] === "false"){
     

               echo '<div>Contract Status:  <font style="color:red;"> Pending Balance</font>';
 
   }

if($arr['data']['devicefedmetind'] === "true"){
     
               echo '<div>Contract Status:   Out of Contract (<font style="color:green;">Eligible</font>)';
 
   }

 if($arr['data']['validation_message'] === "Device is either STOLEN or LOST"){
     
 
                echo '<div>Device Status: <font style="color:red;"> Lost/Stolen</font>)';

   }
  


if($arr['data']['validation_message'] === "Device is FRAUDULENT"){
     
 
                echo '<div>Device Status<font style="color:red;"> Lost/Stolen</font>)';

   }

 
 if($arr['data']['imsi']){
     
   echo '<div>IMSI: '.$arr['data']['imsi'];
    


   }
 
 if($arr['data']['esnmeidhex']){
     
       echo '<div>ESN Hex: '.$arr['data']['esnmeidhex'];



   }
 
 
 if($arr['data']['esn2']){
     
  
    echo '<div>ESN: '.$arr['data']['esn2'];


   }
 
 if($arr['data']['iccid']){
     
  
        echo '<div>ICCID: '.$arr['data']['iccid'];


   }
 if($arr['data']['validation_message'] === "Phone owner account ID mismatch FED not met"){
     

               echo '<div>Account Status:   <font style="color:red;">Phone owner account ID mismatch FED not met</font>)';
 
   }
   
 
 if($arr['data']['ownership'] === "INVALID_FIN_ELIGIBILITY_DATE: Device is not in good financial standing"){
     

               echo '<div>Device Standing:   (Device is not in good financial standing</font>)';
 
   }
   
 
 
 if($arr['data']['validation_message'] === "Device IMEI is on the industry blacklist"){
     
 
                echo '<div>Device Status<font style="color:red;">Blacklisted</font>)';

   }*/
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
?>