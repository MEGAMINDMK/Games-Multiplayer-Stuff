<?php
	include('class.php');
	global $TAC;
	$TAC = new TAC_Class;
	$TAC->initialize( );
?>
<?php
	if ( isset( $_REQUEST['action'] ) ) {
	$a = strtolower( $_REQUEST['action'] );
	$TAC->Decide( $a );
	}
?>

<!DOCTYPE html>
<html class="">
	<head>
		<title>
			<?php $TAC->SetTitle( ); ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/tac.png" type="image/x-icon">
		<link rel="stylesheet" href="styles/w3.css">
    <script type="text/javascript" src="js/jquery.js"></script>
	</head>
	<body style="min-width: 540px; padding-top: 38px; padding-bottom: 70px;" class="w3-light-grey w3-margin-left w3-margin-right">

	<?php include('navigation.php'); ?>
	<?php
		if ( isset( $_REQUEST['action'] ) ) {
			$TAC->processAction( );
		}
	?>

	<?php include('footer.php'); ?>
	</body>
</html>