<!DOCTYPE html>
<html> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CitizenMP:IV Reloaded</title>
<link rel="icon" href="https://citizeniv.net/assets/favicon-f3hd0xob.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<style>
*
{
  margin: 0;
  padding: 0;
}
body {
   background-image: url(https://images.sftcdn.net/images/t_app-cover-l,f_auto/p/b5210230-9b28-11e6-a08f-00163ed833e7/210366551/packetoverloads-gta4-wallpaper-vol2-0-screenshot.jpg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-color: white;
  background-attachment: fixed;
}
.container
{
  margin-top: 20px;
  height: 100%;
}
.content
{
  width: 900px;
  padding-top: 1px;
  padding-bottom: 100px;
  margin-left: auto;
  margin-right: auto;
  font-family: Tahoma;
  font-size: 11px;
  line-height: 17px;
  color: #FFF;
  margin-bottom: 40px;
}
.center
{
  text-align: center;
  margin: 0 auto;
},.content h1
{
  font-family: "Trebuchet MS",serif;
  padding: 0;
  margin: 0;
  margin-bottom: 5px;
  margin-top: 16px;
  color: #FFF;
}
.content h1
{
  font-size: 18px;
}
.content p
{
  margin-top: 13px;
  margin-bottom: 13px;
}
legend
{
  color: #FFF;
  font-family: Tahoma;
  font-weight: 700;
  font-size: 11px;
  text-shadow: 1px 1px 1px #000;
  text-decoration: none;
  margin-left: 5px;
  padding-left: 5px;
  margin-right: 5px;
  padding-right: 5px;
}
fieldset
{
  border: 1px solid #326192;
  padding: 10px;
}
input
{
  border: 1px solid red;
  background-color: black;
  color: #FFF;
  font-family: "Courier New",monospace;
  font-size: 32px;
  padding: 5px;
}
input[type=submit]
{
  padding: 6px;
  font-size: 20px;
  font-family: Tahoma,sans-serif;
  text-shadow: 1px 1px 1px #000;
}
.column
{
  float: left;
  width: 430px;
  padding: 10px;
  margin-bottom: 20px;
}
.error
{
  width: 300px;
}
.green
{
  color: #0F0;
  font-weight: 700;
}
.red
{
  color: red;
  font-weight: 700;
}
.footer
{
  position: fixed;
  bottom: 0;
  height: 20px;
  margin: 0 auto;
  width: 100%;
  background: black;
}
.footer p
{
  text-align: center;
  margin: 0 auto;
  color: #FFF;
  font-size: 15px;
}
</style>
</head>

<body>
	<div class="container">
		<div class="content"><br><br><br><br><br><br><br>
			<h1 class="center"> <img src="https://citizeniv.net/assets/logo-fvfir2vd.png"width="300" height="80">
			<br>CitizenIV-FX Reloaded Connection Checker</h1>
			<div class="center">
				<form id="check" action="" method="post">
				<p>
						<input name="IP" type="text" placeholder="ip/domain" size="21">
						<input name="PORTS" type="text" placeholder="ports" size="7">
					</p>
					<p>
						<input type="submit" id="bCheck" value="Check your server!" />
					</p>
					</p>
				</form>
				<?php 
				error_reporting(0);
			$host = $_POST["IP"];
        //    $ports = array(4200);
			$ports = $_POST["PORTS"];
			//foreach ($ports as $port)
//{
    $connection = @fsockopen($host, $ports);?>

					<p>
						<input name="IP" type="text" value="<?php echo "" . $host . ":" . $ports . "";?>" readonly size="21">
					</p>
					<p>
						<input type="button" id="bCheck" value="<?php if (is_resource($connection))
    {
      //  echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";
        echo "Online";
        fclose($connection);
    }
    else
    {
        echo "Offline";
    }
//}
			?>" size="7"/>
			</div>
		</div>
		<div class="footer">
			<p>&copy; 2019 MEGAMIND  &bull; All rights reserved</p>
		</div>
	</div>
</body>
</html>
