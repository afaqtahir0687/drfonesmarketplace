<?php
error_reporting(E_ALL);
$im = $_GET['imei'];
$url = "https://buscador-imei.enacom.gob.ar/imei.json?imei=$im";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_COOKIESESSION, true);
curl_setopt ($ch, CURLOPT_REFERER, $url);
$res = curl_exec ($ch);


 $arr = json_decode($res,true);
   if($arr['codigo']=== 'GSMA02'){
       
       echo 'Network GSMA:<span style="color:green;"> Clean</span>';
       
   }else
       
       if($arr['codigo']=== 'GSMA01'){
       
     echo 'Detected as : <span style="color:red;"> Lost or Stolen</span>';   
       
       }else  {
           
           return false;
       }

?>