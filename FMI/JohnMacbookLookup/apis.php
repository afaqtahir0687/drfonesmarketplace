<?php
include("curl.php");

error_reporting(0);


function macbook($sn)
{
  curl("https://www.thebookyard.com/");
  $hash = curl("https://www.thebookyard.com/apple_serial_decode.php", null, false, false, "https://www.thebookyard.com/");
  $hash = $hash["body"];
  $ip = file_get_contents("http://api.unlockers.pro/ip.php");
  
  preg_match_all("/hash=(.*?)+ipadd/i", $hash, $matches);
  if(!empty($matches[0][0]))
  {
    $hash = $matches[0][0];
    $hash = str_replace("hash=", "", $hash);
    $hash = str_replace("\"+ipadd", "", $hash);
  }
  
  $headers = array();
  $headers[] = "Origin: https://www.thebookyard.com";
  $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36";
  $headers[] = "X-Requested-With: XMLHttpRequest";
  $headers[] = "DNT: 1";
  $headers[] = "Referer: https://www.thebookyard.com/apple_serial_decode.php";
  
  $url = "https://www.thebookyard.com/serial_ajax.php";
  $fields = array(
	  'action' => urlencode("mainpage"),
	  'data' => urlencode($sn),
	  'aref' => urlencode("1"),
	  'hash' => urlencode($hash),
	  'ip' => urlencode($ip)
  );

  $data = curl($url, $fields, false, false, "https://www.thebookyard.com/serial_ajax.php", $headers);
  $data = $data["body"];

  preg_match("/src=\"(.*?)\"/i", $data, $matches);
  if(!empty($matches[1]))
  {
    $image = "https://www.thebookyard.com/" . $matches[1];
  }
  
  preg_match_all("/snmFielddata'>(.*?)<\/div/", $data, $matches);

  $result = array();
  if(!empty($image))
  {
 //   $result["Image"] = $image;
  }
  $result["Apple Range"] = trim(strip_tags($matches[1][0]));
  $result["Family no."] = trim(strip_tags($matches[1][2]));
  $result["EMC no."] = trim(strip_tags($matches[1][3]));
  $result["Configuration"] = trim(strip_tags($matches[1][4]));
  $result["Part number"] = trim(strip_tags($matches[1][5]));
  $result["Machine ID"] = trim(strip_tags($matches[1][6]));
  $result["Introduced"] = trim(strip_tags($matches[1][7]));
  $result["Discontinued"] = trim(strip_tags($matches[1][8]));

  $result["Manufactured"] = trim(strip_tags($matches[1][9]));
  $result["Weight"] = trim(strip_tags($matches[1][10]));
  $result["Dimensions"] = trim(strip_tags($matches[1][11]));
  preg_match_all("/snmFielddata'>(.*?)<\/div/", $data, $matches);
  $result["Processor"] = trim(strip_tags($matches[1][12]));
  $result["Memory slots"] = trim(strip_tags($matches[1][13]));
  $result["Built-in Mem"] = trim(strip_tags($matches[1][14]));
  $result["Max memory"] = trim(strip_tags($matches[1][15]));
  $result["Battery"] = trim(strip_tags($matches[1][16]));
  $result["Original OS"] = trim(strip_tags($matches[1][17]));
  $result["Last supported OS"] = trim(strip_tags($matches[1][18]));
  $result["Graphics"] = trim(strip_tags($matches[1][19]));
  $result["Internal screen"] = trim(strip_tags($matches[1][20]));
  $result["Resolution"] = trim(strip_tags($matches[1][21]));
  $result["2nd display"] = trim(strip_tags($matches[1][22]));
  $result["Max external resolution"] = trim(strip_tags($matches[1][23]));
  $result["USB ports"] = trim(strip_tags($matches[1][24]));
  $result["USB ports"] = trim(strip_tags($matches[1][25]));
  $result["FireWire ports"] = trim(strip_tags($matches[1][26]));
  $result["Ethernet"] = trim(strip_tags($matches[1][27]));
  $result["Airport type"] = trim(strip_tags($matches[1][28]));
  $result["Bluetooth type"] = trim(strip_tags($matches[1][29]));
  $result["Hard disk type"] = trim(strip_tags($matches[1][30]));
  $result["Capacity"] = trim(strip_tags($matches[1][31]));
  $result["Optical drive"] = trim(strip_tags($matches[1][32]));
  $result["Expansion"] = trim(strip_tags($matches[1][33]));




  return $result;
}
function kmapple($sn)
{
  $data = curl("https://km.support.apple.com/kb/index?page=categorydata&serialnumber=$sn&callback=ACSpecSearch.categoryDataProcess", null, false);
  $obj = json_decode(trim($data['body']));

  $id = $obj->{'id'};
  $name = $obj->{'name'};
  $grandparent = $obj->{'grandparent'};
  $greatgrandparent = $obj->{'greatgrandparent'};

  $data = curl("https://km.support.apple.com/kb/index?page=specs_browse&facet=all&category={$id}&locale=en_US&isSerialNumberSearch=true&parent={$parent}&grandparent={$grandparent}&greatgrandparent={$greatgrandparent}", null, false);
  $obj = json_decode(trim($data['body']));

  $specs = $obj->{'specs'};
  
  $image = "https://km.support.apple.com" . $specs[0]->{'thumbnail'};
  $prodname = $specs[0]->{'prodName'};
  $lastmodified = $specs[0]->{'lastmodified'};
  
  $result = array();
  if(!empty($image))
  {
    $result["Image"] = $image;
  }

  $result["Product name"] = $prodname;
  $result["Last modified"] = $lastmodified;

  return $result;
}

?>
