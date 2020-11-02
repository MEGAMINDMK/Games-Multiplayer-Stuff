<title>Cars Owners</title>
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

<center><h1>Cars - Owners</h1>
<form class="form-inline" action="search_player_db/cars.php" method="post">
<input class="form-control mr-sm-2" type="text" name="search" placeholder="Search using a name" required>
<button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" value="Search">Search</button>
</form>
</center>


<table>
    <tr>
        <th>ID</th>
		<th>Cost</th>
		<th>Owner</th>
		<th>Shared</th>
		</tr>

<?php
include('db.php');
//echo "connection successfull";

$cars = "SELECT * FROM cars";
$result = $conn->query($cars);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {?>
	
	<tr>
		<td><?php echo "<font color='red'>". $row["ID"]. "</font>";?></td>
		<td><?php echo "<font color='green'>". $row["Cost"]. "</font>";?></td>
		<td><?php echo "<font color='blue'>". $row["Owner"]. "</font>";?></td>
		<td><?php echo "<font color='teal'>". $row["Shared"]. "</font>";?></td>
		</tr>
		
   <?php } }  else {
    echo "0 results";
}
$conn->close();?>


</table>