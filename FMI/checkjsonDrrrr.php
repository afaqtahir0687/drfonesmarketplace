<?php
ini_set('max_execution_time', 0);
$cookies = "";

$inputSerial = $_GET['serial'];


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://checkcoverage.apple.com/us/en/?sn=$inputSerial");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	@$cookies = tempnam('/tmp','cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
	$result = curl_exec($ch);
	if ($result === FALSE) {
		die('Curl failed: ' . curl_error($ch));
	}

	
	$date = date_create();
	$timestamp = date_timestamp_get($date);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://checkcoverage.apple.com/gc?t=image&timestamp=" . $timestamp);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Accept: application/json, text/javascript, */*; q=0.01",
		"User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0",
		"Referer: https://checkcoverage.apple.com/us/en/?sn=$inputSerial",
		"X-Requested-With: XMLHttpRequest"
	));
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
	$result = curl_exec($ch);
	if ($result === FALSE) {
		die('Curl failed: ' . curl_error($ch));
	}


preg_match('/binaryValue":"(.*)","type/',$result,$matches);
$imageData = $matches[1];

include("anticaptcha.php");
include("imagetotext.php");

$api = new ImageToText();
$api->setKey("529fa8e9eaa80a2cc06bc62c9b194181");

$api->setFile($imageData);

if (!$api->createTask()) {
    echo "API v2 send failed - ".$api->getErrorMessage()."\n";
    exit;
}

$taskId = $api->getTaskId();

if (!$api->waitForResult()) {
    echo "could not solve captcha\n";
    echo $api->getErrorMessage()."\n";
} else {
    $captchaText    =   $api->getTaskSolution();
}
	

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Accept: application/json, text/javascript, */*; q=0.01",
		"User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0",
		"Referer: https://checkcoverage.apple.com/us/en/?sn=$inputSerial",
		"Origin: https://checkcoverage.apple.com"
	));
	curl_setopt($ch, CURLOPT_URL, "https://checkcoverage.apple.com/us/en/?sn=$inputSerial");
	curl_setopt($ch, CURLOPT_POST, 1);


	curl_setopt($ch, CURLOPT_POSTFIELDS, "sno=$inputSerial&ans=" . $captchaText . "&captchaMode=image&CSRFToken=null");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	$server_output = curl_exec($ch);
	curl_close($ch);
	
	
	$activationStatus = "";
	$estimatedPurchaseData = "";
	$telephoneTechnicalSupport = "";
	$telephoneTechnicalSupportExpirationDate = "";
	$repairsAndServiceCoverage = "";
	$repairsAndServiceCoverageExpiration = "";
	$repairsAndServiceExpiresIn = "";
	$appleCare = "";
	$appleCareExpiry = "";
	$replacedDevice = "";
	$activationStatusstr ="";
	$modelstr = "";
	$purchasedatestr ="";
	$repairCoverageServiceStr ="";
	$repairServiceStr ="";
	$repairServiceExpireStr ="";
	$estimatedPurchaseDateStr = "";
	$telephoneTechnicalSupportstr = "";
	$telephoneTechnicalSupportExpirestr = "";
	$appleCareStr = "";
	$appleCareExpireDateStr = "";

	
	//$finalDataArray2=array("Status" => "Success");
//echo json_encode($finalDataArray2);
	
	if(Search("Sorry. The code you entered doesn",$server_output) == true)
	{
		echo "Invalid Captcha";
	}
	else if(Search("valid. Please check your information and try again.",$server_output) == true)
	{
		echo "Invalid Serial";		
	}
	else{		
                
		$prodInfo = "";
		
		preg_match('/PROD_DESCR":"(.*?)".*,"PROD_IMAGE_URL":"(.*?)"/',$server_output,$prodInfo);
		//$finalData = "<img src='$prodInfo[2]'><br><b>Model:$prodInfo[1]</b><br>\r\n";
		//$finalData .= "<b>IMEI/SN: $inputSerial<b>\r\n<br>";
		$modelstr = $prodInfo[1];
              //  array_push($finalDataArray,"Model" => );
                //array_push($finalDataArray,"IMEI/SN" => $inputSerial);
		if(Search('"status":"green","resultLabel":"Valid Purchase Date"',$server_output) == true)
		{
			$activationStatus = true;
			//$finalData .=  "<b>Activation Status:</b> <b style='color:green'>Activated</b>\r\n<br>";
			$activationStatusstr = "Activated";
			//array_push($finalDataArray,"Activation Status" => "Activated");
		}
		elseif((Search('"resultId":"notregistered"',$server_output) == true))
		{
			//$finalData .= "<b>Activation Status:</b> <b style='color:red'>Deactivated</b>\r\n<br>";
			$activationStatusstr = "Deactivated";
			//array_push($finalDataArray,"Activation Status" => "Deactivated");
		}
                elseif((Search('"resultId":"iphonenotactivated"',$server_output) == true))
		{
			//$finalData .= "<b>Activation Status:</b> <b style='color:red'>Non Active</b>\r\n<br>";
			$activationStatusstr = "Non Active";
			//array_push($finalDataArray,"Activation Status" => "Deactivated");
		}

		
		if(Search('"green","resultLabel":"Repairs and Service Coverage: Active"',$server_output) == true)
		{
			$repairsAndServiceCoverage = true;
			preg_match('/"resultId":"hardware","endDate":"(.*?)"/',$server_output,$repairsAndServiceCoverageExpiration);
			
			$estPurchase = strtotime($repairsAndServiceCoverageExpiration[1] . ' -1 year');
			$estPurchase = date('d F Y',$estPurchase);
			$repairsAndServiceCoverageExpiration = date('d F Y', strtotime($repairsAndServiceCoverageExpiration[1]));
			
			//$finalData .= "<b>Estimated Purchase Date: $estPurchase</b>\r\n<br>";
			//$finalData .= "<b>Repairs and Service Coverage:</b> <b style='color:green'>Active</b>\r\n<br>";
			//$finalData .= "<b>Repairs And Service Expiration Date: $repairsAndServiceCoverageExpiration</b>\r\n<br>";
			$purchasedatestr = $estPurchase;
			//array_push($finalDataArray,"Estimated Purchase Date" => $estPurchase);
			$repairCoverageServiceStr = "Active";
			//array_push($finalDataArray,"Repairs and Service Coverage" => "Active");
			$repairServiceStr = $repairsAndServiceCoverageExpiration;
			//array_push($finalDataArray,"Repairs And Service Expiration Date" => $repairsAndServiceCoverageExpiration);
				
			$datetime1 = strtotime($repairsAndServiceCoverageExpiration);
			$datetime2 = strtotime(date('d-m-Y'));
			$expiresIn = ($datetime1 - $datetime2)/60/60/24;
			//$finalData .= "<b>Repairs And Service Expires In: $expiresIn days</b>\r\n<br>";
			$repairServiceExpireStr = $expiresIn;
			//array_push($finalDataArray,"Repairs And Service Expires In" => $expiresIn);
		}
		else if(Search('Repairs and Service Coverage: Expired',$server_output))
		{
			preg_match('/"resultId":"hardware","endDate":"(.*?)"/',$server_output,$repairsAndServiceCoverageExpiration);
			$estPurchase = strtotime($repairsAndServiceCoverageExpiration[1] . ' -1 year');
			$estPurchase = date('d F Y',$estPurchase);
			$repairsAndServiceCoverageExpiration = date('d F Y', strtotime($repairsAndServiceCoverageExpiration[1]));
			
			//$finalData .= "<b>Estimated Purchase Date: $estPurchase</b>\r\n<br>";
			//$finalData .= "<b>Repairs and Service Coverage:</b> <b style='color:red'>Expired</b>\r\n<br>";
			$purchasedatestr = $estPurchase;
			//array_push($finalDataArray,"Estimated Purchase Date" => $estPurchase);
			$repairCoverageServiceStr = "Expired";
			//array_push($finalDataArray,"Repairs and Service Coverage" => "Expired");
		}


		if(Search('"status":"green","resultLabel":"Telephone Technical Support: Active"',$server_output) == true)
		{
			$telephoneTechnicalSupport = true;
			preg_match('/"resultId":"iphone","endDate":"(.*?)"/',$server_output,$telephoneTechnicalSupportExpirationDate);
			
			$telephoneTechnicalSupportExpirationDate = date('d F Y', strtotime($telephoneTechnicalSupportExpirationDate[1]));
			//$finalData .= "<b>Telephone Technical Support:</b> <b style='color:green'>Active</b>\r\n<br>";
			//$finalData .= "<b>Telephone Technical Support Expiration Date: $telephoneTechnicalSupportExpirationDate </b> \r\n<br>";
			$datetime1 = strtotime($telephoneTechnicalSupportExpirationDate);
			$datetime2 = strtotime(date('d-m-Y'));
			$expiresIn = ($datetime1 - $datetime2)/60/60/24;
			//$finalData .= "<b>Telephone Technical Support Expires In: $expiresIn days</b>\r\n<br>";
			$telephoneTechnicalSupportstr = "Active";
			$telephoneTechnicalSupportExpirestr = $telephoneTechnicalSupportExpirationDate;
			//array_push($finalDataArray,"Telephone Technical Support" => "Active");
			//array_push($finalDataArray,"Telephone Technical Support Expiration Date" => $telephoneTechnicalSupportExpirationDate);
			//array_push($finalDataArray,"Telephone Technical Support Expires In" => $expiresIn);
		}
		else if(Search('Telephone Technical Support: Expired',$server_output))
		{
			//$finalData .= "<b>Telephone Technical Support:</b> <b style='color:red'>Expired</b>\r\n<br>";
			$telephoneTechnicalSupportstr = "Expired";
			//array_push($finalDataArray,"Telephone Technical Support" => "Expired");			
		}
		
		
		if(Search('"status":"green","resultLabel":"Covered by AppleCare Protection Plan"',$server_output) == true)
		{
			$appleCare = true;
			preg_match('/"resultId":"app","endDate":"(.*?)"/',$server_output,$appleCareExpiry);
			$appleCareExpiry = date('d F Y', strtotime($appleCareExpiry[1]));

			//$finalData .= "<b>Apple Care:</b> <b style='color:green'>Yes</b>\r\n<br>";
			//$finalData .= "<b>Apple Care Expiry Date: $appleCareExpiry</b>\r\n<br>";
			$appleCareStr = "Yes";
			//array_push($finalDataArray,"Apple Care" => "Yes");
			$appleCareExpireDateStr = $appleCareExpiry;
			//array_push($finalDataArray,"Apple Care Expiry Date" => $appleCareExpiry);
			$telephoneTechnicalSupport = true;
		}
		else 
		{
			$appleCareStr = "No";
			$appleCareExpireDateStr = "Expired";
			//$finalData .= "<b>Apple Care:</b> <b style='color:red'>No</b>\r\n<br>";
			//array_push($finalDataArray,"Apple Care" => "No");
		}

	   //	$finalData .= "<b>Replaced Device:</b> <b style='color:green'>No</b>\r\n<br>";
          if($activationStatusstr == "Non Active"){
            $purchasedatestr = "Non Active";
            $repairCoverageServiceStr = "Non Active";
            $repairServiceExpireStr = "Non Active";
            $repairServiceStr = "Non Active";
            $telephoneTechnicalSupportstr = "Non Active";
            $telephoneTechnicalSupportExpirestr = "";
            $appleCareStr = "Non Active";
            $appleCareExpireDateStr = "Non Active";

           }
	   $finalDataArray=array("Status" => "Success","Model" => $prodInfo[1], "SN" => $inputSerial, "Activation" => $activationStatusstr, "PurchaseDate" =>  $purchasedatestr, "RepairsServiceCoverage" => $repairCoverageServiceStr,"RepairsServiceExpires" => $repairServiceExpireStr,"RepairsServiceExpirationDate" => $repairServiceStr,"TelephoneTechnicalSupport" => $telephoneTechnicalSupportstr, "TelephoneTechnicalSupportExpiration" => $telephoneTechnicalSupportExpirestr,"AppleCare" => $appleCareStr, "AppleCareExpiry" => $appleCareExpireDateStr );
	    echo json_encode($finalDataArray);
		//echo $finalData;

	}


function Search($search, $string){ 
    $position = strpos($string, $search, 5);   
    if ($position == true){ 
        return true;
    } 
    else{ 
        return false;
    } 
} 

?>

