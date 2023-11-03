<?php
error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);
error_reporting(0); 

$imei = $_GET['imei'];
$cookie = '';
$headers = array(   
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'Content-Type: application/json',
    'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
    'cookie: __stripe_mid=29c7f3b9-3ba6-46c2-ba09-19ea7a02a972f6a1f2; auth.strategy=local; __stripe_sid=8c2c8093-22b1-4a4c-8b30-1b2e441227abc9dabb; auth._refresh_token.local=false; XSRF-TOKEN=eyJpdiI6Im1ZOHErUFlmTGN0bld4UjVsM1g0eGc9PSIsInZhbHVlIjoibkdlK2VrRXdDeGlTNGxyK2JLOUg0MWlVbnNZUWdXUjFiM25RejRqY1k0MWhTRGJBWGw1ejFTUEc5ZEJNVG9PeGJ4UnFZaXRtVlVwbzNwaDNBQzM2aDRINTluNGF1M3E2TmF2dXZnb2NScGNUMWlkNFBkT1k3djRYTWUyZFd6ZmwiLCJtYWMiOiI5OTcyNTc5NTk3MTllY2IxZjQ4YjhlYmNmODdmOTQwNzVjMjE4ZDBlMzBjNGZkMDBhMzU5YTYyYzhmODA0M2VmIiwidGFnIjoiIn0=; fonefix_session=eyJpdiI6Ilhqd05DbU1WVjZLTjF0M3hYNjJFZEE9PSIsInZhbHVlIjoiRThVWWI2RlZzVW42blQ1Ykc0dTlpQUdtSjQxZ3ROWTZIbENyMFdVRTh2bVA5THV0VzZpSDU5eXByR0cxa1VDd2t3S3VwQis3TUZDU1lkU2YramZhWEhYWDNtTlVJZTFiaHEwV1JMZVQzREc3bWFtcEx2S0FhdDgra3VoSEwxTE4iLCJtYWMiOiI3ODk1ZjlkMTlhOWY5YmI3YmI5MDJmYjkzOTdmOTQxZDAzODIwZDNmZjBjZDU3NGEzZWZiZjU5OGM4ZDliZjU5IiwidGFnIjoiIn0=; auth._token.local=Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZvbmVmaXguY28ubnovYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE2NzQxMzc3NTMsImV4cCI6MTY3NDIyNDE1MywibmJmIjoxNjc0MTM3NzUzLCJqdGkiOiIzb21UUXN2bWNVUEk3bXcxIiwic3ViIjoiNDY4NCIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.uxJlU0_3xVI2GU0ONBoM6qiEw-BSQ0GwP6iMZD9i6JE'
);
$url = "https://fonefix.co.nz/api/v1/gsx/repairs/$imei/eligibility";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
// curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$result = curl_exec($ch);
$res = curl_exec ($ch);
$cookie = strstr($res,'PHPSESSID=');
$cookie = substr($cookie, 10);
$cookie = strstr($cookie,'PHPSESSID=');
$cookie = strstr($cookie,' path',true);


echo $result;
//$arr = json_decode($result,true);

//if($arr['eligibilityDetails']['outcome']['0']['reasons']['0']['messages']['0']['description'] === "Find My for this device is active. Find My must be turned off for non-accessory repairs. See OP987 for details."){

//echo "<strong><span style='color:red;'>ON</span></strong>";
  //  }
    //else
    
 //if($arr['eligibilityDetails']['outcome']['0']['reasons']['0']['messages']['0']['description'] === "Find My Device is active. Find My Device must be turned off for non-accessory repairs. See OP1395 for details."){

//echo "<strong><span style='color:red;'>ON</span></strong>";
  //  }else
    
    //if($arr['eligibilityDetails']['outcome']['0']['reasons']['0']['messages']['1']['description'] === "Find My for this device is active. Find My must be turned off for non-accessory repairs. See OP987 for details."){

//echo "<strong><span style='color:red;'>ON</span></strong>";
  //  }
    //else {
      //  echo "<strong><span style='color:green;'>OFF</span></strong>";
    //}
    
//if  ($arr['eligibilityDetails']['outcome']['0']['reasons']['0']['messages']['0']['description'] === "This serial number has already been replaced and is no longer eligible for service. See OP1514, section 2, \"Serial number issue,\" to escalate, if necessary."){


//echo "<div>Replaced Device: <strong><span style='color:red;'>Yes</span></strong>";
  //  }
   // else {
     //   echo "<div>Replaced Device: <strong><span style='color:green;'>No</span></strong>";
    //}
    
//if($arr['eligibilityDetails']['coverageDescription']){
       
  //  echo '<div>Warranty: '.$arr['eligibilityDetails']['coverageDescription'];
    
    //}
 