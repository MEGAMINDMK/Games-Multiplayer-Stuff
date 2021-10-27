<?php
/*if ($_SERVER["REQUEST_METHOD"] != "POST")
{
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
}



if (!array_key_exists("port",$_POST))
{
    bad_request();
}
if ($_SERVER["HTTP_USER_AGENT"] != "VCMP/0.4")
{
    header("HTTP/1.0 403 Forbidden");
    exit();
}*/
//$port = (int)$_POST["port"];
$port = "5192";
if ($port <= 0)
    bad_request();

$ip = $_SERVER["REMOTE_ADDR"];
$socket = fsockopen("udp://" . $ip, $port);
if ($socket)
{
    $packet  = "VCMP";
    $packet .= chr(strtok($ip, "."));
    $packet .= chr(strtok("."));
    $packet .= chr(strtok("."));
    $packet .= chr(strtok("."));
    $packet .= chr($port & 0xFF);
    $packet .= chr($port >> 8 & 0xFF);
    fwrite($socket, $packet . "i");

    stream_set_timeout($socket, 5);
    $magic = fread($socket, 4);

    $info = stream_get_meta_data($socket);
    fclose($socket);

    if ($info["timed_out"] || empty($magic))
    {
        header("HTTP/1.0 408 Request Timeout");
        exit();
    }

    if ($magic != "MP04")
        bad_request();

    AddtoDB($ip, $port);
}

function bad_request()
{
    header("HTTP/1.0 400 Bad Request");
    exit();
}

function AddtoDB($ip, $port)
{
    if ($db = new PDO('sqlite:database.db'))
    {
        $db->exec("CREATE TABLE IF NOT EXISTS list (ip TEXT, port INTEGER, is_official BOOL NOT NULL)");
        $q = $db->query("SELECT * FROM list WHERE ip = '" . $ip . "' AND port = " . $port);
       // if (!$q->fetchArray())
			 if (!$q->fetch())
        {
            $db->query("REPLACE INTO list (ip, port, is_official) VALUES ('" . $ip . "', '" . $port . "', 0)");
        }
        else
            $q = null;
    }
    else
    {
        header("HTTP/1.0 500 Internal Server Error");
    }
}
?>
