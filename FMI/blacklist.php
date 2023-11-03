<?php
$im = $_GET['imei'];
$url = "https://my.xploremobile.ca/MobileCommunity/services/apexrest/xploremobile?f=getHandsetByIMEI&p=$im";
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


 $mod =  $arr['sKU'];

    
 $mod= substr($mod, 0, -8);

$search = strpos("$mod", "M");

		if ($search !== false) {
	echo		$mod = '<div> Network GSMA: <span style="color:red;"> Blacklisted</span>' ;
		}else {
	echo		$mod = '<div> Network GSMA: <span style="color:green;"> Clean</span>' ;
		}




 




?>

