<?php
	include_once 'connection.php';
	include_once 'register.php';
	?>
<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/rejestracja.css" />
<title>Fitness 4 you</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="Stylesheet" type="text/css" href="rejestracja.css" />



    
 
<body>
 <img src="img/girl_gym.png" id="girl_gym">

<div id="formularz">
<div id="container" class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Zarejestruj się</h1>

    <form action="register.php" method="post" id="rej">

      <div class="input-container">
        <input input type="text" name="imie" id="imie" required="required" />
        <label for="imie">imię</label>
        <div class="bar"></div>
      </div>

       <div class="input-container">
        <input input type="text" name="nazwisko" id="nazwisko" required="required"/>
        <label for="nazwisko">nazwisko</label>
        <div class="bar"></div>
      </div>


       <div class="input-container">
        <input input type="text" name="login" id="login" required="required"/>
        <label for="login">login</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input input type="password" name="haslo" id="haslo" required="required" />
        <label for="haslo">hasło</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input input type="password" name="haslo2" id="haslo2" required="required" />
        <label for="haslo2">powtórz hasło</label>
        <div class="bar"></div>
      </div>

      <div class="button-container">
        <button type="submit" id="but_ok"><span>Ok!</span></button>
        <button type="reset" id="but_reset"><span>Wyczyść!</span></button>	
      </div>

    </form>
  </div>
   
</div>

</div>



</body>

</head>
</html>
