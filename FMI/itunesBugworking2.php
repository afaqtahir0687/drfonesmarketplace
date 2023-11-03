<?php

function albert_request($query)
{
$url = 'https://albert.apple.com/deviceservices/deviceActivation';
		$data_info=urlencode(base64_encode($query));
	    $post_data = 'login=&password=&activation-info-base64='.$data_info.'&isAuthRequired=true';
		
		//echo $bacio;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL , $url ); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT , 60); 
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: albert.apple.com", "Referer: https://albert.apple.com/deviceservices/deviceActivation", "Accept-Language: en-US;q=1.0, ru-US;q=0.9, ca-US;q=0.8, en-US;q=0.7", "X-Apple-I-MD-RINFO: 17106176", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Content-Type: application/x-www-form-urlencoded", "X-Apple-I-MD-M: OG3guNr4cyqIokBtSDK6wrSxLH4OoMoWeLj+2iBuOAinb0Z0KsG3ErB0cW4H9YWE+OGBcQjZEXc+hdJX", "X-Apple-I-MD: AAAABQAAABDNbiJvHPrIR7xx3I984orAAAAAAQ==", "Content-Length: ".strlen($post_data)));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_USERAGENT , "iTunes/12.7.3 (Macintosh; OS X 10.13) AppleWebKit/604.1.38.1.6 (dt:1)" );
		curl_setopt($ch, CURLOPT_POST , 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS , $post_data );  
 
		$xml_response = curl_exec($ch); 
 
		if (curl_errno($ch)) { 
			$error_message = curl_error($ch); 
			$error_no = curl_errno($ch);
 
			echo "error_message: " . $error_message . "<br>";
			echo "error_no: " . $error_no . "<br>";
		}
 
		curl_close($ch);
 
		return $xml_response;
}

$imei=$_GET['imei'];
$meid=substr($imei, 0, -1);
$sn=$_GET['sn'];
$request_ticket_new='<dict>
	<key>ActivationInfoXML</key>
	<data>
	'.base64_encode('<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>ActivationRequestInfo</key>
	<dict>
		<key>ActivationRandomness</key>
		<string>90388571-63BF-4F82-B784-C96323BB58CE</string>
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
		<integer>7278817</integer>
		<key>BasebandMasterKeyHash</key>
		<string>AEA5CCE143668D0EFB4CE1F2C94C966A6496C6AA</string>
		<key>BasebandSerialNumber</key>
		<data>
		GehxSw==
		</data>
		<key>IntegratedCircuitCardIdentity</key>
		<string>89014104277806044826</string>
		<key>InternationalMobileEquipmentIdentity</key>
		<string>'.$imei.'</string>
		<key>InternationalMobileSubscriberIdentity</key>
		<string>639070022667072</string>
		<key>MobileEquipmentIdentifier</key>
		<string>'.$meid.'</string>
		<key>PhoneNumber</key>
		<string></string>
		<key>SIMGID1</key>
		<data>
		/w==
		</data>
		<key>SIMGID2</key>
		<data>
		/w==
		</data>
		<key>SIMStatus</key>
		<string>kCTSIMSupportSIMStatusReady</string>
		<key>SupportsPostponement</key>
		<true/>
		<key>kCTPostponementInfoPRIVersion</key>
		<string>0.1.74</string>
		<key>kCTPostponementInfoPRLName</key>
		<integer>0</integer>
		<key>kCTPostponementInfoServiceProvisioningState</key>
		<false/>
	</dict>
	<key>DeviceCertRequest</key>
	<data>
	LS0tLS1CRUdJTiBDRVJUSUZJQ0FURSBSRVFVRVNULS0tLS0KTUlJQnhEQ0NBUzBDQVFB
	d2dZTXhMVEFyQmdOVkJBTVRKRU01TmpJd05EVXpMVVpHTWpjdE5EQkNSaTA0TlRVeg0K
	TFRrM1JUazBRakV4TmpNM056RUxNQWtHQTFVRUJoTUNWVk14Q3pBSkJnTlZCQWdUQWtO
	Qk1SSXdFQVlEVlFRSA0KRXdsRGRYQmxjblJwYm04eEV6QVJCZ05WQkFvVENrRndjR3hs
	SUVsdVl5NHhEekFOQmdOVkJBc1RCbWxRYUc5dQ0KWlRDQm56QU5CZ2txaGtpRzl3MEJB
	UUVGQUFPQmpRQXdnWWtDZ1lFQW5vTUp6RWFVMHRrdksrVDgvSUFjZTE4Yg0KSFJYY0Nu
	OTRnNTJ5aWNrOHVteC9Qenk2a2Jtek9aZDlFVjF5RGlZYXdwNnB0WHZrd0lhc3dkdjRS
	YTh2UXBUKw0KSmVOKzVsbEZLUG0vSC9kV2JrOWxrempuR0hrWEtFWW9ldW5weE1ldzE2
	em0vL3dvNGRnaVBnbE5ZWVhIbzl1cw0KeHRUeTROVmV1Ujg4MEwrdDhoRUNBd0VBQWFB
	QU1BMEdDU3FHU0liM0RRRUJCUVVBQTRHQkFGZnoyYjV6Y2d4TA0KUlBUTkl3S2RINWUw
	UUV6SUg5TmVzVkdKeTYrVU1Hb3BKSnArUHloVzAyMjBuUmdsN3VOcDNkUGRNUXUxdCtJ
	aA0KNUJYckhLbGF6enY1YURpaXhyNG9YMEs4bjhHcDBnMzdranBhdzhiM2Y5OVRScHMy
	ZC80U1J5S2dja3RnbXVyVQ0KdDVQSUM5QUwwclZsZ3RacWlzRGprWlhqa25ZWWdHbDAK
	LS0tLS1FTkQgQ0VSVElGSUNBVEUgUkVRVUVTVC0tLS0t
	</data>
	<key>DeviceID</key>
	<dict>
		<key>SerialNumber</key>
		<string>'.$sn.'</string>
		<key>UniqueDeviceID</key>
		<string>77b74971d1a87117879703bb3dfa72c51d1b5285</string>
	</dict>
	<key>DeviceInfo</key>
	<dict>
		<key>BuildVersion</key>
		<string>14G60</string>
		<key>DeviceClass</key>
		<string>iPhone</string>
		<key>DeviceVariant</key>
		<string>A</string>
		<key>ModelNumber</key>
		<string>MD297</string>
		<key>OSType</key>
		<string>iPhone OS</string>
		<key>ProductType</key>
		<string>iPhone5,2</string>
		<key>ProductVersion</key>
		<string>10.3.3</string>
		<key>RegionCode</key>
		<string>B</string>
		<key>RegionInfo</key>
		<string>B/A</string>
		<key>UniqueChipID</key>
		<integer>3489594786801</integer>
	</dict>
	<key>RegulatoryImages</key>
	<dict>
		<key>DeviceVariant</key>
		<string>A</string>
	</dict>
	<key>UIKCertification</key>
	<dict>
		<key>BluetoothAddress</key>
		<string>a8:88:08:54:18:4e</string>
		<key>BoardId</key>
		<integer>2</integer>
		<key>ChipID</key>
		<integer>35152</integer>
		<key>EthernetMacAddress</key>
		<string>a8:88:08:54:18:4f</string>
		<key>UIKCertification</key>
		<data>
		MIICzDCCAnECAQEwADCB2gIBATAKBggqhkjOPQQDAgNIADBFAiEA/ethdZWo
		C/pPtGV+euCqjrWSq10ZQfzjfWApsYT7P/UCIAmuTIRopNgjfwEfb3VWTDto
		3Xo2gsaXa8Fhiv7jDWTOMFswFQYHKoZIzj0CAaAKBggqhkjOPQMBBwNCAASe
		3dmpjvP1hqjaHr8IRdNnCPox47/fGvX8HbaJSKDTimLc42vrvb7hwUwpgUsv
		JWLzlv4/NxOQ9FYLAht6KEgUoAoECGFjc3NIAAAAohYEFD3t9dGWN/RuSiwE
		+3PrnFwBEuUjMIHDAgEBMAoGCCqGSM49BAMCA0kAMEYCIQCbOtXZl6WUefns
		slk9yZ6Y/7GFjZBCUHChAPWrzyQKWwIhAInFy1dWxb36JjlxOrf9nEAo2v57
		RAKb30YwjHMSNq8+MFswFQYHKoZIzj0CAaAKBggqhkjOPQMBBwNCAASzPhXR
		YEQjs7WICYWldx/xH1KMnDs/4SNPSLrEe3ZtXTs2hfhU1rylnIU9VtJZRrBu
		tXXNZDRIqccU6pqONIgyoAoECCBza3MCAAAAoIHGMIHDAgEBMAoGCCqGSM49
		BAMCA0kAMEYCIQCqJRgOE48esRHavb05NNK+pqF4uL5QYejDl4ei0HGeqAIh
		AKokoJGqrdW2ZXuyOfMUL06zOam8VibY70RGw2XpTT1uMFswFQYHKoZIzj0C
		AaAKBggqhkjOPQMBBwNCAASzPhXRYEQjs7WICYWldx/xH1KMnDs/4SNPSLrE
		e3ZtXTs2hfhU1rylnIU9VtJZRrButXXNZDRIqccU6pqONIgyoAoECCBza3MC
		AAAAMAoGCCqGSM49BAMCA0kAMEYCIQCT3BVVP3Jt42PSP38D64sOFDFmrdc+
		ZPugXmYksV42YgIhAK4vtSRWRAsCQMZNBCzozpwqPhMwbXc6H8wT5y/Yv2xF
		</data>
		<key>WifiAddress</key>
		<string>a8:88:08:54:18:4d</string>
	</dict>
</dict>
</plist>
').'
	</data>
	<key>FairPlayCertChain</key>
	<data>
	MIICxzCCAjCgAwIBAgINMzOvBwQCrwACrwAABzANBgkqhkiG9w0BAQUFADB7MQswCQYD VQQGEwJVUzETMBEGA1UEChMKQXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2VydGlm aWNhdGlvbiBBdXRob3JpdHkxLzAtBgNVBAMTJkFwcGxlIEZhaXJQbGF5IENlcnRpZmlj YXRpb24gQXV0aG9yaXR5MB4XDTA3MDQwMjE1MTcyOVoXDTEyMDMzMTE1MTcyOVowZzEL MAkGA1UEBhMCVVMxEzARBgNVBAoTCkFwcGxlIEluYy4xFzAVBgNVBAsTDkFwcGxlIEZh aXJQbGF5MSowKAYDVQQDEyFpUGhvbmUuMzMzM0FGMDcwNDAyQUYwMDAyQUYwMDAwMDcw gZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMYnuTTEX4jWu9ivGK6A+OS1r43u5CiS PXJoXGWgMW/ON2C+s9lmpVPnB9cIFmusjRbjFgjU2PWwN0NBjCkBPlTA9utA9wXlcBZc kbP0rtfr95kTZ39OOp1cWcBcisWV2Tzuyu/yQ9oulYchmR9UYmI8BKWun1PaIussi2XJ +gFnAgMBAAGjYzBhMA4GA1UdDwEB/wQEAwIDuDAPBgNVHRMBAf8EBTADAQH/MB0GA1Ud DgQWBBR6U0BQMeWj7Zi12PKN3wtbvbxZ5DAfBgNVHSMEGDAWgBT6DdQRkRvmsk4eBkmU Ed1jYgdZZDANBgkqhkiG9w0BAQUFAAOBgQBscMBk2LKcucWgZHF7SNSz/88nwbQeXkxO aOhW9kA2w7ku509Z9cL9MqcfNzHCMzCTvfDZypin3mDVGpLMM3ePj9PVnKMv74jKQRXO 6OYa3jUKQdx/5+c8E1Jnhwmv+iE2YeNiAa+IX8tM3OKTeI7kCpgWNEne6q2dMeMUI4M7 JDCCA20wggJVoAMCAQICAREwCwYJKoZIhvcNAQEFMGIxCzAJBgNVBAYTAlVTMRMwEQYD VQQKEwpBcHBsZSBJbmMuMSYwJAYDVQQLEx1BcHBsZSBDZXJ0aWZpY2F0aW9uIEF1dGhv cml0eTEWMBQGA1UEAxMNQXBwbGUgUm9vdCBDQTAeFw0wNzAyMTQxOTIwNDFaFw0xMjAy MTQxOTIwNDFaMHsxCzAJBgNVBAYTAlVTMRMwEQYDVQQKEwpBcHBsZSBJbmMuMSYwJAYD VQQLEx1BcHBsZSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTEvMC0GA1UEAxMmQXBwbGUg RmFpclBsYXkgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkwgZ0wCwYJKoZIhvcNAQEBA4GN ADCBiQKBgQCqST4QBhaqfvvYJD1iHtmbdVoMJOYC+AL/460BBSD80i/LIjq3EfXcAt5t 966tP+wGloPHWWsRTTGPQj6Ocvian64+dP0wm8KSEkpM/yoflIO1eQEdEiPkJv8UiMfG 6wh550VL7b9/6DSyuHPrLnCWTRZxma3RcACQi8BTp9cV5wIDAQABo4GcMIGZMA4GA1Ud DwEB/wQEAwIBhjAPBgNVHRMBAf8EBTADAQH/MB0GA1UdDgQWBBT6DdQRkRvmsk4eBkmU Ed1jYgdZZDA2BgNVHR8ELzAtMCugKaAnhiVodHRwOi8vd3d3LmFwcGxlLmNvbS9hcHBs ZWNhL3Jvb3QuY3JsMB8GA1UdIwQYMBaAFCvQaUeUdgn+9GuNLkCm90dNfwheMA0GCSqG SIb3DQEBBQwAA4IBAQDAoHP4Heoc0c3FhnWku+tAxWotDP5b/G7BW9dIfUCpYS1LN3A4 7waRS68Rwh+V7ogzb19y6vbVdrVXWHHwPhDD1S67L6Y6c8IyZQpWBBYZmE0LeG3Qo3Rk mFT0p9cdov8qw3kAspnn57vVBqLrSTNpZ0EBma1osNN69JXg/SSIKhDno2j/rXv62brx pX/Kk6LOAzcDZoWTBRsx9nWCky/T8No5Nz1f/rrNmnDABosi7qnOBG4kaTsWUqXA8sCu Q3CEuyGRQ8u7t+pbupPgt3eJ701WBDNdzlxZMafXO0VWEc2uy5sOoM/ck6jKxVh4AAXZ mavWXofqknM0VKOTGKSDMIIEuzCCA6OgAwIBAgIBAjANBgkqhkiG9w0BAQUFADBiMQsw CQYDVQQGEwJVUzETMBEGA1UEChMKQXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2Vy dGlmaWNhdGlvbiBBdXRob3JpdHkxFjAUBgNVBAMTDUFwcGxlIFJvb3QgQ0EwHhcNMDYw NDI1MjE0MDM2WhcNMzUwMjA5MjE0MDM2WjBiMQswCQYDVQQGEwJVUzETMBEGA1UEChMK QXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkx FjAUBgNVBAMTDUFwcGxlIFJvb3QgQ0EwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK AoIBAQDkkakJH5HbHkdQ6wXtXnmELes2oldMVeyLGYne+Uts9QerIjAC6Bg++FAJ039B qJj50cpmnCRrEdCju+QbKsMflZ56DKRHi1vUFjczy8QPTc4UadHJGXL1XQ7Vf1+b8iUD ulWPTV0N8WQ1IxVLFVkds5T39pyez1C6wVhQZ48ItCD3y6wsIG9wtj8BMIy3Q88PnT3z K0koGsj+zrW5DtleHNbLPbU6rfQPDgCSC7EhFi501TwN22IWq6NxkkdTVcGvL0Gz+Pvj cM3mo0xFfh9Ma1CWQYnEdGILEINBhzOKgbEwWOxaBDKMaLOPHd5lc/9nXmW8Sdh2nzMU ZaF3lMktAgMBAAGjggF6MIIBdjAOBgNVHQ8BAf8EBAMCAQYwDwYDVR0TAQH/BAUwAwEB /zAdBgNVHQ4EFgQUK9BpR5R2Cf70a40uQKb3R01/CF4wHwYDVR0jBBgwFoAUK9BpR5R2 Cf70a40uQKb3R01/CF4wggERBgNVHSAEggEIMIIBBDCCAQAGCSqGSIb3Y2QFATCB8jAq BggrBgEFBQcCARYeaHR0cHM6Ly93d3cuYXBwbGUuY29tL2FwcGxlY2EvMIHDBggrBgEF BQcCAjCBthqBs1JlbGlhbmNlIG9uIHRoaXMgY2VydGlmaWNhdGUgYnkgYW55IHBhcnR5 IGFzc3VtZXMgYWNjZXB0YW5jZSBvZiB0aGUgdGhlbiBhcHBsaWNhYmxlIHN0YW5kYXJk IHRlcm1zIGFuZCBjb25kaXRpb25zIG9mIHVzZSwgY2VydGlmaWNhdGUgcG9saWN5IGFu ZCBjZXJ0aWZpY2F0aW9uIHByYWN0aWNlIHN0YXRlbWVudHMuMA0GCSqGSIb3DQEBBQUA A4IBAQBcNplMLXi37Yyb3PN3m/J20ncwT8EfhYOFG5k9RzfyqZtAjizUsZAS2L70c5vu 0mQPy3lPNNiiPvl4/2vIB+x9OYOLUyDTOMSxv5pPCmv/K/xZpwUJfBdAVhEedNO3iyM7 R6PVbyTi69G3cN8PReEnyvFteO3ntRcXqNx+IjXKJdXZD9Zr1KIkIxH3oayPc4Fgxhtb CS+SsvhESPBgOJ4V9T0mZyCKM2r3DYLP3uujL/lTaltkwGMzd/c6ByxW69oPIQ7aunMZ T7XZNn/Bh1XZp5m5MkL72NVxnn6hUrcbvZNCJBIqxw8dtk2cXmPIS4AXUKqK1drk/NAJBzewdXUh
	</data>
	<key>FairPlaySignature</key>
	<data>
	xtdYrSWRTBNOAyouDU5fgJ/unjP0f5xRNdBqrbDit8+UT2l/PS1rMGnVkUDBADUoUnjh
	dfWkPcFTsBPZVj5Fgos5TC2vTDkiS2mb60+PuiJTWyqdN70SMnOa89fy1ixWY+0u+HWv
	K+STPhfMYyKfouXJQj5fGpzOIxXCbNgECkc=
	</data>
	<key>RKCertification</key>
	<data>
	MIIB8zCCAZoCAQEwADCB2QIBATAKBggqhkjOPQQDAgNHADBEAiAjKxJnW5vWu9tNh/AF
	EM2zudgzeSEbBeD02QkVFQyWVAIgCmy4/Pgwp5Y62jl8uGU14gnPfyhsroWrff6TUpIM
	LmMwWzAVBgcqhkjOPQIBoAoGCCqGSM49AwEHA0IABHJVDChw82xUW08PJwotG22E695Y
	kHtcMNmByJnWPHQ5dr7plbfONgT+EphsEuyBkKFmKLPcdaNfevJol5YTOmagCgQIIHNr
	c0gAAACiFgQUPe310ZY39G5KLAT7c+ucXAES5SMwgbYCAQEwCgYIKoZIzj0EAwIDSAAw
	RQIgBU/rgMplUSGBCM/cMdUAt8fQSia9D4W0o50NLBzwyjsCIQCxzKDjkwgBJZByL/UM
	05Gm7dnymZDFS8ACfx0+BmUSIDBbMBUGByqGSM49AgGgCgYIKoZIzj0DAQcDQgAEq7MH
	k/Peu7kZSQhXhzzozfhTfGu+eH34Cte9uRO3PO43DNle4vPoeh6XCQjs8Pcw3/EcK2tt
	3EMrVliNMYWEbTAKBggqhkjOPQQDAgNHADBEAiBkkpZyOowRxShVHOHYHdiwl426vZUs
	hOsfLLuMjN3e2wIgPx9Vzdq7PWGwkgo7qTidCy+/uUn2PHnS8Ma7sEE97DM=
	</data>
	<key>RKSignature</key>
	<data>
	MEYCIQCrkMsco4vpOSut69GZ95p7ql9jQ3UdkjNaTKpSjXt1iQIhAPGOjFMNtbvE8stf
	76O9HEBUMpPTINbiFeByrM9stgtU
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
';
echo $request_ticket;
//header("Content-type: application/x-buddyml");
echo $response= albert_request($request_ticket_new);


?>