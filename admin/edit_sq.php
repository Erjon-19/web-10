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
	<style>

  <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table {
  width: 100%;    
  background-color: #f1f1c1;
}
</style> 
}
</style>
</head>
<body>
<div class="container">
<?php
include "menu.php";
	


 
	 
	 if(isset($_POST['bt1']))
	{
		$s1="update polygon set population=$_POST[pop], places=$_POST[plc] where id=$_GET[id]";
		$s2="update curve set dvalue=$_POST[zitisi] where id_polyg=$_GET[id] and time_v=$_POST[tm]";
		mysqli_query($cn,$s1);
		mysqli_query($cn,$s2);
	
	
	}
	 
	 
	 $q=mysqli_query($cn,"select * from polygon where id=$_GET[id]");
	 $r=mysqli_fetch_array($q);
	 
	 echo "ID: $r[name]
	 <form action='' method=post>
	 Population: <br>
	 <input type=number value='$r[population]' class=\"form-control\" name=pop><br>
	 Parking Places: <br>
	 <input type=number name=plc class=\"form-control\" value='$r[places]'><br>
	 
	 
	 
		
    For Hour:<br><select name=tm class=\"form-control\" >";
	
	for ($i=0;$i<24;$i++)
		echo "<option value=$i>$i:00</option>";
	
	echo "
	</select><br> 
	Value:
	
	
	<input type=number class=\"form-control\"  step=\"0.01\" name=zitisi value='0.0'>
	
	
	<input type=\"submit\" class='btn btn-primary' value='Save Data' name=bt1>
</form>";
	
	
	 $q=mysqli_query($cn,"select * from curve where id_polyg=$_GET[id] order by time_v");
	 
	 echo "<br>
	 </div>
	 <div class=col-md-12>
	 <h3>Καμπύλη Ζήτησης ανά Ώρα</h3>
	 <table border=3 class=table>";
	 echo "<tr><td>Ώρα<br>Τιμή</td>";
	 
	while( $r=mysqli_fetch_array($q))
	{
		echo "<td> $r[time_v] <br> ".round($r['dvalue'],2),"</td>";
	}
	 
	 echo "</tr></table>";
 
	?>

	 <br><br>
	


</div>
</body>