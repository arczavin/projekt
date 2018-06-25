<?php
include_once 'check.php';
$sesja = new Sesja();

$db = new Baza();

$sql = 'SELECT harmonogram.*, typ_tanca.* FROM harmonogram INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca WHERE harmonogram.id_zajec NOT IN(SELECT id_zajec FROM zajecia WHERE id_uzytkownika = :id_uzytkownika)';
$q = $db->prepare($sql);


if(isset($_POST['id_zajec'])) {

  $insert = "INSERT INTO zajecia(id_zajec, id_uzytkownika) VALUES (:id_zajec, :id_uzytkownika)";
    $zap = $db->prepare($insert);
    $wynik = $zap->execute(array(
      ':id_zajec' => $_POST['id_zajec'],
      'id_uzytkownika' => $sesja->object['id_uzytkownika']
  ));



  if($wynik) {
    echo "Zostałeś poprawnie zarejestrowany";
  } else {
    echo "Błąd -> coś poszło nie tak. Przejdź do strony głównej aby spróbować jeszcze raz";
  }
}

$q->execute(array(
  ':id_uzytkownika' => $sesja->object['id_uzytkownika']
));

?>
  <?php while ($r = $q->fetch()): ?>
  <tr>
    <td><?php echo htmlspecialchars ($r['nazwa'])?></td>
    <td><?php echo htmlspecialchars ($r['godz_start'])?></td>
    <td><?php echo htmlspecialchars ($r['godz_stop'])?></td>
    <td><?php echo htmlspecialchars ($r['dzien'])?></td>
    <td><?php echo htmlspecialchars ($r['data'])?></td>
    <td><?php echo htmlspecialchars ($r['notatka'])?></td>
  </tr>
<form action="zapis.php" method="POST">
<input type="hidden" value="<?php echo $r['id_zajec']?>" name="id_zajec">
<input type="submit" value="zapis" name="zapis">

</form>


<?php endwhile;
?>
