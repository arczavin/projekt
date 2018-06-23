<?php 
include_once 'check.php';
$sesja = new Sesja();

$db = new Baza();

$sql = 'SELECT harmonogram.*, typ_tanca.*, sala.* FROM harmonogram INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca INNER JOIN sala ON sala.id_sala=harmonogram.id_sala WHERE harmonogram.id_zajec NOT IN(SELECT id_zajec FROM zajecia WHERE id_uzytkownika = :id_uzytkownika)';
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
    

?>





<!DOCTYPE html>
<html>

<link rel="stylesheet" href="css/moje.css" />


<?php 

$q->execute(array(
  ':id_uzytkownika' => $sesja->object['id_uzytkownika']
));

?>
<menu>
    <ul>
  <li><a href="zapis.php" id="grafik">ZAPISY</a></li> 
  <li><a href="moje.php" id="info">MOJE ZAJĘCIA</a></li>
  <li><a href="zm_haslo_u.php" id="cennik">ZMIEŃ HASŁO</a></li>
  <li><a href="szukaj.php" id="kontakt">WYSZUKAJ</a></li>
   <li><a href="logout.php" id="logout">WYLOGUJ</a></li>
  </ul>
</menu>
  
 
<div  class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th><b>Nazwa zajęć</b></th>
      <th>Godzina rozpoczęcia</th>
      <th>Godzina zakończenia</th>
      <th>Nazwa sali</th>
      <th>Data</th>
      <th>Notatka</th>
      <th id="sign_in">Zapisz się</th>
    </tr>
  </thead>
</table>
</div>
<div  class="tbl-content">
<table cellpadding="0" cellspacing="0" border="0">
  <tbody>

  <?php while ($r = $q->fetch()): ?>
  <tr>
    <td><?php echo htmlspecialchars ($r['nazwa'])?></td>  
    <td><?php echo htmlspecialchars ($r['godz_start'])?></td>
    <td><?php echo htmlspecialchars ($r['godz_stop'])?></td>
    <td><?php echo htmlspecialchars ($r['nazwa_s'])?></td>
    <td><?php echo htmlspecialchars ($r['data'])?></td>
    <td><?php echo htmlspecialchars ($r['notatka'])?></td>
    <td> <form action="zapis.php" method="POST">
          <div class="button-container">
          <input type="hidden" value="<?php echo $r['id_zajec']?>" name="id_zajec">
          <button>Go!</span></button>
          </div> 
          </form>
          </td>
  </tr>


  

<?php endwhile; ?>



</tbody>
</html>