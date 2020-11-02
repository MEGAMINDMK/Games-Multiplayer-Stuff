<title>Player - Data</title>
<link rel="icon" href="images/tac.png" type="image/x-icon">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<table>
    <tr>
	<th>Name</th>
        <!--th>User</th-->
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

<?php
include('../db.php');
$search_value=$_POST["search"];

        $sql="SELECT * from wstats where Name like '%$search_value%'";

        $res=$conn->query($sql);

        while($row=$res->fetch_assoc()){?>
		
       <tr>
		<td><?php echo "<font color='red'>". $row["Name"]. "</font>";?></td>
		<!--td><?php echo "<font color='green'>". $row["User"]. "</font>";?></td-->
		<td><?php echo "<font color='blue'>". $row["Fist"]. "</font>";?></td>
		<td><?php echo "<font color='yellow'>". $row["BrassKnuckle"]. "</font>";?></td>
		<td><?php echo "<font color='brown'>". $row["ScrewDriver"]. "</font>";?></td>
		<td><?php echo "<font color='cyan'>". $row["GolfClub"]. "</font>";?></td>
		<td><?php echo "<font color='teal'>". $row["NightStick"]. "</font>";?></td>
		<td><?php echo "<font color='purple'>". $row["BaseballBat"]. "</font>";?></td>
		<td><?php echo "<font color='indigo'>". $row["Hammer"]. "</font>";?></td>
		<td><?php echo "<font color='violet'>". $row["Cleaver"]. "</font>";?></td>
		<td><?php echo "<font color='orange'>". $row["Machete"]. "</font>";?></td>
		<td><?php echo "<font color='red'>". $row["Katana"]. "</font>";?></td>
		<td><?php echo "<font color='green'>". $row["Chainsaw"]. "</font>";?></td>
		<td><?php echo "<font color='blue'>". $row["Grenade"]. "</font>";?></td>
		<td><?php echo "<font color='yellow'>". $row["RemoteGrenade"]. "</font>";?></td>
		<td><?php echo "<font color='brown'>". $row["TearGas"]. "</font>";?></td>
		<td><?php echo "<font color='cyan'>". $row["Molotov"]. "</font>";?></td>
		<td><?php echo "<font color='teal'>". $row["Missile"]. "</font>";?></td>
		<td><?php echo "<font color='purple'>". $row["Colt45"]. "</font>";?></td>
		<td><?php echo "<font color='indigo'>". $row["Python"]. "</font>";?></td>
		<td><?php echo "<font color='violet'>". $row["Shotgun"]. "</font>";?></td>
		<td><?php echo "<font color='orange'>". $row["Spaz"]. "</font>";?></td>
		<td><?php echo "<font color='red'>". $row["Stubby"]. "</font>";?></td>
		<td><?php echo "<font color='blue'>". $row["Tec9"]. "</font>";?></td>
		<td><?php echo "<font color='green'>". $row["Uzi"]. "</font>";?></td>
		<td><?php echo "<font color='yellow'>". $row["Ingrams"]. "<</font>";?></td>
		<td><?php echo "<font color='brown'>". $row["MP5"]. "</font>";?></td>
		<td><?php echo "<font color='cyan'>". $row["M4"]. "</font>";?></td>
		<td><?php echo "<font color='teal'>". $row["Ruger"]. "</font>";?></td>
		<td><?php echo "<font color='purple'>". $row["SniperRifle"]. "</font>";?></td>
		<td><?php echo "<font color='indigo'>". $row["LaserScope"]. "</font>";?></td>
		<td><?php echo "<font color='violet'>". $row["RocketLauncher"]. "</font>";?></td>
		<td><?php echo "<font color='orange'>". $row["FlameThrower"]. "</font>";?></td>
		<td><?php echo "<font color='black'>". $row["M60"]. "</font>";?></td>
		<td><?php echo "<font color='black'>". $row["Knife"]. "</font>";?></td>
		
    </tr>
		
       <?php    } ?>
	     
</table>