<?php
session_start();
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Διαχειριστής</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class=row>

<?php
if (isset($_POST['usr']))
{
	$q=mysqli_query($cn,"select * from admin where usr='$_POST[usr]' and psw='$_POST[pwd]'");
	if(mysqli_num_rows($q)>0)
	{
		$_SESSION['lg']=1;	
	}
	else
	{
		$_SESSION['lg']=0;
	}
	
}

 
 
 if(@$_SESSION['lg']==0 || @$_SESSION['lg']=="")
 {
	echo "<div class=col-md-4> 
	</div>";

	 echo "<div class=col-md-4>
	 <h1>Λάθος στοιχεία</h1>
	 <a href='../index.php'><button class='btn btn-primary' style='width:200px;'>Επιστροφή</button></a>
	 </div>
	 <div class=col-md-10>
	 

	 </div>
	 
	 ";
	 
 }
 else
 {
	 include "menu.php";
	 
	 echo "<h1>Παπαδόπουλος Χάρης(Διαχειριστής)</h1>";
	 
 }
 
?>
</div>


</div>
</body>