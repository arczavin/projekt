<?php

	include_once 'check.php';
	$sesja = new Sesja();
	$db = new Baza();

	$sql = 'DELETE FROM sesja WHERE id_sesja = :id';
	$query = $db->prepare($sql);

	$wynik = $query->execute(array(
		':id' => $sesja->object['id_sesja']
	));

	if($wynik) {
		setcookie("tajne_dane", "", time()-3600);
		header("Location: index.html");
	}
	
?>