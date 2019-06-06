<link rel="icon" href="https://vc-mp.org/images/logoSmall.png" sizes="16x16" type="image/png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>VCMP Vehicle Syntax Generator</title>
<center>
<h1>VCMP Vehicle Syntax Generator</h1>
main.nut<br>
<?php echo "CreateVehicle( ".$_POST["m"].""; ?>
<?php echo ", ".$_POST["w"].""; ?>
<?php echo ", ".$_POST["x"].""; ?>
<?php echo ", ".$_POST["y"].""; ?>
<?php echo ", ".$_POST["z"].""; ?>
<?php echo ", ".$_POST["a"].""; ?>
<?php echo ", ".$_POST["cl1"].""; ?>
<?php echo ", ".$_POST["cl2"].");"; ?>
<br>
server.conf<br>
<
<?php echo 'Vehicle model="'.$_POST["m"].'" '; ?>
<?php echo 'world="'.$_POST["w"].'" '; ?>
<?php echo 'x="'.$_POST["x"].'" '; ?>
<?php echo 'y="'.$_POST["y"].'" '; ?>
<?php echo 'z="'.$_POST["z"].'" '; ?>
<?php echo 'angle="'.$_POST["a"].'" '; ?>
<?php echo 'col1="'.$_POST["cl1"].'" '; ?>
<?php echo 'col2="'.$_POST["cl2"].'" '; ?>
/>
</center>