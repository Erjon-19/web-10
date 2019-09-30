<!DOCTYPE html>
<html lang="en">
<head>
     <style>
body {
  background-image: url("thes.jpg") !important ;
  background-repeat: no-repeat;
  
  background-size: 100%;
}
</style>
  <title>Διαχειριστής</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class=container>
<div class=row>
 <div class=col-md-3>
	  <h2 style="color: #660033; font-size:300%;">Επιστροφή</h2> 
	<a href='../index.php'><button   class='btn btn-primary' style='background-color: #483D8B; color:white;width:200px ;' >Σελίδα Χρήστη</button></a>
		
	 
	 </div>
<div class=col-md-9>	 

  <h2 style="color:white; font-size:300%;">Σύνδεση ως Διαχειριστής</h2>
  <form action="login.php" method=post>
    <div class="form-group">
      <label for="username">Username: </label>
      <input type="text" class="form-control" id="usr" placeholder="Enter Username" name="usr"> <!--  -->
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <button type="submit" class="btn btn-default">Σύνδεση</button>
  </form>

</div>
</div>
</div>
</body>
</html>
