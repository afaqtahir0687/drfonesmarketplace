<?php

    class FmiChecker {

        function setAuth() {
        $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://o2trade-api.a-novo.co.uk/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&username=O2broadland&password=|_<t)5,)h7g9<2e2'h-&+@.nri5pu0021-");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://www.o2recycle.co.uk';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Referer: https://www.o2recycle.co.uk/viewphone/14552/357292095861607';
$headers[] = 'Accept-Language: es-419,es;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$rst =  json_decode($result);
$decoded = reset($rst);
return $decoded;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
        }

        function getFmi($imei){
            $ch = curl_init();
$auth = $this->setAuth();
curl_setopt($ch, CURLOPT_URL, 'https://o2trade-api.a-novo.co.uk/api/IMEI/LookupFMIIMEI?IMEI='.$imei);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: o2trade-api.a-novo.co.uk';
$headers[] = 'Content-Length: 0';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Authorization: Bearer '.$auth;
$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://www.o2recycle.co.uk';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Referer: https://www.o2recycle.co.uk/viewphone/14552/357292095861607';
$headers[] = 'Accept-Language: es-419,es;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if ($result == 1){
echo 'Activation Lock:<font  color="red"> <strong>ON</strong></font>';
} if($result == 0){
     echo 'Activation Lock:<font  color="green"> <strong>OFF</strong></font>';
}

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
        }
    }

$check = new FmiChecker;
    $data = $check->getFmi($_GET['imei']);
    $data2 = $check->setAuth();
    //echo '<pre>';
    print_r($data);
    //echo '<pre>';

?>
