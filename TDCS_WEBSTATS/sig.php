<?php
	include('class.php');
	global $TAC;
	$TAC = new TAC_Class;
	$TAC->initialize( );
	
	$im = imagecreatefrompng("images/sig-tdcs.png") or die( "Cannot create a GD Image" );	
	imagealphablending($im, true); 
	header('Content-Type: image/png');
	
	
	$color_white = imagecolorallocate( $im, 255, 255, 255  );
	$color_black = imagecolorallocate( $im, 0, 0, 0 );
	$color_pink = imagecolorallocate( $im, 242, 75, 237 );
	
	
	
//	$fontA = "fonts/fontA.ttf";
	//$fontB = "fonts/fontB.ttf";
//	$fontC = "fonts/fontC.ttf";
	
	$fontA=realpath('fonts/fontA.ttf');
	$fontB=realpath('fonts/fontB.ttf');
	$fontC=realpath('fonts/fontC.ttf');
	
	
	if ( isset( $_REQUEST[ 'nick' ] ) ) {
		$nick = $_REQUEST[ 'nick' ];
		$query = "SELECT DISTINCT Kills, Deaths, Joins FROM Account WHERE Name LIKE '".$nick."'";
		$query_exe = $TAC->database->query( $query );
		$exists = false;
		
		foreach( $query_exe as $rowData ) {
			$exists = true;
			$kills = $rowData[ 'Kills' ];
			$deaths = $rowData[ 'Deaths' ];
			$joins = $rowData[ 'Joins' ];
			$ratio = $kills > 0 && $deaths > 0 ? round( $kills / $deaths, 2 ) : 0;
		}
		if ( $exists ) {
			imagettftext( $im, 20, 0, 28, 35, $color_black, $fontA, $nick ); $TAC->imagettfstroketext($im, 20, 0, 25, 32, $color_white, $color_pink, $fontA, $nick, 1); 
			imagettftext( $im, 11, 0, 10, 98, $color_black, $fontB, $kills ); imagettftext( $im, 11, 0, 8, 96, $color_white, $fontB, $kills ); 
			imagettftext( $im, 11, 0, 116, 98, $color_black, $fontB, $deaths ); imagettftext( $im, 11, 0, 114, 96, $color_white, $fontB, $deaths ); 
			imagettftext( $im, 11, 0, 226, 98, $color_black, $fontB, $joins ); imagettftext( $im, 11, 0, 224, 96, $color_white, $fontB, $joins ); 
			imagettftext( $im, 11, 0, 300, 98, $color_black, $fontB, $ratio ); imagettftext( $im, 11, 0, 298, 96, $color_white, $fontB, $ratio ); 
		}
		
		else{ imagettftext($im, 20, 0, 28, 35, $color_black, $fontA, "Not Found" );}				
	}
	else {
		imagettftext( $im, 20, 0, 28, 35, $color_black, $fontA, "Not Found" );
	}
	
	imagepng($im);
	
	imagedestroy($im);
?>