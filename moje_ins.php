<?php 
include_once 'check.php';
$sesja = new Sesja();
$sesja->only_for_superuser();




$db = new Baza();
$sql = 'SELECT harmonogram.*, typ_tanca.*, sala.* FROM harmonogram INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca INNER JOIN sala ON sala.id_sala=harmonogram.id_sala WHERE harmonogram.id_prowadzacy = :id_uzytkownika';
$q = $db->prepare($sql);
$wyn = $q->execute(array(
  ':id_uzytkownika' => $sesja->object ['id_uzytkownika']));
 


 $dba = new Baza();   
if (isset($_POST['title']) && isset($_POST['id_zajec']))
 {

  $update = "UPDATE harmonogram SET notatka=:notatka WHERE id_zajec=:id_zajec";//update
    $upd = $dba->prepare($update);
    $wynik = $upd->execute(array(
      ':id_zajec' => $_POST['id_zajec'],
      ':notatka' => $_POST ['title']

  ));
    if($wynik) {
    echo "Poprawnie dodałeś notatkę";
  } else {
    echo "Błąd -> coś poszło nie tak. Spróbuj jeszcze raz";
  }
}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/moje.css" />
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index_m.js"></script>





<body>


<menu>
  	<ul>
	<li><a href="dodaj.php" id="grafik">DODAJ ZAJĘCIA</a></li> 
	<li><a href="moje_ins.php" id="info">MOJE ZAJĘCIA</a></li>
	<li><a href="zm_haslo.php" id="cennik">ZMIEŃ HASŁO</a></li>
  <li><a href="logout.php" id="logout">WYLOGUJ</a></li>
	</ul>
</menu>

<h1>Mój harmonogram</h1>  
<div  class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th>Nazwa zajęć</th>
      <th>Godzina rozpoczęcia</th>
      <th>Godzina zakończenia</th>
      <th>Nazwa sali</th>
      <th>Data</th>
      <th>Wpisz notatkę </th>
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
    <td> 
          <form method="post">
            <label for="title">Wpisz notatkę</label>
            <input type="text" name="title">
            <input type="hidden" value="<?php echo $r['id_zajec']?>" name="id_zajec">
                <input type="submit" value="utwórz">
          </form> </td>
  </tr>

<?php endwhile; ?>

</table>
</tbody>
</html>
