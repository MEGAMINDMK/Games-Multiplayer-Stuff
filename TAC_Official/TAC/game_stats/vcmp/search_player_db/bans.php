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
		<th>IP</th>
		<th>Admin</th>
		<th>Reason</th>
		</tr>

<?php
include('../db.php');	
$search_value=$_POST["search"];

        $sql="SELECT * from bans where Name like '%$search_value%'";

        $res=$conn->query($sql);

        while($row=$res->fetch_assoc()){?>
		
        <tr>
		<td><?php echo "<font color='red'>". $row["Name"]. "</font>"; ?></td>
        <td><?php echo "<font color='blue'>". $row["IP"]. "</font>"; ?></td>
		<td><?php echo "<font color='green'>". $row["Admin"]. "</font>"; ?></td>
		<td><?php echo "<font color='yellow'>". $row["Reason"]. "</font>"; ?></td>			
        </tr>
		
       <?php    } ?>
	     
</table>