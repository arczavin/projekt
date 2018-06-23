<?php 
include_once 'connection.php';


$dbh = new Baza();
$sth = $dbh->prepare ('SELECT harmonogram.*, typ_tanca.*, sala.*, prowadzacy.* FROM harmonogram INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca INNER JOIN sala ON sala.id_sala=harmonogram.id_sala INNER JOIN prowadzacy ON harmonogram.id_prowadzacy=prowadzacy.id_prowadzacy');
$sth->execute();



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



<h1 class="main"> harmonogram zajęć</h1>  
<div  class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th>Nazwa zajęć</th>
      <th>Godzina rozpoczęcia</th>
      <th>Godzina zakończenia</th>
      <th>Numer sali</th>
      <th>Data</th>
      <th>Prowadzący</th>
    </tr>
  </thead>
</table>
</div>
<div  class="tbl-content">
<table cellpadding="0" cellspacing="0" border="0">
  <tbody>

  <?php while ($result = $sth->fetch()): ?>
  <tr>
    <td><?php echo htmlspecialchars ($result['nazwa'])?></td>  
    <td><?php echo htmlspecialchars ($result['godz_start'])?></td>
    <td><?php echo htmlspecialchars ($result['godz_stop'])?></td>
    <td><?php echo htmlspecialchars ($result['nazwa_s'])?></td>
    <td><?php echo htmlspecialchars ($result['data'])?></td>
    <td><?php echo htmlspecialchars ($result['nazwisko'])?></td>
  </tr>

<?php endwhile; ?>

</table>
</tbody>
</html>