<?php
set_time_limit(0);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.socks-proxy.net/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

preg_match_all("/<tr><td>(.*?)<\/td><td>(.*?)<\/td>/", $data, $matches);
$proxies = "";
for($i = 0; $i < count($matches[1]); $i++)
{
  if(!empty($matches[1][$i]) && !empty($matches[2][$i]))
    $proxies .= $matches[1][$i] .":" . $matches[2][$i] . "\r\n";
}
if(!empty($proxies))
  file_put_contents("proxies.txt", trim($proxies));
?>
