<?php
//Include the Class
include("LU.Class.php");
//Display Skin Images? (Set this to false if you didn't downloaded the Skin Images)
$skins = true;
//Function to convert from GTA3 to the Map
function CalculateAbsoluteX( $relative_x )
{
	return 402 + ( $relative_x / 4.992 );
}

function CalculateAbsoluteY( $relative_y )
{
	return 234 - ( $relative_y / 4.927 );
}
?>
<html>
<head>
<title>Liberty Unleashed Live Map</title>
<style>
body { background: #C6DEE2; }
</style>
<script language="Javascript" type="text/javascript">
function ShowPlayerInfo(Name,ID,HP,Armour,Skin) {
	var DivBox = document.getElementById('PlayerInfo');
<?php
	if ($skins) echo 'DivBox.innerHTML = "<b>Player:</b> " + Name + "<br/><b>ID:</b> " + ID + "<br/><b>Health:</b> " + HP + "%<br/><b>Armour:</b> " + Armour + "%<br/><b>Skin:</b> <img ALIGN=\"top\" src=\"skins/" + Skin + ".jpg\">";';
	else echo 'DivBox.innerHTML = "<b>Player:</b> " + Name + "<br/><b>ID:</b> " + ID + "<br/><b>Health:</b> " + HP + "%<br/><b>Armour:</b> " + Armour + "%";';
?>
}
</script>
</head>
<body>
<img border="0" src="gta3map.gif" style="z-index: 1" alt="Liberty Unleashed Live Map" />
<?php
$q = new LUQuery("182.187.155.109",2301);
if ($q->IsAlive()) {
$d = $q->GetInfo();
echo '<div id="ServerInfo" style="text-align: center; position: absolute; left: 820px; top: 150px; font: 10px verdana;">
<b>' . $d["ServerName"] . '</b><br/>
<b>Players:</b> ' . $d["ServerPlayers"] . '/' . $d["ServerMaxPlayers"] . '<br/>
<b>Game Mode:</b> ' . $d["ServerMode"] . '<br/><br/><hr/><br/><br/>
<div id="PlayerInfo" style="text-align: left;"></div>
</div>
';
if ($d["ServerPlayers"] >= 1)
{
	for($i = 1; $i <= $d["ServerPlayers"]; $i++)
	{
		echo '<span title="'.$d["Player"][$i]["Nick"].'" onmouseover="ShowPlayerInfo(\''.$d["Player"][$i]["Nick"].'\','.$d["Player"][$i]["ID"].','.$d["Player"][$i]["Health"].','.$d["Player"][$i]["Armour"].','.$d["Player"][$i]["Skin"].');">';
		echo '<img style="position: absolute; top: '.CalculateAbsoluteY($d["Player"][$i]["Pos"]["Y"]).'px; left: '.CalculateAbsoluteX($d["Player"][$i]["Pos"]["X"]).'px;" alt="'.$d["Player"][$i]["Nick"].'" src="Dot_Red.png">';
		echo '</span>';
	}
}
}
?>

</body>
</html>