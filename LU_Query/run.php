<?php
// URLs of the server lists
$url1 = 'http://54.37.139.6/servers.txt';
$url2 = 'http://masterlist.liberty-unleashed.co.uk/servers.txt';

// Function to fetch and parse server list from a URL
function fetchServers($url) {
    $servers = file_get_contents($url);
    return explode("\n", trim($servers));
}

// Fetch servers from both URLs
$serversList1 = fetchServers($url1);
$serversList2 = fetchServers($url2);

// Merge the two lists and remove duplicates
$mergedServers = array_unique(array_merge($serversList1, $serversList2));

// Save the new list to a file
$outputFile = 'servers.txt';
file_put_contents($outputFile, implode("\n", $mergedServers));

echo "New list of servers has been created in <a href='$outputFile'>$outputFile</a>";
?>
