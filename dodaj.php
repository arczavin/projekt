<?php
	include_once 'check.php';
	$sesja = new Sesja();
	$sesja->only_for_superuser();
?>

<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/dodaj.css" />
<title>Fitness 4 you</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
    <script src="http://dnpwc.gov.np/application/resources/admin/plugins/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>

  <script>
  	$(function datepicker()) {
    $( "#datepicker" ).datepicker({format: 'yyyy-mm-dd'});
	}

    $(function timepicker()) {
    $( "#timepicker" ).timepicker();
    $( "#timepicker2" ).timepicker();
  }
  </script>


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



    <form action="add.php" method="POST">
<div id="container" class="container">
  <div class="card">
    <h1 class="title">Dodaj zajęcia</h1>



      <div class="input-container">
        <input type="time" id="timepicker" name="timepicker" required="required"/>
        <label for="timepicker">godzina rozpoczęcia</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input type="time" id="timepicker2" name="timepicker2" required="required"/>
        <label for="timepicker2">godzina zakończenia</label>
        <div class="bar"></div>
      </div>


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


       <div class="input-container" data-date-format="yyyy/mm/dd">
        <input type="date" id="datepicker" name="datepicker" required="required"/>
        <label for="datepicker">data</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button onClick="md5Generator()"><span>Go!</span></button>
      </div>
    </form>


<br>





</body>
</html>
