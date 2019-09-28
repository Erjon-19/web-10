<?php
include "../connection.php";

$result=mysqli_query($cn,"select * from polygon,curve where polygon.id=curve.id_polyg and time_v=$_GET[tm] ");

$js="{\"reslt\":[";

while($row=mysqli_fetch_array($result))
{
	if($row['coords']!="")
	{
		if($row['places']>0)
		{
			//ypologismos eleftherwn thesewn
			$eleftheres_theseis=$row['places']-$row['population']*0.2-$row['dvalue']*$row['places'];
			if($eleftheres_theseis<0) $eleftheres_theseis=0;

			//ypologismos katilimenwn thesewn 
			$katilimenes_theseis=$row['places']-$eleftheres_theseis;
			//anathesh pososto katilimemwn thesewn
			$pososto=$katilimenes_theseis/$row['places'];
						
		}
		else 
		{
			$pososto=1;
		}
		
		//kwdikopoihsi syntetagmenwn
		$js=$js."{\"id\":\"$row[id]\", \"center\":\"$row[center]\", \"p\":\"$pososto\"},";
		
		
	}
}
	
	//apothikeysh twn apotelesmatwn sto js
	$js=$js."{\"id\":\"$row[id]\", \"center\":\"$row[center]\", \"p\":\"$pososto\"}";
	$js=$js."]}"; //kleinei to string
		
	echo $js; 
	
?>


 