<?
session_start();
include "connection.php";
date_default_timezone_set('Europe/Athens'); //set the default time zone used by all date/time functions in a script
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=devive-width, initial-scale-1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

 <body>

	<h2>Επιλογή θέσης Parking</h2>
    
	   <form action='' method="post" onsubmit="return closeSelf()" name="certform">
       
       <p><b>Eπέλεξε την ώρα που θέλεις να παρκάρεις</b></p>
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
        <br>

        <!--Radious input-->
        Ακτίνα (μεταξύ 10m και 50m):
        <input type="number" name="radius" min="10" max="50"> 
        <br>
        <br>
        <input type="submit">
        </form>
        
        <?php
		echo "<div class='alert alert-success'>Τωρινή ώρα: $time:00</div>";
	    ?>


    <!--script that closes the window after pressing submit-->
     <script type="text/javascript">
        function closeSelf(){
        self.close();
        return true;
        }
    </script>
    
  </body>
</html>