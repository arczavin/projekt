<?php
include_once 'check.php';
$sesja = new Sesja();


$db = new Baza();

if(isset($_POST['id_zajec'])) {
	$insert = "DELETE FROM zajecia WHERE id = :id";
    $zap = $db->prepare($insert);
    $wynik = $zap->execute(array(
    	':id' => $_POST['id_zajec']
	));

	if($wynik) {
		echo "Usunąłeś się z zajęć";
	} else {
		echo "Błąd -> coś poszło nie tak. Przejdź do strony głównej aby spróbować jeszcze raz";
	}
}

$sql = 'SELECT zajecia.id, harmonogram.*, typ_tanca.*, sala.* FROM harmonogram INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca INNER JOIN zajecia ON zajecia.id_zajec = harmonogram.id_zajec INNER JOIN sala ON sala.id_sala=harmonogram.id_sala WHERE zajecia.id_uzytkownika = :id_uzytkownika';
$q = $db->prepare($sql);
$q->execute(array(
	':id_uzytkownika'=>$sesja->object['id_uzytkownika']
));



?>



<!DOCTYPE html>
<html>
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/moje.css" />

<menu>
    <ul>
  <li><a href="zapis.php" id="grafik">ZAPISY</a></li>
  <li><a href="moje.php" id="info">MOJE ZAJĘCIA</a></li>
  <li><a href="zm_haslo_u.php" id="cennik">ZMIEŃ HASŁO</a></li>
  <li><a href="wyszukaj.php" id="kontakt">WYSZUKAJ</a></li>
   <li><a href="logout.php" id="logout">WYLOGUJ</a></li>
  </ul>
</menu>

<table class="one">

	<tr>
    <th>NAZWA ZAJĘĆ</th>
    <th>START</th>
    <th>STOP</th>
    <th>SALA</th>
    <th>DATA</th>
    <th>NOTATKA</th>
    <th>ANULUJ</th>
  </tr>
	<?php while ($r = $q->fetch()): ?>
	<tr>
		<th><?php echo htmlspecialchars ($r['nazwa'])?></th>
	    <th><?php echo htmlspecialchars ($r['godz_start'])?></th>
	    <th><?php echo htmlspecialchars ($r['godz_stop'])?></th>
	    <th><?php echo htmlspecialchars ($r['nazwa_s'])?></th>
	    <th><?php echo htmlspecialchars ($r['data'])?></th>
	    <th><?php echo htmlspecialchars ($r['notatka'])?></th>
	    <th> <form action="moje.php" method="POST">
				<input type="hidden" value="<?php echo $r['id']?>" name="id_zajec">
				<input type="submit" value="Wypisz sie" name="zapis">
			</form></th>

	</tr>


<?php endwhile; ?>
<a href='<?php echo "/inz/export.php?format=csv&user_id=" . $sesja->object['id_uzytkownika'] ?>'><button type="button" id="csv" >Export to csv</button></a>
<a href='<?php echo "export.php?format=ics&user_id=" . $sesja->object['id_uzytkownika'] ?>'><button type="button" id="ics" >Export to ical</button></a>
</tbody>
</html>
