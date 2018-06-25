<?php
	include_once 'check.php';
	$sesja = new Sesja();
	$sesja->only_for_superuser();

?>

<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/panel.css" />
<title>Fitness 4 you</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>


<body>

<menu>
  	<ul>
	<li><a href="dodaj.php" id="grafik">DODAJ ZAJĘCIA</a></li>
	<li><a href="moje_ins.php" id="info">MOJE ZAJĘCIA</a></li>
	<li><a href="zm_haslo.php" id="cennik">ZMIEŃ HASŁO</a></li>
	<li><a href="logout.php" id="logout">WYLOGUJ</a></li>
	</ul>
</menu>





</body>
</html>
