<?php
session_start();
include "../connection.php";
date_default_timezone_set('Europe/Athens');
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
<div class="container">

<?php
include "menu.php";
?>

 <form action='' method=post>
	 <select name=tm1>
	 <?php
	 
	 if (isset($_POST['tm1'])){
		 $time=$_POST['tm1'];
	 }
	 else
	 {
	 $time=date('H');
	 }
	 for ($i=0;$i<24;$i++)
		echo "<option value=$i>$i:00</option>";
	 ?>
	 </select>
	 <br>
	 <input type=submit class='btn btn-primary' value='Διαθεσιμότητα Parking'>
	</form>
	
	<?php
	
		echo "<div class='alert alert-success'>Ώρα: $time:00</div>";
	
	?>
	
	<div id=map style='width:100% ; height:400px'></div>
	
	 <br><br>

   <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:  40.625603, lng: 22.950524},
		  zoom: 13,
          mapTypeId: 'terrain'
        });

		 
		<?php
		
		$result=mysqli_query($cn,"select * from polygon");
		
		
		while($row=mysqli_fetch_array($result))
		{
			if($row['coords']!="")
			{
					$ALLcoordinates= explode(" ",$row['coords']);
					$vale_coma=0;
					
					echo "var coords$row[id] = [";
					foreach ($ALLcoordinates as $i_coord)
					{
						if($vale_coma==1) echo ",";
						$vale_coma=1;
						
						$xy=explode(",",$i_coord);
						echo "{lat:$xy[1], lng:$xy[0]}";
						
					}
					
					
					echo "];
					
	
					 
					 polygono$row[id] = new google.maps.Polygon({
						  paths: coords$row[id],
						  fillColor: '#888'
					});
				polygono$row[id].setMap(map);
				

				google.maps.event.addListener( polygono$row[id], 'click', function (event) {
					
					
					var inf = new google.maps.InfoWindow({
          content: \"Πλήθυσμός: $row[population]<br>Θέσεις Parking: $row[places]<br><a href='edit_sq.php?id=$row[id]'>Επεξεργασία</a>\"
        });
					inf.setPosition(event.latLng);
				     inf.open(map);
						
					 
					});
				
				
				";
			};
			
	
		};
		
	
		
		$s_string=file_get_contents("http://localhost/admin/json.php?tm=".$time);
		
		$j=json_decode($s_string);
		 
		  foreach ($j->reslt as $recolor)
		  {
			 
			  $id=$recolor->id;
			  $p=$recolor->p;
			  if($p<0.59) echo " polygono$id.setOptions({ fillColor: 'green'});";
			  if($p>=0.59 && $p<0.84) echo " polygono$id.setOptions({ fillColor: 'yellow'});";
			  if($p>=0.84)	echo " polygono$id.setOptions({ fillColor: 'red'});";
  
		  }
		
		?>
		
      }	  
	  
    </script>
	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzb2ittTel4_7qg0PzTcydeTql_Iwvej4&libraries=places&callback=initMap">
    </script>


</div>
</body>