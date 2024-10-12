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
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to fetch servers from a remote URL
function fetch_servers() {
    $url = 'http://localhost:90/LU_Query/servers.txt'; // URL to get the server list
    $response = file_get_contents($url);

    if ($response === false) {
        die("Unable to contact server list.");
    }

    // Split the response by lines
    $lines = explode("\n", trim($response));
    $servers = [];
    
    // Parse each line for IP and port
    foreach ($lines as $line) {
        list($ip, $port) = explode(':', $line);
        $servers[] = ['ip' => $ip, 'port' => intval($port)];
    }

    return $servers;
}

// Function to query the server
function queryServer($ip, $port) {
    // Query the server using the LUQuery class
    $q = new LUQuery($ip, $port);
    
    if ($q->IsAlive()) {
        return $q->GetInfo();
    } else {
        return false;
    }
}

// Function to display server details
function display_server_info($server) {
    $data = queryServer($server['ip'], $server['port']);

    if ($data) {
        $Game = ($data["GameID"] == 1) ? "Liberty Unleashed" : "Vice Unleashed"; // For future use

        echo '<table width="500" align="center">
        <thead><tr><th scope="col"><b>' . $data["ServerName"] . '</b></th></tr></thead></table>
        <table width="500" align="center">
        <tbody>
        ';

        if ((isset($data["ServerMaxPlayers"])) && (isset($data["ServerPlayers"]))) {
            echo '<tr><td>Players</td><td>' . $data["ServerPlayers"] . '/' . $data["ServerMaxPlayers"] . '</td></tr>';
        }
        if (isset($data["GameID"])) {
            echo '<tr><td>Game</td><td>' . $Game . '</td></tr>';
        }
        if (isset($data["ServerMode"])) {
            echo '<tr><td>Game Mode</td><td>' . $data["ServerMode"] . '</td></tr>';
        }
        if (isset($data["ServerMap"])) {
            echo '<tr><td>Map</td><td>' . $data["ServerMap"] . '</td></tr>';
        }
		if ((isset($data["Player"])) && (isset($data["Ping"]))) {
            echo '<tr><td>Ping</td><td>' . $data["Ping"] . '</td></tr>';
        }
		
        echo '</tbody></table>';
        echo '<table width="500"><tfoot><td></td></tfoot></table><br/>';

        // Player details
        if ($data["ServerPlayers"] >= 1) {
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

            for ($i = 1; $i <= $data["ServerPlayers"]; $i++) {
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
            echo '<table width="500"><tfoot><td></td></tfoot></table><br><br>';
        }
    } else {
       // echo "<center><h2>Server is down</h2></center>";
    }
}

// Fetch the server list and display information for each server
$servers = fetch_servers();

foreach ($servers as $server) {
    display_server_info($server);
}
?>
