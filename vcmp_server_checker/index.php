<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
error_reporting(0);
function ip_details($IPaddress) 
{
    $json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
    $details    = json_decode($json);
    return $details;
}

$IPaddress  =  $_SERVER['REMOTE_ADDR'];
$Portsaddress = '5192';

$details    =   ip_details("$IPaddress");

$page = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
$ipInfo = file_get_contents("http://ipinfo.io/");
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
require_once('vcmp.php');
$ip = $_POST["ip"];
$port = $_POST["ports"];
$server = new Server($ip, $port);
echo "<form action='' method='POST'>
<input type='text' placeholder='$IPaddress' value='$IPaddress' name='ip'/>
<input type='text' placeholder='$Portsaddress' value='$Portsaddress' name='ports'/>
<input type='submit' value='search'/>
</form>";?>