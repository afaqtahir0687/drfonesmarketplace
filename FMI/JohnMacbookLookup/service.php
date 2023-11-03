<?php
header("Content-type: text/html");

include("apis.php");

$type = isset($_GET["type"]) ? $_GET["type"] : null;
$code = isset($_GET["code"]) ? $_GET["code"] : null;

if($type && $code)
{
  switch($type)
  {

    case 'macbook': 
    {
      $rets = macbook($code);
      $data = "";
      foreach($rets as $name => $value)
      {
        if($name === "Image")
        {
          if(!empty(trim($value)))
            $data .= "<img src=\"$value\" alt=\"*\"/><br><br>\r\n";
        }
        else
        {
          if(!empty(trim($value)))
            $data .= "{$name}: {$value}<br>\r\n";
        }
      }
      echo $data;
      break;
    }
   
  }
}

exit();
?>
