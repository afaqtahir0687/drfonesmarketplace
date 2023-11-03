<?php
define("DEBUG", false);

error_reporting(0); 
set_time_limit(0);

if(isset($_GET['imei']) && isset($_GET['sn'])) {
	$sn = $_GET['sn'];
    $imei = $_GET['imei'];
	$imei2 = @$_GET['imei2'];
	
	if(empty($imei2) == false){ $inject_imei2 = "<strong>IMEI2:</strong> $imei2<br>";  }
	
    if (validate_imei($imei) == true){
		$imsi_tt=0; $imsi_nb=0; $imsi_nm="";
		$device=checkInfo($imei);
		
		$gsmcall = simlock($imei, $sn, null, $imei2);
		if($gsmcall == "TryMeid") { $meid = substr($imei, 0, -1); }
		if(empty($meid) == false){ $inject_meid = "<strong>MEID:</strong>$meid<br>";  }

		$gsmcall = simlock($imei, $sn, $meid, $imei2);
		if($gsmcall == 'Locked' || $gsmcall == 'Unlocked') {
			foreach(IMSI_ARRAY() as $isi) {
				$carrier = simlock($imei, $sn, $meid, $imei2, $isi);	
				if($carrier=="Unlocked") {
					$labelCar .= imsiChecker($isi)."";
					$imsi_nb++;
				}
				$imsi_tt++;
			}
			
			if(($imsi_tt - $imsi_nb) == 0) {
				echo "SIMLOCK:  <span style='color:green;'>$gsmcall</span>";
			} else {
				$status = "<span style='color:red;'>LOCKED❌</span>";
				echo "SIMLOCK: <span style='color:red;'>$status</span><br>CARRIER: <span style='color:red;'>$labelCar</span>❌";
			}
		} else {
      echo $gsmcall;
      echo $inject_meid;
			//die('Something wrong :(');
		}
    } else {
        echo 'Wrong IMEI';
	}
}
    
function checkInfo($imei) {
	$url="https://m.att.com/shopmobile/wireless/byop/checkIMEI.xhr.html";
	$post_data = "_dynSessConf=23&%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.imeiNumber=$imei&_D%3A%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.imeiNumber=+&%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.BYODSource=mobile&_D%3A%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.BYODSource=+&%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.sucessUrl=%2Fshopmobile%2Fwireless%2Fbyop%2FcheckIMEI%2Fjcr%3Acontent%2Fmaincontent%2Fimeiinfo.ajax.getImeiValidationResponse.xhr.html&_D%3A%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.sucessUrl=+&%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.validateImei=&_D%3A%2Fatt%2Fecom%2Fshop%2Fview%2FValidateImeiFormHandler.validateImei=+&_DARGS=%2Fshopmobile%2Fwireless%2Fbyop%2FcheckIMEI.xhr.html";
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL , $url ); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: ".strlen($post_data)));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36 OPR/58.0.3135.127" );
	curl_setopt($ch, CURLOPT_POST , 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS , $post_data); 
	
	$xml_response = curl_exec($ch); 
	if (curl_errno($ch)) { 
		$error_message = curl_error($ch); 
		$error_no = curl_errno($ch);

		//echo "error_message: " . $error_message . "<br>";
		//echo "error_no: " . $error_no . "<br>";
	}
	curl_close($ch);	
	
	if(strpos($xml_response, "deviceTitle") !== false) { 
		$device= json_decode($xml_response);
		$device=$device->deviceTitle;
		$device=str_replace(" - ", " ", $device);
		$device=str_replace("Apple ", "", $device);
		return $device;
	} else {
		return "Not Found";
	}
}


function IMSI_ARRAY() {

     return array('2321069', '2321170', '0839012', '3104101', '3102605', '2040400', '2343303', '2341590', '2400700', '2400111', '2400885', '2720303', '2940102', '4402011', '2163011', '2080111', '3027204','3114801');
}

function imsiChecker($imsi) {
if($imsi=='2321069')
  return 'AUSTRIA 3 HUTCHISON';
else if($imsi=='2321170')
  return 'A1 MOBILKOM AUSTRIA';
else if($imsi=='0839012') 
  return 'SPRINT USA'; 
else if($imsi=='3104101')
  return 'AT&T USA';
else if($imsi=='3102605')
  return 'T-MOBILE Locked Policy USA';
else if($imsi=='2040400')
  return 'VERIZON USA'; 
else if($imsi=='2343303')
  return 'EE UK (TMOBILE/ORANGE)';
else if($imsi=='2341590')
  return 'VODAFONE UK';
else if($imsi=='2400700')
  return 'TELE2 SWEDEN';
else if($imsi=='2400111')
  return 'TELIA SWEDEN';
else if($imsi=='2400885')
  return 'TELENOR SWEDEN';
else if($imsi=='2720303') 
  return 'IRELAND METEOR';
else if($imsi=='2940102')
  return 'T-MOBILE MACEDONIA';
else if($imsi=='4402011')
  return 'SOFTBANK JAPAN';
  else if($imsi=='4540492')
  return 'SOFTBANK JAPAN DOCOMO';
  else if($imsi=='4405000')
  return 'SOFTBANK JAPAN DOCOMO';
  else if($imsi=='4402081')
  return 'SOFTBANK JAPAN DOCOMO';
  else if($imsi=='4405014')
  return 'SOFTBANK JAPAN DOCOMO';
  else if($imsi=='4167711')
return 'SOFTBANK JAPAN DOCOMO';
else if($imsi=='2163011')
  return 'T-MOBILE HUNGARY';
else if($imsi=='2080111')
  return 'ORANGE FRANCE';
else if($imsi=='3027204')
  return 'CANADA ROGERS';
else if($imsi=='2040400')
  return 'VERIZON/TRACFONE USA';
else if($imsi=='2760111') 
  return 'ALBANIAN MOBILE';
else if($imsi=='2760311') 
  return 'EAGLE MOBILE';
else if($imsi=='2760211') 
  return 'VODAFONE';
else if($imsi=='2760411') 
  return 'PLUS AL';
else if($imsi=='6030111') 
  return 'ALGETEL';
else if($imsi=='6030311') 
  return 'NEDJMA';
else if($imsi=='6030211') 
  return 'ORASCOM';
else if($imsi=='2130311') 
  return 'MOBILAND';
else if($imsi=='6310211') 
  return 'UNITEL';
else if($imsi=='3654011') 
  return 'CABL&WI';
else if($imsi=='3650511') 
  return 'MOSSEL';
else if($imsi=='3651011') 
  return 'WEBLINK';
else if($imsi=='7161003') 
  return 'CLARO';
else if($imsi=='7161003') 
  return 'COMPALA';
else if($imsi=='7223101') 
  return 'CTI';
else if($imsi=='7220104') 
  return 'MOVISTAR';
else if($imsi=='7220211') 
  return 'NEXTEL';
else if($imsi=='7222011') 
  return 'NEXTEL2';
else if($imsi=='7223411') 
  return 'TELECOM';
else if($imsi=='7220711') 
  return 'TELEFONI';
else if($imsi=='7227011') 
  return 'TELFONIC';
else if($imsi=='2830134') 
  return 'ARMENTEL';
else if($imsi=='2830434') 
  return 'KARABAKH';
else if($imsi=='2831034') 
  return 'ORANGE';
else if($imsi=='2830534') 
  return 'VIVACELL';
else if($imsi=='5050610') 
  return '3';
else if($imsi=='5050210') 
  return 'OPTUS';
else if($imsi=='5050390') 
  return 'VODAFONE';
else if($imsi=='5051570') 
  return '3GIS';
else if($imsi=='5051470') 
  return 'AAPT';
else if($imsi=='5052470') 
  return 'ADVAN';
else if($imsi=='5058870') 
  return 'LOCALSTAR';
else if($imsi=='5050870') 
  return 'ONE';
else if($imsi=='5050534') 
  return 'OZITEL';
else if($imsi=='5057170') 
  return 'TELSTRA71';
else if($imsi=='5057270') 
  return 'TELSTRA72';
else if($imsi=='5051170') 
  return 'TELSTRA11';
else if($imsi=='5050134') 
  return 'TELSTRA';
else if($imsi=='2321070') 
  return '3HUTCH';
else if($imsi=='2320170') 
  return 'A1 TELEKOM';
else if($imsi=='2321570') 
  return 'BARABL';
else if($imsi=='2321170') 
  return 'BOBA1';
else if($imsi=='2320570') 
  return 'ONEORA';
else if($imsi=='2320770') 
  return 'TELERI';
else if($imsi=='2320370') 
  return 'T-MOBI LE';
else if($imsi=='2321270') 
  return 'YESORA';
else if($imsi=='2320588') 
  return 'ORANGE';
else if($imsi=='2321069') 
  return 'THREE';
else if($imsi=='5050970') 
  return 'AIRNET';
else if($imsi=='5050434') 
  return 'DEPART';
else if($imsi=='2570434') 
  return 'BEST';
else if($imsi=='2570134') 
  return 'MDC';
else if($imsi=='2270234') 
  return 'MTS';
else if($imsi=='2061034') 
  return 'BASE';
else if($imsi=='2060534') 
  return 'GLOBUL';
else if($imsi=='2061034') 
  return 'MOBISTAR';
else if($imsi=='2060134') 
  return 'PROXIMUS';
else if($imsi=='2062050') 
  return 'ORTEL';
else if($imsi=='2840179') 
  return 'MTEL';
else if($imsi=='2840310') 
  return 'VIVACOM';
else if($imsi=='2840510') 
  return 'GLOBUL';
else if($imsi=='3026104') 
  return 'BELL610';
else if($imsi=='3101703') 
  return 'BELLPACIFIC';
else if($imsi=='3023704') 
  return 'FIDO';
else if($imsi=='3027204') 
  return 'ROGERS';
else if($imsi=='3022204') 
  return 'TELUS220';
else if($imsi=='3026600') 
  return 'MTS';
else if($imsi=='3026102') 
  return 'VIRGIN';
else if($imsi=='3113700') 
  return 'USA';
else if($imsi=='7300304') 
  return 'CLARO';
else if($imsi=='7300104') 
  return 'ENTEL';
else if($imsi=='7301004') 
  return 'ENTEL10';
else if($imsi=='7300204') 
  return 'MOVISTAR';
else if($imsi=='4600202') 
  return 'MOBILE';
else if($imsi=='4600158') 
  return 'UNICOM';
else if($imsi=='2040438') 
  return 'TELECOM CHINA';
else if($imsi=='7320014') 
  return 'COLOMTEL';
else if($imsi=='7321014') 
  return 'COMCEL';
else if($imsi=='7320024') 
  return 'EDATEL';
else if($imsi=='7321234') 
  return 'MOVISTA3';
else if($imsi=='7321024') 
  return 'MOVISTAR';
else if($imsi=='7321114') 
  return 'TIGO1';
else if($imsi=='7321034') 
  return 'TIGO3';
else if($imsi=='2190199') 
  return 'T-MOBILE';
else if($imsi=='2191065') 
  return 'VIP';
else if($imsi=='2300434') 
  return 'MOBIKOM';
else if($imsi=='2300234') 
  return 'O2TELEFH';
else if($imsi=='2309834') 
  return 'SPRAVA';
else if($imsi=='2300134') 
  return 'TMOBI';
else if($imsi=='2300334') 
  return 'VODAFONE';
else if($imsi=='2309934') 
  return 'VODAF2';
else if($imsi=='2620125') 
  return 'TM';
else if($imsi=='2382010') 
  return 'DEMARK';
else if($imsi=='2380534') 
  return 'APS';
else if($imsi=='2380734') 
  return 'BARABLU';
else if($imsi=='2380634') 
  return 'H3G';
else if($imsi=='2380632') 
  return '3';
else if($imsi=='2380241') 
  return 'TELEN';
else if($imsi=='2380334') 
  return 'MIGWAY';
else if($imsi=='2380134') 
  return 'TDC';
else if($imsi=='2381034') 
  return 'TDC2';
else if($imsi=='2387734') 
  return 'TELENOR';
else if($imsi=='2382034') 
  return 'TELIA';
else if($imsi=='2383034') 
  return 'TELIA30';
else if($imsi=='7321234') 
  return 'MOVIL';
else if($imsi=='7400234') 
  return 'ALEGRO';
else if($imsi=='7400034') 
  return 'MOVISTA';
else if($imsi=='7400134') 
  return 'PORTA';
else if($imsi=='6020111') 
  return 'MOBINIL';
else if($imsi=='6020211') 
  return 'VODAFONE';
else if($imsi=='6020311') 
  return 'ETISALAT';
else if($imsi=='7061034') 
  return 'CLARO/CTE';
else if($imsi=='7060134') 
  return 'CTE/CLARO';
else if($imsi=='7060234') 
  return 'DIGICE';
else if($imsi=='7060434') 
  return 'MOVITA';
else if($imsi=='7060334') 
  return 'TELEMO';
else if($imsi=='2480134') 
  return 'EMT';
else if($imsi=='2440311') 
  return 'NDA';
else if($imsi=='2449111') 
  return 'SONERA';
else if($imsi=='2082136') 
  return 'BOUYGUES';
else if($imsi=='2082031') 
  return 'BT';
else if($imsi=='2080189') 
  return 'ORANGE';
else if($imsi=='2082011') 
  return 'BOUYGUES20';
else if($imsi=='2082111') 
  return 'BOUYGUES21';
else if($imsi=='2088811') 
  return 'BOUYGUES88';
else if($imsi=='2080111') 
  return 'ORANGE01';
else if($imsi=='2080211') 
  return 'ORANGE02';
else if($imsi=='2081011') 
  return 'SFR10';
else if($imsi=='2081111') 
  return 'SFR11';
else if($imsi=='2081031') 
  return 'SFR';
else if($imsi=='2081003') 
  return 'SFR';
else if($imsi=='2080191') 
  return 'VIRGIN';
else if($imsi=='2620111') 
  return 'T-MOBILE';
else if($imsi=='2620208') 
  return 'VODAFONE';
else if($imsi=='2020134') 
  return 'COSMOTE';
else if($imsi=='2020934') 
  return 'QTELECOM';
else if($imsi=='2020534') 
  return 'VODAFONE';
else if($imsi=='2021034') 
  return 'WIND';
else if($imsi=='7080111') 
  return 'CLARO';
else if($imsi=='2163011') 
  return 'T-MOBILE';
else if($imsi=='2167000') 
  return 'VODAFONE';
else if($imsi=='4040211') 
  return 'AIRTEL02';
else if($imsi=='4040111') 
  return 'VODAF01';
else if($imsi=='4040511') 
  return 'VODAF05';
else if($imsi=='4044611') 
  return 'VODAF46';
else if($imsi=='2720110') 
  return 'VODAFONE';
else if($imsi=='2720211') 
  return 'O2';
else if($imsi=='2720320') 
  return 'E-MOBILE';
else if($imsi=='2720303') 
  return 'METEOR';
else if($imsi=='2720500') 
  return '3';
else if($imsi=='2229834') 
  return 'BLU';
else if($imsi=='2220234') 
  return 'ELSACOM';
else if($imsi=='2229934') 
  return 'H3G';
else if($imsi=='2227734') 
  return 'IPSE';
else if($imsi=='2220134') 
  return 'TELECOM';
else if($imsi=='2220134') 
  return 'TIM';
else if($imsi=='2221034') 
  return 'VODAFONE';
else if($imsi=='2228834') 
  return 'WIND';
else if($imsi=='4540492') 
  return 'AU KIDDI 4S';
else if($imsi=='4405000') 
  return 'AU KIDDI 5G';
else if($imsi=='4402081') 
  return 'SOFTBANK 4S/5G';
else if($imsi=='4405014') 
  return 'AU KDDI IPHONE5';
else if($imsi=='4167711') 
  return 'ORANGE';
else if($imsi=='4500826') 
  return 'TELECOME';
else if($imsi=='2950211') 
  return 'ORANGE';
else if($imsi=='2950111') 
  return 'SWISCO';
else if($imsi=='2460165') 
  return 'OMNITEL';
else if($imsi=='2460165') 
  return 'OMNITEL';
else if($imsi=='2700101') 
  return 'LUXGSM';
else if($imsi=='2707701') 
  return 'TANGO';
else if($imsi=='2709901') 
  return 'VOXMOBI';
else if($imsi=='4550234') 
  return 'CHINA';
else if($imsi=='4550134') 
  return 'CMT';
else if($imsi=='4550534') 
  return 'HUTCHIS';
else if($imsi=='4550034') 
  return 'SMARTT';
else if($imsi=='2940387') 
  return 'VIP';
else if($imsi=='2940200') 
  return 'ONE(EX-COSMOFON)';
else if($imsi=='2940102') 
  return 'T-MOBILE';
else if($imsi=='3340202') 
  return 'TELCEL';
else if($imsi=='3340100') 
  return 'NEXTEL';
else if($imsi=='3340500') 
  return 'LUSACELL';
else if($imsi=='3340300') 
  return 'MOVISTAR';
else if($imsi=='3340202') 
  return 'AMERICA MOVIL';
else if($imsi=='2590101') 
  return 'ORANGE';
else if($imsi=='2970200') 
  return 'T-MOBILE';
else if($imsi=='2041611') 
  return 'T-MOBILE';
else if($imsi=='5300134') 
  return 'RESERVE';
else if($imsi=='2040438') 
  return 'VODAFONE';
else if($imsi=='5302834') 
  return 'ECONET';
else if($imsi=='5302434') 
  return 'NZCOMUNIC';
else if($imsi=='5300534') 
  return 'TELECOM';
else if($imsi=='5300434') 
  return 'TELTRACLE';
else if($imsi=='5300134') 
  return 'VODAFONE';
else if($imsi=='5300334') 
  return 'WOOSH';
else if($imsi=='2420211') 
  return 'NETCOM';
else if($imsi=='2420111') 
  return 'TELENOR';
else if($imsi=='2400768') 
  return 'TELE2';
else if($imsi=='7161011') 
  return 'CLARO';
else if($imsi=='7161011') 
  return 'TIM';
else if($imsi=='5150220') 
  return 'GB';
else if($imsi=='5150303') 
  return 'SM';
else if($imsi=='5150509') 
  return 'SUN';
else if($imsi=='5150211') 
  return 'GLOBE';
else if($imsi=='2600211') 
  return 'ERA';
else if($imsi=='2600311') 
  return 'ORANGE';
else if($imsi=='2600200') 
  return 'T-MOBILE';
else if($imsi=='2680311') 
  return 'OPTIMUS';
else if($imsi=='2680111') 
  return 'VODAFONE';
else if($imsi=='2680611') 
  return 'TMN';
else if($imsi=='2260107') 
  return 'VODAFONE';
else if($imsi=='2261007') 
  return 'ORANGE';
else if($imsi=='2260307') 
  return 'COSMOTE';
else if($imsi=='2260407') 
  return 'ZAPP';
else if($imsi=='2502834') 
  return 'BEELINE28';
else if($imsi=='2509934') 
  return 'BEELINE99';
else if($imsi=='2500234') 
  return 'MEGAFON';
else if($imsi=='2501034') 
  return 'MTS10';
else if($imsi=='2509334') 
  return 'TELECOM';
else if($imsi=='4200734') 
  return 'EAE';
else if($imsi=='4200334') 
  return 'MOBILY';
else if($imsi=='4200134') 
  return 'STC';
else if($imsi=='4200434') 
  return 'ZAINSA';
else if($imsi=='2310411') 
  return 'T-MOBILE 2';
else if($imsi=='2310234') 
  return 'EUROTEL 2';
else if($imsi=='2310134') 
  return 'ORANGE';
else if($imsi=='2310534') 
  return 'ORANGE UMT';
else if($imsi=='2311534') 
  return 'ORANGE UMT2';
else if($imsi=='2310634') 
  return 'TELEFICO2';
else if($imsi=='6550134') 
  return 'VODACOM';
else if($imsi=='2934001') 
  return 'SI-MOBILE';
else if($imsi=='2140711') 
  return 'MOVISTAR';
else if($imsi=='2140333') 
  return 'ORANGE';
else if($imsi=='2140198') 
  return 'VODAFONE';
else if($imsi=='2140401') 
  return 'YOIGO';
else if($imsi=='2400200') 
  return '3';
else if($imsi=='2400111') 
  return 'TELIA';
else if($imsi=='2400700') 
  return 'TELE2';
else if($imsi=='2400100') 
  return 'TELIA';
else if($imsi=='2400885') 
  return 'TELENOR';
else if($imsi=='2280167') 
  return 'SWISSCOM';
else if($imsi=='2280311') 
  return 'ORANGE';
else if($imsi=='2280200') 
  return 'SUNRISE';
else if($imsi=='2280111') 
  return 'SWISCOM';
else if($imsi=='2280211') 
  return 'SUNRISE';
else if($imsi=='2280121') 
  return 'SWISCOM (UNOFFICAL)';
else if($imsi=='4669234') 
  return 'CHUNGWA';
else if($imsi=='2860134') 
  return 'TURCELL';
else if($imsi=='2860211') 
  return 'VODAFONE';
else if($imsi=='2862034') 
  return 'VODAFONE';
else if($imsi=='4240334') 
  return 'DU';
else if($imsi=='4240234') 
  return 'ETISAL';
else if($imsi=='2342091') 
  return '3';
else if($imsi=='2341091') 
  return 'O2';
else if($imsi=='2343320') 
  return 'ORANGE/T-MOBILE';
else if($imsi=='2341590') 
  return 'VODAFONE 2';
else if($imsi=='2340211') 
  return 'O2 – 2';
else if($imsi=='2343334') 
  return 'ORANGE33';
else if($imsi=='2343091') 
  return 'T-MOBILE';
else if($imsi=='2343091') 
  return 'ORANGE';
else if($imsi=='2343091') 
  return 'EE';
else if($imsi=='2340100') 
  return 'VECTONE';
else if($imsi=='7481011') 
  return 'CTIMOV';
else if($imsi=='7480711') 
  return 'MOVISTAR';
else if($imsi=='7480111') 
  return 'ANTEL';
else if($imsi=='3104101') 
  return 'ATT';
else if($imsi=='2040400') 
  return 'VERIZON';
else if($imsi=='3160101') 
  return 'SPRINT(CDMA)';
else if($imsi=='3461401') 
  return 'CABLE&WIRELESS LIME';
else if($imsi=='3101200') 
  return 'SPRINT IPHONE5';
else if($imsi=='2040400') 
  return 'CRICKET';
else if($imsi=='3101200') 
  return 'VIRGIN IPHONE5';
else if($imsi=='2040400') 
  return 'STRAIGHT TALK';
else if($imsi=='3102605') 
  return 'T-MOBILE IPHONE5';
else if($imsi=='3113700') 
  return 'WIRELESS ALASKA';
else if($imsi=='3102620') 
  return 'T-MOBILE';
else if($imsi=='3114801') 
  return 'TRACFONE';
else if($imsi=='3102600') 
  return 'METROPCS';
else if($imsi=='3114801') 
  return 'TOTAL WIRELESS';
else if($imsi=='3104101') 
  return 'CONSUMER CELULLAR';
else if($imsi=='3114801') 
  return 'STRAIGHT TALK';
else if($imsi=='3160101') 
  return 'BOOST MOBILE';
else if($imsi=='2040400') 
  return 'XFINITY';
else if($imsi=='7340486') 
  return 'MOVISTAR';
else if($imsi=='7340200') 
  return 'DIGITEL';
else if($imsi=='7340600') 
  return 'MOVILNET';
else if($imsi=='7340400') 
  return 'TELEFONICA';
else  
  return 'OTHER';
}

function validate_imei($imei) {
	if (!preg_match('/^[0-9]{15}$/', $imei)) return false;
	$sum = 0;
	for ($i = 0; $i < 14; $i++)
	{
		$num = $imei[$i];
		if (($i % 2) != 0)
		{
			$num = $imei[$i] * 2;
			if ($num > 9)
			{
				$num = (string) $num;
				$num = $num[0] + $num[1];
			}
		}
		$sum += $num;
	}
	if ((($sum + $imei[14]) % 10) != 0) return false;
	return true;
}

function match_all($needles, $haystack) {
    if(empty($needles)){
        return false;
    }

    foreach($needles as $needle) {
        if (strpos($haystack, $needle) == false) {
            return false;
        }
    }
    return true;
}

function albert_attack($query) {
	$url = "https://albert.apple.com/deviceservices/deviceActivation";
			echo $query. "<br>";
	$test = urlencode(base64_encode($query));
  //echo $test. "<br>";;
  echo "=============";
    $post_data = "passcode=gfdgf&activation-info-base64=$test";
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL , $url ); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
	curl_setopt($ch, CURLOPT_TIMEOUT , 10); 
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: ".strlen($post_data)));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_USERAGENT , "iOS 11.1.1 15B150 iPhone Setup Assistant iOS Device Activator (MobileActivation-286.20.3 built on Sep 29 2017 at 18:51:08)" );
	curl_setopt($ch, CURLOPT_POST , 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS , $post_data );  
	
	$xml_response = curl_exec($ch); 	
	if (curl_errno($ch)) { 
		$error_message = curl_error($ch); 
		$error_no = curl_errno($ch);

		//echo "error_message: " . $error_message . "<br>";
		//echo "error_no: " . $error_no . "<br>";
	}
	curl_close($ch);
print_r($xml_response)."</br>";


	if(DEBUG){ print_r($xml_response)."</br>"; die(); }
	
	$aclock = array('SIM','Not','Supported');
	$problemiphone = array('Please','restore','the','phone','and','install','the','latest','version','of','iOS');
	$problemiphone1 = array('Device','Unknown');
	$problemiphone2 = array('There', 'is', 'a', 'problem', 'with', 'your', 'iPhone.');
	$problemiphone3 = array('There', 'is', 'a', 'problem', 'with', 'this', 'iPhone.');	
	$activationerror = array('This','iPhone','is','not','able','to','complete','the','activation','process');
	$unsupportedsim =  array('Unsupported','SIM');
	$icloudLocked =  array('This','iPhone', 'is', 'linked');
	$errorUnlocked = array('Activation', 'could');
	//Activation could not be completed
   if (match_all($activationerror,$xml_response)) {
		return "TryMeid";
	}
	else if(match_all($aclock,$xml_response)) {
		return "Locked";
	} else if (match_all($problemiphone,$xml_response)) {
		return "Unlocked";
	} else if (match_all($problemiphone2,$xml_response)) {
		return "chimaera";
	} else if (match_all($problemiphone3,$xml_response)) {
		return "chimaera";
	} else if (match_all($icloudLocked,$xml_response)) {
		return "Unlocked";
	} else if (match_all($errorUnlocked,$xml_response)) {
		return "Unlocked";
	} else if (strpos($xml_response, "AccountToken")!==false) {
    	return "Unlocked";
   	}  else {
		print_r($xml_response);
		//return "IDK BRO";
	}
}
function simlock($imei, $sn, $meid, $imei2, $imsi = '6030326') {
	if(isset($meid)) {
		$meid = '<key>MobileEquipmentIdentifier</key>
        <string>'.$meid.'</string>';
	}
	
	if(empty($imei2)==false) {
		$imei2 = '<key>InternationalMobileEquipmentIdentity2</key>
      <string>'.$imei2.'</string>';
	}
	
	$ActivationInfoXML = 
'<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>ActivationRequestInfo</key>
	<dict>
		<key>ActivationRandomness</key>
		<string>C4CCDB92-4859-4E50-A2EB-D0DA533237F4</string>
		<key>ActivationState</key>
		<string>Unactivated</string>
		<key>FMiPAccountExists</key>
		<false/>
	</dict>
	<key>BasebandRequestInfo</key>
	<dict>
		<key>ActivationRequiresActivationTicket</key>
		<true/>
		<key>BasebandActivationTicketVersion</key>
		<string>V2</string>
		<key>BasebandChipID</key>
		<integer>938209</integer>
		<key>BasebandMasterKeyHash</key>
		<string>1B41607650EBF11C6B39F41CB267DC64C121A9BCF44DBA5D28F55ACC86361BBA366554CD57B4C466055803E1EF81C870</string>
		<key>BasebandSerialNumber</key>
		<data>
		kle1og==
		</data>
		<key>GID1</key>
		<string>bae0000000000000</string>
		<key>GID2</key>
		<string>ffffffffffffffff</string>
		<key>IntegratedCircuitCardIdentity</key>
		<string>89148000004835885461</string>
		<key>InternationalMobileEquipmentIdentity</key>
		<string>'.$imei.'</string>
		'.$imei2.'
		<key>InternationalMobileSubscriberIdentity</key>
		<string>410018577536710</string>
		<key>InternationalMobileSubscriberIdentityOverride</key>
		<false/>
		'.$meid.'
		<key>PRIVersion_Major</key>
		<integer>1</integer>
		<key>PRIVersion_Minor</key>
		<integer>1</integer>
		<key>PRIVersion_ReleaseNo</key>
		<integer>216</integer>
		<key>PhoneNumber</key>
		<string>+17026593588</string>
		<key>SIM1IsEmbedded</key>
		<false/>
		<key>SIMGID1</key>
		<data>
		uuAAAAAAAAA=
		</data>
		<key>SIMGID2</key>
		<data>
		//////////8=
		</data>
		<key>SIMStatus</key>
		<string>kCTSIMSupportSIMStatusReady</string>
		<key>SIMStatus2</key>
		<string>kCTSIMSupportSIMStatusNotInserted</string>
		<key>SupportsPostponement</key>
		<true/>
		<key>kCTPostponementInfoPRIVersion</key>
		<string>1.1.216</string>
		<key>kCTPostponementInfoPRLName</key>
		<integer>0</integer>
	</dict>
	<key>DeviceCertRequest</key>
	<data>
	LS0tLS1CRUdJTiBDRVJUSUZJQ0FURSBSRVFVRVNULS0tLS0KTUlJQnhEQ0NBUzBDQVFB
	d2dZTXhMVEFyQmdOVkJBTVRKRU14TkRKQ1JqQTNMVEk1TWpJdE5ETkJOQzFCUVVZeg0K
	TFRSR1FqVTNSVGc1TVRsRk16RUxNQWtHQTFVRUJoTUNWVk14Q3pBSkJnTlZCQWdUQWtO
	Qk1SSXdFQVlEVlFRSA0KRXdsRGRYQmxjblJwYm04eEV6QVJCZ05WQkFvVENrRndjR3hs
	SUVsdVl5NHhEekFOQmdOVkJBc1RCbWxRYUc5dQ0KWlRDQm56QU5CZ2txaGtpRzl3MEJB
	UUVGQUFPQmpRQXdnWWtDZ1lFQXNheS9Yc2lDWDJwZStvV05QaHZ2cnR5Zg0KbnJGTHhI
	VkppcWRlTVE1M2NkQ1U2QjUvdm4wNkY3UXhpMHcxSG96cjl2d3pIV3pLQXhPWVZ0TnhU
	T0VzQk9XZA0KRGFPSHBJM2x0T1BOMmFNZ0w3WEloRzhnN1VYOUFyTllBM00yY3NBbWR2
	elppd2xFZzFSQmo3cGdWU1BFTmtBNA0KYVl5R3VOQnp6UDc4K2N4NDE4OENBd0VBQWFB
	QU1BMEdDU3FHU0liM0RRRUJCUVVBQTRHQkFLbllkWThiR0pTNw0KUGRKRkE4cjRFUHhF
	emJkMi8yb1FabUx0MUxwclJoZUt5dFkwdkdsQTEvV1hSS1ZvaXBQOXY2M2tQZFNzaGUy
	Sg0KaEptWi8xWksxME15aWd3VTZOZU1HVFoyRG9WcEhhbTVhV094b0p2dDFXUFlIRlRv
	MEQwOENYUzNETVgydDJINg0KaUdIWWVkajFCNEFaOU1YZU5aLzRhZE1pU0ZuZHIzVXkK
	LS0tLS1FTkQgQ0VSVElGSUNBVEUgUkVRVUVTVC0tLS0t
	</data>
	<key>DeviceID</key>
	<dict>
		<key>SerialNumber</key>
		<string>'.$sn.'</string>
		<key>UniqueDeviceID</key>
		<string>00008101-001C0DE436A0001E</string>
	</dict>
	<key>DeviceInfo</key>
	<dict>
		<key>BuildVersion</key>
		<string>19D52</string>
		<key>DeviceClass</key>
		<string>iPhone</string>
		<key>DeviceVariant</key>
		<string>A</string>
		<key>ModelNumber</key>
		<string>MGFL3</string>
		<key>OSType</key>
		<string>iPhone OS</string>
		<key>ProductType</key>
		<string>iPhone13,2</string>
		<key>ProductVersion</key>
		<string>15.3.1</string>
		<key>RegionCode</key>
		<string>LL</string>
		<key>RegionInfo</key>
		<string>LL/A</string>
		<key>RegulatoryModelNumber</key>
		<string>A2172</string>
		<key>SigningFuse</key>
		<true/>
		<key>UniqueChipID</key>
		<integer>7896573168058398</integer>
	</dict>
	<key>RegulatoryImages</key>
	<dict>
		<key>DeviceVariant</key>
		<string>A</string>
	</dict>
	<key>SoftwareUpdateRequestInfo</key>
	<dict>
		<key>Enabled</key>
		<true/>
	</dict>
	<key>UIKCertification</key>
	<dict>
		<key>BluetoothAddress</key>
		<string>44:f2:1b:eb:95:96</string>
		<key>BoardId</key>
		<integer>12</integer>
		<key>ChipID</key>
		<integer>33025</integer>
		<key>EthernetMacAddress</key>
		<string>44:f2:1b:f1:83:b5</string>
		<key>UIKCertification</key>
		<data>
		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
		</data>
		<key>WifiAddress</key>
		<string>44:f2:1b:ec:db:44</string>
	</dict>
</dict>
</plist>
';

	$ActivationInfoXML64 = base64_encode($ActivationInfoXML);
	
	$FairplayPrivateKeyBase64		= "LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlDV3dJQkFBS0JnUUMzQktyTFBJQmFiaHByKzRTdnVRSG5iRjBzc3FSSVE2Ny8xYlRmQXJWdVVGNnA5c2RjdjcwTityOHlGeGVzRG1wVG1LaXRMUDA2c3pLTkFPMWs1SlZrOS9QMWVqejA4Qk1lOWVBYjRqdUFoVldkZkFJeWFKN3NHRmplU0wwMTVtQXZyeFRGY09NMTBGL3FTbEFSQmljY3hIalBYdHVXVnIwZkxHcmhNKy9BTVFJREFRQUJBb0dBQ0dXM2JISFBOZGI5Y1Z6dC9wNFBmMDNTakoxNXVqTVkwWFk5d1VtL2gxczZyTE84Ky8xME1ETUVHTWxFZGNtSGlXUmt3T1ZpalJIeHpOUnhFQU1JODdBcnVvZmhqZGRiTlZMdDZwcFcybkxDSzdjRURRSkZhaFRXOUdRRnpwVlJRWFhmeHI0Y3MxWDNrdXRsQjZ1WTJWR2x0eFFGWXNqNWRqdjdEK0E3MkEwQ1FRRFpqMVJHZHhiZU9vNFh6eGZBNm40MkdwWmF2VGxNM1F6R0ZvQkpnQ3FxVnUxSlFPem9vQU1SVCtOUGZnb0U4K3VzSVZWQjRJbzBiQ1VUV0xwa0V5dFRBa0VBMTFyeklwR0loRmtQdE5jLzMzZnZCRmd3VWJzalRzMVY1RzZ6NWx5L1huRzlFTmZMYmxnRW9iTG1TbXozaXJ2QlJXQURpd1V4NXpZNkZOL0RtdGk1NndKQWRpU2Nha3VmY255dnp3UVo3UndwLzYxK2VyWUpHTkZ0YjJDbXQ4Tk82QU9laGNvcEhNWlFCQ1d5MWVjbS83dUovb1ozYXZmSmRXQkkzZkd2L2twZW13SkFHTVh5b0RCanB1M2oyNmJEUno2eHRTczc2N3IrVmN0VExTTDYrTzRFYWFYbDNQRW1DcngvVSthVGpVNDVyN0RuaThaK3dkaElKRlBkbkpjZEZrd0dId0pBUFErd1ZxUmpjNGgzSHd1OEk2bGxrOXdocEs5TzcwRkxvMUZNVmRheXRFbE15cXpRMi8wNWZNYjdGNnlhV2h1K1EyR0dYdmRsVVJpQTN0WTBDc2ZNMHc9PQotLS0tLUVORCBSU0EgUFJJVkFURSBLRVktLS0tLQ==";
	$FairPlayCertChain64 			= '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';
	
	openssl_sign($ActivationInfoXML, $signature, openssl_pkey_get_private(base64_decode($FairplayPrivateKeyBase64)), 'sha1WithRSAEncryption'); //sha1WithRSAEncryption
	$ActivationInfoXMLSignature = base64_encode($signature);

	$posti = 
'<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>ActivationInfoComplete</key>
	<true/>
	<key>ActivationInfoXML</key>
	<data>'.$ActivationInfoXML64.'</data>
	<key>FairPlayCertChain</key>
	<data>'.$FairPlayCertChain64.'</data>
	<key>FairPlaySignature</key>
	<data>'.$ActivationInfoXMLSignature.'</data>
	<key>RKCertification</key>
<data>
MIIB9zCCAZwCAQEwADCB2gIBATAKBggqhkjOPQQDAgNIADBFAiEAk0kFrgp9oIqPSyw4
CeWwPc1MAGYtjvghUvV+YvDGhicCIEE0vW+s4Zs61eFjJDzvVxAKbsHFNj7MtVrbr5zT
i4k5MFswFQYHKoZIzj0CAaAKBggqhkjOPQMBBwNCAARuSdhS4I5eL1IyV2c+G690w4DH
9DFQye4b8PMbQ7FKFnhGcUOXk0eTfeF4q+b+au3l22dbj1DdioLbCCbNFVyFoAoECCBz
a3NIAAAAohYEFIT4wv/S+twSVWiuIUZOBiBDJj+OMIG3AgEBMAoGCCqGSM49BAMCA0kA
MEYCIQDngLzCQYigVMuMh3dtsq8GxrcShp6QobrHkWEmtDwjWgIhAKeWSAcq9n+wgAav
LU5TYBDy2smBJPSJxlgnECyB29RsMFswFQYHKoZIzj0CAaAKBggqhkjOPQMBBwNCAASU
2VJGBNC+Hjw5KKv3qW9IFVBE5KdWnoMwJxku1j5+7lqSe2kYxYhT1rvPAt/r1/0wALzL
aY59NYA0Ax8rKWfWMAoGCCqGSM49BAMCA0kAMEYCIQDhoMxEfjuVQgqo9ol5O6Li1Omg
JMzaL4VCTNZVXfFv/AIhALdI44Q5KEuk0FwaycYSScndcuh5B88+NuFQn41isuwM
</data>
<key>RKSignature</key>
<data>
MEQCIBfETROMXro82io/uy53ChhYmoqvTsSSdL9K9YUxW+GLAiAhh9EZ4TRxuSqWoRqm
0cop5KHlreeLv+PwHKpXn9Vmfw==
</data>
<key>serverKP</key>
<data>
TlVMTA==
</data>
<key>signActRequest</key>
<data>
TlVMTA==
</data>
</dict>
</plist>';


	return albert_attack($posti);
}

