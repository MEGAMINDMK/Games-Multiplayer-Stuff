<?php
/* List of songs which will be streamed */
/* Remember to add a complete link to your songs collection */
$songs = [
    'http://localhost/vcmpsongs/1.mp3',
    'http://localhost/vcmpsongs/2.mp3',
	'http://localhost/vcmpsongs/3.mp3'
];
 
/* No need to change anything bellow */
set_time_limit(0);
$bitrate = 128;
$strContext=stream_context_create(
    array(
        'http'=>array (
            'method'=>'GET',
            'header'=>"Accept-language: en\r\n"
        )
    )
);
 
/* Some required header stuff for streaming audio in html */
header('Content-type: audio/mpeg');
header ("Content-Transfer-Encoding: binary");
header ("Pragma: no-cache");
header ("icy-br: " . $bitrate);
 
/* Infinite Loop which repeat once the final song reach to its end */
while( true ) {
    /* Loop to stream each song in the list */
    foreach ($songs as $song) {
        /* Script for streaming */
        $fpOrigin=fopen($song, 'rb', false, $strContext);
        while(!feof($fpOrigin)) {
            $buffer=fread($fpOrigin, 4096);
            echo $buffer;
            flush();
        }
        fclose($fpOrigin);
    }
}
?>
