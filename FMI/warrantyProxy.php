<style>
body
{font-size: 0.9em;
font-family: cursive;}
</style>

<?php
$curl=curl_init();
curl_setopt($curl,CURLOPT_TIMEOUT,20);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_PROXYTYPE,CURLPROXY_HTTP);
curl_setopt($curl,CURLOPT_PROXY,'1.1.1.1');
curl_setopt($curl,CURLOPT_PROXYPORT,'11111');
curl_setopt($curl,CURLOPT_URL,'https://checkcoverage.apple.com/');
$content=curl_exec($curl);
echo $content;

?>

