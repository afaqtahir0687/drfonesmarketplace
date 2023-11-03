<?php
set_time_limit(0);
$proxies = file("proxies.txt");
$working = "";
foreach($proxies as $proxy)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://www.cpanel.net/showip.cgi");
  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
  curl_setopt($ch, CURLOPT_PROXY, trim($proxy));
  curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $result = curl_exec($ch);
  if($result !== false)
  {
    $working .= trim($proxy) . "\r\n";
  }
  curl_close($ch);    
}
if(!empty($working))
  file_put_contents("working.txt", $working);
?>
