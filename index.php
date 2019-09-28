<?php
session_start();
include "connection.php";
date_default_timezone_set('Europe/Athens'); //set the default time zone used by all date/time functions in a script
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
body {
background-image: url("sky.jpg") !important ;
background-repeat: no-repeat;
background-size: 100% 100%; ;
}

</style>
  <title>ThesParking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<!--div for logo and admin link --bootstrap-- --->
<div class="container"> 
<div class=row>
<div class=col-md-3>
	 <IMG SRC="2.png" ALT="some text" WIDTH=300 HEIGHT=200>
		
		<a href='admin/index.php'><button class='btn btn-primary' style='width:200px;'>Σελίδα Διαχειριστή</button></a>
		
</div>

<!--time selector div -->
<div class=col-md-9 style='margin-top:40px;'>
 <form action='' method=post>

	<!--selects the time from bellow -->
	 <select name=tm1>
	 
	 <?php
	 //check if time is set(currend time) 
	 if (isset($_POST['tm1'])){
		 $time=$_POST['tm1'];
	 }
	 else
	 {
		//set time to Hours
	 	$time=date('H');
	 }
	 for ($i=0;$i<24;$i++)
		echo "<option value=$i>$i:00</option>";
	 ?>
	 </select>
	 <br>
	 <input type=submit class='btn btn-primary' value='Color Map-Simulation'>
	</form>
	
	<?php
	
		echo "<div class='alert alert-success'>Time Color Map: $time:00</div>";
	
	?>
	<!--map div -->
	<div id=map style='width:100% ; height:600px'></div>
	
	 <br><br>

   <script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
		 
          center: {lat:  40.625603, lng: 22.950524},
          mapTypeId: 'terrain'
        });

	function addCircle(center){
    	circle = new google.maps.Circle({
		strokeColor: '#FF0000',
    	strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35,
		map: map,
		center: center,
		radius: 100,
		clickable: false
    	});
	}
		 
		<?php
		
			$result=mysqli_query($cn,"select * from polygon");
			
			//gia na min einai diasparta ta omadopoioume se stiles
			while($row=mysqli_fetch_array($result))
			{
				if($row['coords']!="")
				{
						$ALLcoordinates=explode(" ", $row['coords']);
						$vale_coma=0;
						
						//multi-expode string
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
							fillColor: '#888'   //grey color
						});
					polygono$row[id].setMap(map);
					
					google.maps.event.addListener(polygono$row[id], 'click', function(event) {

						addCircle(event.latLng);
						var click = event.latLng;
						var locs = {lat: event.latLng.lat(), lng: event.latLng.lng()};
						var n = arePointsNear(user, locs, diameter);
						console.log(locs);
						//window.open('place.php', 'top=100', 'width=100', 'height=80');
						  
						  
					});


					"; 
				} 
		
			}
			
			//get pososta kai vale tin wra
			$s_string=file_get_contents("http://localhost/admin/json.php?tm=".$time);
			//apokodikopoihsi tou jason string
			$j=json_decode($s_string);
			
			//xrwmatismos xarti
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
	  function arePointsNear(checkPoint, centerPoint, m) { // credits to user:69083
		var km = m/1000;
		var ky = 40000 / 360;
		var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
		var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
		var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
		return Math.sqrt(dx * dx + dy * dy) <= km;
		}
	  
    </script>

	<!--The key for google APIs, and at the end of ./body for efficient load javascript with async -->
    <script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzb2ittTel4_7qg0PzTcydeTql_Iwvej4&callback=initMap">
    </script>

</div>
</body>