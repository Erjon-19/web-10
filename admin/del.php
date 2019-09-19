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
	 @unlink('myklm.klm');

	 mysqli_query($cn,"delete from polygon");
	  mysqli_query($cn,"delete from curve");
	 ?>
	 <div class="alert alert-success">
	All Data Deleted
	</div>
	
	 <?php
	 

 
?>


</div>
</body>