<?php
	include_once 'check.php';
	$sesja = new Sesja();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/wyszukaj.css" />
	<title>Fitness 4 you</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Fitness 4 you</title>

</head>


<body>


<menu>
  	<ul>
  <li><a href="zapis.php" id="zapis">ZAPISY</a></li>
  <li><a href="moje.php" id="moje">MOJE ZAJĘCIA</a></li>
  <li><a href="zm_haslo_u.php" id="passwd">ZMIEŃ HASŁO</a></li>
  <li><a href="wyszukaj.php" id="szukaj">WYSZUKAJ</a></li>
  <li><a href="logout.php" id="logout">WYLOGUJ</a></li>
	</ul>
</menu>



    <form action="wyszukaj.php" method="POST">
<div id="container" class="container">
  <div class="card">
    <h1 class="title">Wyszukaj salę</h1>

      <div class="input-container">
      <input type="text" list="sala" name="sala" required="required">
          <datalist id="sala">
              <option value="S1">
              <option value="S2">
              <option value="Basen B1">
              <option value="Basen B2">
          </datalist>
        <label for="sala">sala</label>
        <div class="bar"></div>
      </div>


    <h1 class="title">Wyszukaj zajęcia</h1>
      <div class="input-container">
      <input type="text" list="nazwa_zaj" name="nazwa_zaj" required="required">
          <datalist id="nazwa_zaj">
              <option value="Zumba dla dzieci">
              <option value="Pilates">
              <option value="Rumba">
              <option value="Aqua aerobik">
              <option value="TBC">
              <option value="STEP">
              <option value="Zumba">
          </datalist>
        <label for="nazwa_zaj">nazwa zajęć</label>
        <div class="bar"></div>
      </div>

<h1 class="title">Wyszukaj prowadzącego</h1>
      <div class="input-container">
      <input type="text" list="trainer" name="trainer" required="required">
          <datalist id="trainer">
              <option value="Kowalska">
              <option value="Nowak">
              <option value="Królikowska">
              <option value="Sawka">
              <option value="Mączyńska">
          </datalist>
        <label for="trainer">prowadzący</label>
        <div class="bar"></div>
      </div>

            <div class="button-container">
        <button ><span>Go!</span></button>
            </div>


    </form>


<Br>





</body>
</html>
