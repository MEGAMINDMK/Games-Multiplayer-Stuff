<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register TAC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" href="images/tac.png" type="image/x-icon">
</head>
<body>
<style>
body { 
  background: url(images/test1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  position: relative;
}
</style>
<font color="white">
<center>
<div class="container">
  <h2>[TAC] Register your Server</h2>
  <form action="registertac.php" method="post">
  <div class="form-group">
      <label for="Server Name">Server Name:</label>
      <input type="Server Name" class="form-control" id="Server Name" placeholder="Enter Server Name" name="Server Name" required>
    </div>
  <div class="form-group">
      <label for="Server Owner">Server Owner:</label>
      <input type="Server Owner" class="form-control" id="Server Owner" placeholder="Enter Server Owner Name" name="Server Owner" required>
    </div>
	<div class="form-group">
      <label for="Owner Email">Owner Email:</label>
      <input type="Owner Email" class="form-control" id="Owner Email" placeholder="Enter Server Owner Email" name="Owner Email" required>
    </div>
	<div class="form-group">
      <label for="Server Note">Note:</label>
      <input type="Server Note" class="form-control" id="Server Note" placeholder="Enter Server Note" name="Server Note" required>
    </div>
    <button type="submit" class="btn btn-warning btn-lg">Submit</button>
  </form>
</div>

</body>
</html>