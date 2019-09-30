<?php
include "../connection.php";

//exoume to center
$result1 = mysqli_query("SELECT center FROM polygon");
$center= explode(',', mysqli_fetch_array($result1));


?>