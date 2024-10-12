<?php
//Include the Class
include("LU.Class.php");
?>
<html>
<head>
<title>LU Query</title>
<style>
table {
		border-collapse:collapse;
		background:#EFF4FB;
		border-left:1px solid #686868;
		border-right:1px solid #686868;
		font:0.8em/145% 'Trebuchet MS',helvetica,arial,verdana;
		color: #333;
		margin-left:auto;
		margin-right:auto;
}
tbody th, tbody td {
		border-bottom: dotted 1px #333;
}
tbody th {
		white-space: nowrap;
}
tbody tr:hover {
		background:#fafafa;
}
thead th {
		background:#333 url(llsh.gif) repeat-x;
		color:#fff
}
tfoot td {
		background:#333 url(llsf.gif) repeat-x;
		color:#fff
}
tr.header {
		padding: 10px;
}
</style>
</head>
<body>
<br/><center><img src="LU Banner.png"/></center>
<?php
//The actual query
$q = new LUQuery("182.187.155.109",2301);
if ($q->IsAlive()) { //Check if server is online
$data = $q->GetInfo(); //Query the server and storing the info into an variable
$Game = ($data["GameID"] == 1) ? "Liberty Unleashed" : "Vice Unleashed"; //Not really needed yet, since VU isn't released.
echo '<table width="500" align="center">
<thead><tr><th scope="col"><b>' . $data["ServerName"] . '</b></th></tr></thead></table>
<table width="500" align="center">
<tbody>
';
if ((isset($data["ServerMaxPlayers"])) && (isset($data["ServerPlayers"]))) echo '<tr><td>Players</td><td>' . $data["ServerPlayers"] . '/' . $data["ServerMaxPlayers"] . '</td></tr>';
if (isset($data["GameID"])) echo '<tr><td>Game</td><td>' . $Game . '</td></tr>';
if (isset($data["ServerMode"])) echo '<tr><td>Game Mode</td><td>' . $data["ServerMode"] . '</td></tr>';
if (isset($data["ServerMap"])) echo '<tr><td>Map</td><td>' . $data["ServerMap"] . '</td></tr>';
echo '</tbody></table>';
echo '<table width="500"><tfoot><td></td></tfoot></table><br/>';
if ($data["ServerPlayers"] >= 1)
{
	$headers = null;
	if (isset($data["Player"][1]["ID"])) $headers .= '<td><b>ID</b></td>';
	if (isset($data["Player"][1]["Nick"])) $headers .= '<td><b>Nickname</b></td>';
	if (isset($data["Player"][1]["Team"])) $headers .= '<td><b>Team ID</b></td>';
	if (isset($data["Player"][1]["Score"])) $headers .= '<td><b>Score</b></td>';
	if (isset($data["Player"][1]["Kills"])) $headers .= '<td><b>Kills</b></td>';
	if (isset($data["Player"][1]["Deaths"])) $headers .= '<td><b>Deaths</b></td>';
	if (isset($data["Player"][1]["Ping"])) $headers .= '<td><b>Ping</b></td>';
	echo '<table width="500" align="center">';
	echo '<thead><tr><th scope="col">Players</th></tr></thead></table>';
	echo '<table width="500" align="center">';
	echo '<tbody>';
	echo '<tr class="header">'.$headers.'</tr>';
	for($i = 1; $i <= $data["ServerPlayers"]; $i++)
	{
		echo '<tr>';
		if (isset($data["Player"][$i]["ID"])) echo '<td>' . $data["Player"][$i]["ID"] . '</td>';
		if (isset($data["Player"][$i]["Nick"])) echo '<td>' . $data["Player"][$i]["Nick"] . '</td>';
		if (isset($data["Player"][$i]["Team"])) echo '<td>' . $data["Player"][$i]["Team"] . '</td>';
		if (isset($data["Player"][$i]["Score"])) echo '<td>' . $data["Player"][$i]["Score"] . '</td>';
		if (isset($data["Player"][$i]["Kills"])) echo '<td>' . $data["Player"][$i]["Kills"] . '</td>';
		if (isset($data["Player"][$i]["Deaths"])) echo '<td>' . $data["Player"][$i]["Deaths"] . '</td>';
		if (isset($data["Player"][$i]["Ping"])) echo '<td>' . $data["Player"][$i]["Ping"] . '</td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
	echo '<table width="500"><tfoot><td></td></tfoot></table>';
}
}
else {
echo "<center><h2>Server is down</h2></center>";
}
?>

</table>
</body>
</html>