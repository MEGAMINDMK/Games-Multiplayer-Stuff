
<?php
error_reporting(0);
function ip_details($IPaddress) 
{
    $json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
    $details    = json_decode($json);
    return $details;
}

//$IPaddress  =  $_SERVER['REMOTE_ADDR'];
//$IPaddress  =  'wno-host.ddns.net';
$IPaddress = gethostbyname('wno-host.ddns.net');
$details    =   ip_details("$IPaddress");

 $page = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
$ipInfo = file_get_contents("http://ipinfo.io/");
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
require_once('vcmp.php');
$ip = $IPaddress;
$port = $_POST["ports"];
if(isset($_POST['ports']))
  {
	 $server = new Server($IPaddress, $port);
  }
  else{
    echo 'If you see a blank screen it means your server is offline';
  }
//$server = new Server($IPaddress, $port);
echo "<form action='index.php' method='POST'>
<input type='text' placeholder='$IPaddress' name='ip' disabled/>
<input type='text' name='ports'/>
<input type='submit' value='search'/>
</form>";?>