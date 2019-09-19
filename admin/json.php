<?php
include "../connection.php";

$q=mysqli_query($cn,"select * from polygon,curve where polygon.id=curve.id_polyg and time_v=$_GET[tm] ");
$js="{\"res\":[";
while ($r=mysqli_fetch_array($q))
{
	if($r['coords']!="")
	{
		if($r['places']>0)
		{
			
			$elftheres_theseis=$r['places']-$r['population']*0.2-$r['dvalue']*$r['places'];
			if($elftheres_theseis<0) $elftheres_theseis=0;
			$katilimenes_theseis=$r['places']-$elftheres_theseis;
			$pososto=$katilimenes_theseis/$r['places'];
						
		}
		else 
		{
			$pososto=1;
		}
		
		$js=$js."{\"id\":\"$r[id]\", \"center\":\"$r[center]\", \"p\":\"$pososto\"},";
		
		
	}
}
	$js=$js."{\"id\":\"$r[id]\", \"center\":\"$r[center]\", \"p\":\"$pososto\"}";
	$js=$js."]}";
		
	echo $js;
	
?>


 