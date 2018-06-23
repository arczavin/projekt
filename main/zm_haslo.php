<?php
  include_once 'check.php';
  $sesja = new Sesja();
  $sesja->only_for_superuser();

  $db = new Baza();

if(isset($_POST['pass_old']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
  $stare_haslo = $_POST['pass_old'];
  $nowe_haslo = $_POST['pass'];
  $nowe_haslo2 = $_POST['pass2'];



  if($nowe_haslo==$nowe_haslo2){
    $sql = 'SELECT * FROM uzytkownicy WHERE id_uzytkownika = :id AND haslo = :password limit 1';
    $query = $db->prepare($sql);
    $query -> execute(array(
      ':id' => $sesja->object['id_uzytkownika'],
      ':password' => md5($stare_haslo)
    ));

    if($query->fetch()) {
      $update = 'UPDATE uzytkownicy SET haslo = :haslo WHERE id_uzytkownika = :id_uzytkownika';
      $zap = $db->prepare($update);
      echo $zap->execute(array(
      ':id_uzytkownika' => $sesja->object['id_uzytkownika'],
      ':haslo' => md5($nowe_haslo)
      ));

      echo "twoje haslo zostało zmienione";

    } else {
      echo "stare jest nie takie jak trzeba";
    }

  }


}


?>


<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/dodaj.css" />
<title>Fitness 4 you</title>
</head>


<img src="img/img9.png" id="img10">


<menu>
    <ul>
  <li><a href="dodaj.php" id="grafik">DODAJ ZAJĘCIA</a></li> 
  <li><a href="moje_ins.php" id="info">MOJE ZAJĘCIA</a></li>
  <li><a href="zm_haslo.php" id="cennik">ZMIEŃ HASŁO</a></li>
  <li><a href="logout.php" id="logout">WYLOGUJ</a></li>
  </ul>
</menu>


<div id="container" class="container">
  <div class="card">
    <h1 class="title">Zmień hasło </h1>
    <form method="post" action="zm_haslo.php">
      <div class="input-container">
        <input type="password" name="pass_old" id="md5_password" required="required"/>
        <label for="pass_old">Podaj stare hasło</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input type="password" name="pass" id="md5_password" required="required"/>
        <label for="pass">Podaj nowe hasło </label>
        <div class="bar"></div>
      </div>

       <div class="input-container">
        <input type="password" name="pass2" id="md5_password" required="required"/>
        <label for="pass2">Podaj ponownie hasło </label>
        <div class="bar"></div>
      </div>

      <div class="button-container">
        <button onClick="md5Generator()"><span>Go!</span></button>

</html>
