<link rel="icon" href="https://vc-mp.org/images/logoSmall.png" sizes="16x16" type="image/png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>VCMP Vehicle Syntax Generator</title>
<center>
<h1>VCMP Vehicle Syntax Generator</h1>
<form action="action.php" method="POST">
  <input type="number" name="m" min="130" max="236" placeholder="Vehicle Model" required>
  <input type="number" name="w" min="1" max="100" placeholder="World" required>
  <input type="text" name="x" size="4" placeholder="Vector X" required>
  <input type="text" name="y"  size="4" placeholder="Vector Y" required>
  <input type="text" name="z"  size="4" placeholder="Vector Z" required>
  <input type="text" name="a"  size="4" placeholder="Angle" required>
  <input type="number" name="cl1" min="0" max="94" placeholder="Colour 1" required>
  <input type="number" name="cl2" min="0" max="94" placeholder="Colour 2" required>
  <input type="submit" value="Create">
</form>
</center>