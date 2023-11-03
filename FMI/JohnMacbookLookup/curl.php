<?php
function getproxy()
{
  $proxies = file("working.txt");
  return $proxies[rand(0, count($proxies) - 1)];
}

function curl($url, $fields = null, $h = true, $f = false)
{
  $fields_string = '';

  if($fields !== null)
  {
    foreach($fields as $key => $value)
    {
      $fields_string .= $key . '=' . $value . '&';
    }
    
    $fields_string = rtrim($fields_string, '&');
  }

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  if($fields !== null)
  {
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  }

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  
  if($f)
  {
    $proxy = getproxy();
    curl_setopt($ch, CURLOPT_PROXY, "socks5://$proxy");
  }

  if($h)
  {
    curl_setopt($ch, CURLOPT_HEADER, 1);
  }

  $result = curl_exec($ch);

  if($h)
  {
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($result, 0, $header_size);

    $datas = curl_getinfo($ch);
  }
  
  curl_close($ch);

  if($h)
  {
    return ['body' => $result, 'header' => $header];
  }
  else
  {
    return ['body' => $result];
  }
}

?>
