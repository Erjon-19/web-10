<?php
	 $dbhost = "localhost";
	 $dbuser = "root";
	 $dbpass = "";
	 $db = "project_web";
	 $cn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $cn -> error);
     mysqli_set_charset($cn, "utf8");
     return $cn;
?>