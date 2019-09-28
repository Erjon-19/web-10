<head>
<style>
body {
  background-image: url("car.jpg");
  background-repeat: no-repeat;
  background-size: 100% !important;
}
</style>
</head>
<body>

<div class=col-md-3 style='padding:30px;'>

<h1> Καλώς ορίσατε στο σύστημα!</h1> 
</div>
<div class=col-md-9 style='margin-top:40px;'>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left; solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: black;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href='upload.php'><button class='btn btn-primary' style='width:170px;'>Ανέβασμα δεδομένων</button></a></li>
  <li><a href='del.php'><button class='btn btn-primary' style='width:150px;'>Διαγραφη δεδομένων</button></a></li>
  <li><a href='map.php'><button class='btn btn-primary' style='width:150px;'>Εξομοίωση Χάρτη</button></a></li>
  <li style="float:right"><a href='logout.php'><button class='btn btn-primary' style='width:150px;'>Αποσύνδεση</button></a></li>
</ul>

</body>
</html>
