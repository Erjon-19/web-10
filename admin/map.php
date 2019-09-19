<?php
session_start();
include "../connection.php";
date_default_timezone_set('Europe/Athens');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
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
		 $tm=$_POST['tm1'];
	 }
	 else
	 {
	 $tm=date('H');
	 }
	 for ($i=0;$i<24;$i++)
		echo "<option value=$i>$i:00</option>";
	 ?>
	 </select>
	 <br>
	 <input type=submit class='btn btn-primary' value='Color Map-Simulation'>
	</form>
	
	<?php
	
		echo "<div class='alert alert-success'>Time Color Map: $tm:00</div>";
	
	?>
	
	<div id=map style='width:100% ; height:400px'></div>
	
	 <br><br>
   <script>


		
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
		 
          center: {lat:  40.625603, lng: 22.950524},
          mapTypeId: 'terrain'
        });

		 
		<?php
		
		$q=mysqli_query($cn,"select * from polygon");
		
		
		while($r=mysqli_fetch_array($q))
		{
			if($r['coords']!="")
			{
					$ALLcoordinates= explode(" ",$r['coords']);
					$vale_coma=0;
					
					echo "var coords$r[id] = [";
					foreach ($ALLcoordinates as $i_coord)
					{
						if($vale_coma==1) echo ",";
						$vale_coma=1;
						
						$xy=explode(",",$i_coord);
						echo "{lat:$xy[1], lng:$xy[0]}";
						
					}
					
					
					echo "];
					
	
					 
					 polygono$r[id] = new google.maps.Polygon({
						  paths: coords$r[id],
						  fillColor: '#888'
					});
				polygono$r[id].setMap(map);
				

				google.maps.event.addListener( polygono$r[id], 'click', function (event) {
					
					
					var inf=   new google.maps.InfoWindow({
          content: \"Polulation: $r[population]<br>Places Parking: $r[places]<br><a href='edit_sq.php?id=$r[id]'>Edit Square</a>\"
        });
					inf.setPosition(event.latLng);
				     inf.open(map);
						
					 
					});
				
				
				";
			};
			
	
		};
		
	
		
		$js=file_get_contents("http://localhost/admin/json.php?tm=".$tm);
		
		$j=json_decode($js);
		 
		  foreach ($j->res as $rec)
		  {
			 
			  $id=$rec->id;
			  $p=$rec->p;
			  if($p<0.59) echo " polygono$id.setOptions({ fillColor: 'green'});";
			  if($p>=0.59 && $p<0.84) echo " polygono$id.setOptions({ fillColor: 'yellow'});";
			  if($p>=0.84)	echo " polygono$id.setOptions({ fillColor: 'red'});";
		  
			  
		  }
		  
		 
		
		
		?>
		
      
       
      }
	  
	  
	  
		
		  
		  
	  
	  
    </script>
	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxxklFcdKu0AEvC4qcf1ffW-KK7zocdDE&libraries=places&callback=initMap">
    </script>


</div>
</body>