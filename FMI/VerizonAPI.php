<?php

set_time_limit(0);
error_reporting(0); 

// not the best solution, but works
// in your php setting use, it helps hiding site wide notices
error_reporting(E_ALL ^ E_NOTICE);


$cookie = '';

$headers = array(
    
   'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:71.0) Gecko/20100101 Firefox/71.0',
        'Accept: application/json',
        'Accept-Language: en-US,en;q=0.5',
        'Authorization: Bearer ad42kta68LYVkKkQCJErCagDOqes',
        'Content-Type: application/json',
        'x-client-channel: Desktop'
);

$imei = $_GET['imei'];

$url = "https://api.bevisible.com/v1/device/compatibility?deviceId=$imei";
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

$url = "https://api.bevisible.com/v1/device/compatibility?deviceId=$imei";
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
$res = str_ireplace("SO","",$res);

$res = str_ireplace("SPR","Sprint",$res);
$res = str_ireplace("- Non VZW"," ",$res);
$res = str_ireplace("NON VZW"," ",$res);
$res = str_ireplace("NON"," ",$res);
$res = str_ireplace("VERIZON CDMA LESS"," ",$res);
$res = str_ireplace("000Z"," ",$res);
$res = str_ireplace("-E"," ",$res);

$res = str_ireplace("RGTM"," T-MOBILE",$res);
$res = str_ireplace("VZ"," US Verizon <br>",$res);



$arr = json_decode($res,true);


  $mod = $arr['deviceModel'];
$mod=substr($mod, -4, -1);

   //  echo    "<font face='Georgia, Arial' size='4' color='darkBlue'>$mod</font><div><br>";


$search = strpos("$mod", "T");

		if ($search !== false) {
     echo "<div><font color='red'> Verizon network device only supported! </font>";
     exit;
		}
			
 
 
 if($arr['imSku'] == ""){
     
     echo "<div><font color='red'> Verizon network device only supported! </font>";
     
  exit;
  
 }
  if($arr['imei1']){
     
     echo 'IMEI: '. $arr['imei1'];
  }
  if($arr['imei2']){
     
     echo '<div>IMEI2: '. $arr['imei2'];
  
   //echo "<div>IMEI; $imei<div>";

   echo '<div>Model: '.$arr['deviceModel'];
   echo '<div>MPN Number: '.$arr['imSku'];
  //  require_once('vereligiblity.php');

}
  if($arr['deviceModel']){

echo "<div>Country: United States";
}

 if($arr['deviceLostStolenCompatibility'] === "false"){
     
   echo "<div>Device Status:  <font color='red'>Lost/Stolen</font> ";
  }else{

     echo "<div>FinancialEligibility:  <font color='green'>Clean </font> (Eligible)";
  }

                    
 /*if($arr['message'] === "Woo hoo! We're compatible."){
     
     echo "<div>FinancialEligibility:  <font color='green'>Clean </font> (Eligible)";
  }else{

   echo "<div>Financial Eligibility:  <font color='red'>Unpaid Balance</font>  (Not Eligible)";
  }*/
 
 
 
 

 
?>