<?php
	class TAC_Class {
		public $web_url = '';
		public $title_tag = '';
		public $title = '';
		public $version = '';
		public $type = '';
		public $database = null;
		public $database_connected = false;
		public $database_path = '';
		
		public function initialize( ) {
			require( 'config.php' );
			
			$this->web_url = $weburl;
			$this->title_tag = $titletag;
			$this->title = $title;
			$this->version = $version;
			$this->database_path = $databasepath;
			
			$this->connectDatabase();
			
			if ( !$this->database_connected ) {
				die( "Critical Error, cannot connect to database." );
			}
		}
		private function connectDatabase() {
			if ( empty( $this->database_path ) ) die( "Database hasn't been specified." );
			else if ( !file_exists( $this->database_path ) ) die ( "Database doesn't exists" );
			else if ( !in_array( "sqlite", PDO::getAvailableDrivers() ) ) die ( "SQLite drivers not found." );
			else {
				try {
					$this->database = new PDO('sqlite:'.$this->database_path );
					$this->database_connected = true;
				}
				catch(PDOException $error) {
					die( "Unable to connect to the database ".$error->getMessage() );
			  }
			}
		}
		public function SetTitle( ) {
			echo $this->title_tag.' | '.$this->GetPageName( ).' | V-'.$this->version;
		}
		
		public function GetPageName( ) {
			switch ( $this->type ) {
				case 'home':	return 'Home';
				case 'accounts':	return 'Accounts';
				case 'bans':	return 'Bans';
				case 'body_stats':	return 'Body Stats';
				case 'weapon_stats':	return 'Weapon Stats';
				case 'properties':	return 'Properties';
				case 'cars':	return 'Cars';
				case 'generate_signature':	return 'Generate Signature';
			}
		}
		
		public function Decide( $arg ) {
			switch( $arg ) {
				case 'home':
				case 'accounts':
				case 'bans':
				case 'body_stats':
				case 'weapon_stats':
				case 'properties':
				case 'cars':
				case 'generate_signature':
					$this->type = $arg;
				break;
				default:
					$this->type = 'home';
				break;
			}
		}
		
		public function Active( $arg ) {
			if ( $arg == $this->type ) {
				echo 'w3-dark-teal';
			}
			else {
				echo '';
			}
		}
		
		public function GetLink( $arg ) {
			echo 'index.php?action='.$arg;
		}
		
		public function processAction( ) {
			switch ( $this->type ) {
				case 'home':
					$this->ShowHome( );
				break;
				case 'accounts':
					$this->ShowAllAccounts( );
				break;
				case 'bans':
					$this->ShowAllBans( );
				break;
				case 'body_stats':
					$this->ShowAllBodyStats( );
				break;
				case 'weapon_stats':
					$this->ShowAllWeaponStats( );
				break;
				case 'properties':
					$this->ShowAllProperties( );
				break;
				case 'cars':
					$this->ShowAllCars( );
				break;
				case 'generate_signature':
					$this->ShowSignature( );
				break;
			}
		}
		
		private function ShowHome( ) {
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Welcome To TDCS Stats Pannel</h1>
				</div>
			';
		}
		
		private function ShowAllAccounts( ) {
			$query = "SELECT DISTINCT Name, Kills, Deaths, Cash, Bank, Joins, nogoto FROM Account ORDER BY Name";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Accounts</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>User</th>
					<th>Kills</th>
					<th>Deaths</th>
					<th>Cash</th>
					<th>Bank</th>
					<th>Joins</th>
					<th>NoGoto</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['Name'].'</th>
						<td>'.$rowData['Kills'].'</td>
						<td>'.$rowData['Deaths'].'</td>
						<td>'.$rowData['Cash'].'</td>
						<td>'.$rowData['Bank'].'</td>
						<td>'.$rowData['Joins'].'</td>
						<td>'.$rowData['nogoto'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
		
		private function ShowAllBans( ) {
			$query = "SELECT DISTINCT Name, Admin, Reason FROM Bans ORDER BY Name";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Bans</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>Banned User</th>
					<th>Banned By</th>
					<th>Banned Reason</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['Name'].'</th>
						<td>'.$rowData['Admin'].'</td>
						<td>'.$rowData['Reason'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
		
		private function ShowAllBodyStats( ) {
			$query = "SELECT DISTINCT Name, Body, Torso, LeftArm, RightArm, LeftLeg, RightLeg, Head FROM Bstats ORDER BY Name";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Body Stats</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>User</th>
					<th>Body</th>
					<th>Torso</th>
					<th>Left Arm</th>
					<th>Right Arm</th>
					<th>Left Leg</th>
					<th>Right Leg</th>
					<th>Head</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['Name'].'</th>
						<td>'.$rowData['Body'].'</td>
						<td>'.$rowData['Torso'].'</td>
						<td>'.$rowData['LeftArm'].'</td>
						<td>'.$rowData['RightArm'].'</td>
						<td>'.$rowData['LeftLeg'].'</td>
						<td>'.$rowData['RightLeg'].'</td>
						<td>'.$rowData['Head'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
		
		private function ShowAllWeaponStats( ) {
			$query = "SELECT DISTINCT Name, Fist, BrassKnuckle, ScrewDriver, GolfClub, NightStick, Knife, BaseballBat, Hammer, Cleaver, Machete, Katana, Chainsaw, Grenade, RemoteGrenade, TearGas, Molotov, Missile, Colt45, Python, Shotgun, Spaz, Stubby, Tec9, Uzi, Ingrams, MP5, M4, Ruger, SniperRifle, LaserScope, RocketLauncher, FlameThrower, M60 FROM Wstats ORDER BY Name";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Weapon Stats</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>User</th>
					<th>Fist</th>
					<th>BrassKnuckle</th>
					<th>ScrewDriver</th>
					<th>GolfClub</th>
					<th>NightStick</th>
					<th>Knife</th>
					<th>BaseballBat</th>
					<th>Hammer</th>
					<th>Cleaver</th>
					<th>Machete</th>
					<th>Katana</th>
					<th>Chainsaw</th>
					<th>Grenade</th>
					<th>RemoteGrenade</th>
					<th>TearGas</th>
					<th>Molotov</th>
					<th>Missile</th>
					<th>Colt45</th>
					<th>Python</th>
					<th>Shotgun</th>
					<th>Spaz</th>
					<th>Stubby</th>
					<th>Tec9</th>
					<th>Uzi</th>
					<th>Ingrams</th>
					<th>MP5</th>
					<th>M4</th>
					<th>Ruger</th>
					<th>SniperRifle</th>
					<th>LaserScope</th>
					<th>RocketLauncher</th>
					<th>FlameThrower</th>
					<th>M60</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['Name'].'</th>
						<td>'.$rowData['Fist'].'</td>
						<td>'.$rowData['BrassKnuckle'].'</td>
						<td>'.$rowData['ScrewDriver'].'</td>
						<td>'.$rowData['GolfClub'].'</td>
						<td>'.$rowData['NightStick'].'</td>
						<td>'.$rowData['Knife'].'</td>
						<td>'.$rowData['BaseballBat'].'</td>
						<td>'.$rowData['Hammer'].'</td>
						<td>'.$rowData['Cleaver'].'</td>
						<td>'.$rowData['Machete'].'</td>
						<td>'.$rowData['Katana'].'</td>
						<td>'.$rowData['Chainsaw'].'</td>
						<td>'.$rowData['Grenade'].'</td>
						<td>'.$rowData['RemoteGrenade'].'</td>
						<td>'.$rowData['TearGas'].'</td>
						<td>'.$rowData['Molotov'].'</td>
						<td>'.$rowData['Missile'].'</td>
						<td>'.$rowData['Colt45'].'</td>
						<td>'.$rowData['Python'].'</td>
						<td>'.$rowData['Shotgun'].'</td>
						<td>'.$rowData['Spaz'].'</td>
						<td>'.$rowData['Stubby'].'</td>
						<td>'.$rowData['Tec9'].'</td>
						<td>'.$rowData['Uzi'].'</td>
						<td>'.$rowData['Ingrams'].'</td>
						<td>'.$rowData['MP5'].'</td>
						<td>'.$rowData['M4'].'</td>
						<td>'.$rowData['Ruger'].'</td>
						<td>'.$rowData['SniperRifle'].'</td>
						<td>'.$rowData['LaserScope'].'</td>
						<td>'.$rowData['RocketLauncher'].'</td>
						<td>'.$rowData['FlameThrower'].'</td>
						<td>'.$rowData['M60'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
		
		private function ShowAllProperties( ) {
			$query = "SELECT DISTINCT Name, Cost, Owner, Shared FROM Props ORDER BY Name";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Accounts</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>Property Name</th>
					<th>Property Cost</th>
					<th>Property Owner</th>
					<th>Property Shared With</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['Name'].'</th>
						<td>'.$rowData['Cost'].'</td>
						<td>'.$rowData['Owner'].'</td>
						<td>'.$rowData['Shared'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
		
		private function ShowAllCars( ) {
			$query = "SELECT DISTINCT ID, Cost, Owner, Shared FROM Cars ORDER BY ID";
			$query_exe = $this->database->query( $query );
			$id = 1;
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<h1 style="text-decoration:underline dotted;font-weight: bold;">Accounts</h1>
				</div>
				<table class="w3-table-all w3-bordered w3-hoverable w3-panel w3-animate-zoom">
					<tr class="w3-teal">
					<th>#</th>
					<th>Car ID</th>
					<th>Car Cost</th>
					<th>Car Owner</th>
					<th>Car Shared With</th>
				</tr>
			';
			
			foreach( $query_exe as $rowData ) {
				echo '
					<tr class="w3-border-teal">
						<td class="w3-dark-grey">'.$id.'</td>
						<th>'.$rowData['ID'].'</th>
						<td>'.$rowData['Cost'].'</td>
						<td>'.$rowData['Owner'].'</td>
						<td>'.$rowData['Shared'].'</td>
					</tr>
				';
				$id++;
			}
				echo '
				</table>';
		}
	
		private function ShowSignature() {
			$this->currentTitle = "Signature";
			echo '
				<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
					<div class="w3-panel w3-animate-zoom w3-center w3-text-teal w3-wide">
						<h1 style="text-decoration:underline dotted;font-weight: bold;">Signature Generator</h1>
					</div>
					<h3>Enter Nickname</h3>
					<input class="w3-input" style="width: 446px; margin: auto; text-align: center; display: inline;" onkeyup="eval(this.value)" type="text" placeholder="Enter nickname..." />
					<h3>Signature</h3>
					<div class="sig">
						<img id="sigimg" src="sig.php" alt="Signature Image" />
						<textarea class="w3-input" style="width: 446px; height: 111px; margin: auto;" id="text3" cols="50" rows="5" onclick="this.focus();this.select()" readonly="readonly"></textarea>
					</div>
					<div class="w3-half" style="min-width: 450px">
						<h3>BBC Code</h3>
						<textarea class="w3-input" style="width: 446px; margin: auto;" id="text1" cols="50" rows="5" onclick="this.focus();this.select()" readonly="readonly"></textarea>
					</div>
					<div class="w3-half" style="min-width: 450px">
						<h3>HTML Code</h3>
						<textarea class="w3-input" style="width: 446px; margin: auto;" id="text2" cols="50" rows="5" onclick="this.focus();this.select()" readonly="readonly"></textarea>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						$( ".sig textarea" ).hide();
						$( ".sig" ).hover (
							function() {
								$( ".sig img" ).hide();
								$( ".sig textarea" ).show();
							},
							function () {
								$( ".sig textarea" ).hide();
								$( ".sig img" ).show();
							}
						);
					});
				</script>
				<script type="text/javascript">
					function eval( str ) {
						 var html5 = document.getElementById("text2");
						 html5.value = \'<img src="'.$this->web_url.'sig.php?nick=\'+str+\'" alt="Signature" />\';
						 
						 var bbc = document.getElementById("text1");
						 bbc.value = "[img]'.$this->web_url.'sig.php?nick="+str+"[/img]";
							 
						 var bbc = document.getElementById("text3");
						 bbc.value = "[img]'.$this->web_url.'sig.php?nick="+str+"[/img]";
							 
						 var img_sig = document.getElementById("sigimg");
						 img_sig.src = "'.$this->web_url.'sig.php?nick="+str;
					}
				</script>
			';
		}
		
		public function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
			for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
			for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
			$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
			
			return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
		}
	};
	
	
?>