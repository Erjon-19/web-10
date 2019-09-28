<?php
session_start();
include "../connection.php";
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
if(isset($_POST['submit']) && !empty($_POST["submit"]))
{
		$kml = simplexml_load_file('geonode-population_data_per_block.kml');
		$values_zitisis=array(0.1,0.1,0.1,0.1,0.2,0.2,0.2,0.4,0.4,0.8,0.8,0.8,0.8,0.7,0.6,0.4,0.3,0.3,0.6,0.7,0.7,0.4,0.2,0.1);
		
		
		foreach($kml->Document->Folder->Placemark as $placemark){
			
			$b1=explode("Population</span>:</strong> <span class=\"atr-value\">",$placemark->description);
			$b2=explode("</span>",@$b1[1]);
			
			$pop=0;
			if( @$b2[0]) $pop=$b2[0];
			
			$places=round(@$placemark->LookAt->range)/2;
			
			
			$s="INSERT INTO polygon(id, name, population, places,coords,center) 
				VALUES (NULL, '".$placemark->name."', '$pop', '$places',
				'".@$placemark->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates."','".@$placemark->MultiGeometry->Point->coordinates."')";
				
				
			mysqli_query($cn,$s);
			$idp=mysqli_insert_id($cn);
			       
			
			for ($h=0;$h<24;$h++)
			{
	
				mysqli_query($cn,"INSERT INTO curve(id_polyg, time_v, dvalue) 
				VALUES ('$idp','$h','".$values_zitisis[$h]."')");
				
			}
			
		}
	
		echo "
		 <div class=\"alert alert-success\">
		All Data Save to DB
		</div>";
	
}


 

	 ?>
	 <h2> Upload Data Page </h2>
		<form action="upload.php" method="post" enctype="multipart/form-data" style='padding:30px; background-color:#eef;'>
		<br><br>
    <label for="kml">Give Upload File:</label>
    <input type="file" class="form-control" name="kml" id=kml  >
     <input type="submit" class='btn btn-default' value='UpLoad' name=submit>
</form>
	 <br><br>
	
	


</div>
</body>