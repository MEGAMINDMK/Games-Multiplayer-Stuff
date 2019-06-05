<title>CitizenMP:IV Reloaded</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="icon" href="https://citizeniv.net/images/favicon.ico" type="image/x-icon">
<style>
body {
   background-image: url(https://citizeniv.net/images/Light-in-the-Dark/back.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  background-color: white;
  background-attachment: fixed;
}
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   
   color: white;
   text-align: center;
}
</style>
<?php
function converter( $iniCode ) {
    $convertedCode = null;
    
    $tempIni = tmpfile();
    fwrite($tempIni, $iniCode);
    fseek($tempIni, 0);
    
    $metaDatas = stream_get_meta_data($tempIni);
    $tmpFilename = $metaDatas['uri'];
    $iniScript = parse_ini_file($tmpFilename,true);
    
    foreach($iniScript as $script => $scriptArr)
        ( !$convertedCode )        ?        $convertedCode = '<center><h1><font color="Violet"><b>CitizenMP:IV Reloaded</b></font></h1>
<h2><font color="SlateBlue"><b>Converted Map from (map.ini to Source)</b></font></h2><font color="white">
SpawnObject( '.$scriptArr['Model'].', '.$scriptArr['x'].', '.$scriptArr['y'].', '.$scriptArr['z'].', '.$scriptArr['h'].', '.$scriptArr['qx'].', '.$scriptArr['qy'].', '.$scriptArr['qz'].', '.$scriptArr['qw'].', false, true) </br>'        :        $convertedCode .= 'SpawnObject( '.$scriptArr['Model'].', '.$scriptArr['x'].', '.$scriptArr['y'].', '.$scriptArr['z'].', '.$scriptArr['h'].', '.$scriptArr['qx'].', '.$scriptArr['qy'].', '.$scriptArr['qz'].', '.$scriptArr['qw'].', false, true) </br>';
    
    fclose($tempIni);
    
    return $convertedCode;
}
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
    echo converter( $_POST['input'] );
else
    echo '<br><center>
<h1><font color="Violet"><b>CitizenMP:IV Reloaded</b></font></h1>
<h2><font color="SlateBlue"><b>Map Converter (map.ini to Source)</b></font></h2>
    <form method="post">
       <textarea name="input" rows="20" cols="100" placeholder="Example Code :
[1]
x=-1039.68 
y=1445.41
z=40.0397
h=88.6292
Model=1859734186
qx=0.15145
qy=0.14787
qz=0.682769
qw=0.699303
offz=674.517
Dynamic=0" required></textarea>
        <br>
		<input type="submit" value="Get Awsome Output" class="btn btn-danger">
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Clear" class="btn btn-primary">
    </form>
    ';
?>
<font color="white">Copyright &copy; 2017<script>new Date().getFullYear()>2017&&document.write("-"+new Date().getFullYear());</script>, MEGAMIND &bull; All rights reserved</font>
