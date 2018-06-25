<?php
	include_once 'check.php';
	$sesja = new Sesja();
	$sesja->only_for_superuser();




/*

if (isset($_POST['godzina_start']) && isset($_POST['godzina_stop'])&& isset($_POST['sala'])&& isset($_POST['nazwa_zaj'])&& isset($_POST['data'])) 
{
*/	



$db = new Baza();


$sql= ("SELECT id_sala  FROM sala WHERE nazwa_s = :sala");
$q = $db->prepare($sql);
$q -> execute(array(
	":sala"=>$_POST['sala']
	));
$sala = $q->fetch();



$sql= ("SELECT id_tanca  FROM typ_tanca WHERE nazwa = :nazwa_zaj");
$q = $db->prepare($sql);
$q -> execute(array(
	":nazwa_zaj"=>$_POST['nazwa_zaj']
	));
$nazwa_zaj = $q->fetch();





	$stmt = $db->prepare(  
    "INSERT INTO harmonogram (`id_zajec`, `godz_start`, `godz_stop`, `id_sala`, `id_prowadzacy`, `id_tanca`, `data`)  VALUES (NULL, :timepicker, :timepicker2, :sala, :id_uzytkownika, :nazwa_zaj, :datepicker)");  

	$stmt->execute(array(
		':timepicker' => $_POST['timepicker'], 
		':timepicker2' => $_POST['timepicker2'],
		':sala' => $sala[0],
		':id_uzytkownika' => $sesja->object['id_uzytkownika'],
		':nazwa_zaj' => $nazwa_zaj[0],
		':datepicker' => $_POST['datepicker']
		));
	

	echo "Zajęcia zostały poprawnie dodane";
	header("Location: panel_ins.php");

?>
